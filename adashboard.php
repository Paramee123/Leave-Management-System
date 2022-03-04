<?php
session_start();
session_regenerate_id(true);

error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Dashboard</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">

        	
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
	
	<?php include('includes/header1.php');?>
            
       <?php include('includes/sidebar.php');?>

	 <?php

$empid=$_SESSION['emplogin'];
$sql = "SELECT * from attendance a,tblemployees te where te.id=a.Empcode and a.Type='HALFDAY' AND te.EmailId=:empid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$hresults=$query->fetchAll(PDO::FETCH_OBJ);
$half=$query->rowCount();

$empid=$_SESSION['emplogin'];
$sql = "SELECT * from shortleave s,tblemployees te where te.id=s.Empcode AND te.EmailId=:empid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$sh=$query->fetchAll(PDO::FETCH_OBJ);
$short=$query->rowCount();

$empid=$_SESSION['emplogin'];
$sql = "SELECT SUM(DIFF) AS totalM from `tblleaves` tb , `tblemployees` te where te.id=tb.empid and tb.Status='1' and te.EmailId=:empid and tb.LeaveType='Medical Leave test'";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetch(PDO::FETCH_ASSOC);
if($results) {
    $totalM = (float) $results['totalM'];
  } else {
    $totalM = 14;
  }
  

  
$empid=$_SESSION['emplogin'];
$sql = "SELECT SUM(DIFF) AS totalC from `tblleaves` tb , `tblemployees` te where te.id=tb.empid and tb.Status='1' and te.EmailId=:empid and tb.LeaveType='Casual Leave'";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetch(PDO::FETCH_ASSOC);
if($results) {
    $totalC = (float) $results['totalC'];
  } else {
    $totalC = 7;
  }



$empid=$_SESSION['emplogin'];
$sql = "SELECT SUM(DIFF) AS totalA from `tblleaves` tb , `tblemployees` te where te.id=tb.empid and tb.Status='1' and te.EmailId=:empid and tb.LeaveType='Restricted Holiday(RH)'";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_ASSOC);
if($results) {
    $totalA = (float) $results['totalA'];
  } else {
    $totalA = 14;
  }

$tothal=($half+$short)/2;
$totM=14-$totalM;
$totC=7-$totalC;
$ftot=$totC-$tothal;

if ($ftot<0){
    
	$totalC=0;
	$totA=14-$totalA;
	$totf=$totA+$ftot;
	
	
	if($totf<0){
		
		$totalA=0;
		
		}
		
	else{
		
		$totalA=$totf;
	}
}

else{
	$totalC=$ftot;
	$totalA=14-$totalA;
}
	

if($totM<0){
	
	$totalM=0;
	
}	

else{
	
	$totalM=$totM;
}
	
	
	
?>   
           

            <main class="mn-inner mt-5">
                <div class="">
                    <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark ">
                            <div class="card-content">
							
                           
                                <span class="card-title text-white">Total Medical Leaves</span>
                                <span class="stats-counter text-white">


                                    <span class="counter"><?php echo htmlentities($totalM);?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                        <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content">
                            
                                <span class="card-title text-white">Total Casual Leaves</span>
                            
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($totalC);?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content">
                                <span class="card-title text-white">Total Annual Leaves</span>
                                    
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($totalA);?></span></span>
                      
                            </div>
                           <div id="sparkline-bar"></div>
                       
                                
                            </div>
                        </div>
                    </div>
                </div>
                 
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12 col-md-12">
                            <div class="card invoices-card border-0 shadow">
                                <div class="card-content">
                                 
                                    <span class="card-title text-success" style="color:blue">Latest Leave Applications</span>
                             <table id="example" class="display responsive-table bg-transparent">
                                    <thead>
                                        <tr>
                                            <th class="text-danger">Emp No.</th>
                                            <th width="200" class="text-danger">Employe Name</th>
                                            <th width="120" class="text-danger">Leave Type</th>

                                             <th width="180" class="text-danger">Posting Date</th>                 
                                            <th class="text-danger">Status</th>
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$empid=$_SESSION['emplogin'];
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblemployees.EmailId=:empid order by lid desc limit 6";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</a></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                                                                       <td><?php $stats=$result->Status;
if($stats==1){
                                             ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">waiting for approval</span>
 <?php } ?>


                                             </td>

          <td>
           <td ><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect blue waves-light btn blue darken-1" > View Details</a></td>
                                    </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
						
						<div class=""></div>
						
						
                    </div>
                </div>
              
            </main>
          
        </div>

        
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/plugins/chart.js/chart.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>
        
    </body>
</html>
<?php } ?>