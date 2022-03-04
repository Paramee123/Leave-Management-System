<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Dashboard</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">

        	
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
           <?php include('includes/header1.php');?>
            
       <?php include('includes/sidebar.php');?>

            <main class="mn-inner mt-5">
                <div class="">
                    <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark ">
                            <div class="card-content">
                            
                                <span class="card-title text-white">Total Employees</span>
                                <span class="stats-counter text-white">
<?php
$sql = "SELECT id from tblemployees";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$empcount=$query->rowCount();
?>

                                    <span class="counter"><?php echo htmlentities($empcount);?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                        <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content">
                            
                                <span class="card-title text-white">Total Leaves Today</span>
    <?php
$sql = "SELECT id FROM `tblleaves` WHERE CURDATE() between `FromDate` and `ToDate`";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$dptcount=$query->rowCount();
?>                            
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($dptcount);?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 col-md-4 l4">
                        <div class="card stats-card border-0 shadow bg-dark">
                            <div class="card-content">
                                <span class="card-title text-white">Total Attendance For Today</span>
                                    <?php
$sql = "SELECT Empcode from  attendance where CurDate=CURDATE()";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavtypcount=$query->rowCount();


$sum_total = $leavtypcount - $dptcount1;
?>   
                                <span class="stats-counter text-white"><span class="counter"><?php echo htmlentities($leavtypcount);?></span></span>
                      
                            </div>
                           <div id="sparkline-bar"></div>
                        </div>
                                
                            </div>
                         </div>
                </div>
                 
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12 col-md-12"><br/>
						<span  style="color: #396EB0;font-weight:bold;font-size:16px">Latest Leave Applications</span><br/><br/>
                            <div class="card invoices-card border-0 shadow">
							
                                <div class="card-content" >
                                 
                                    
                             <table id="example" class="display responsive-table bg-transparent" >
                                    <thead>
                                        <tr >
                                            <th style="color: #396EB0;">Emp No.</th>
											<th style="color: #396EB0;" width="180">Employe Id</th>
                                            <th width="200" style="color: #396EB0;">Employe Name</th>
                                            <th width="120" style="color: #396EB0;">Leave Type</th>

                                             <th width="180" style="color: #396EB0;">Posting Date</th>                 
                                            <th style="color: #396EB0;">Status</th>
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id order by lid desc limit 6";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr style="color:black;">
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><?php echo htmlentities($result->EmpId);?></td>
                                              <td ><?php echo htmlentities($result->FirstName." ".$result->LastName);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                                                                       <td><?php $stats=$result->Status;
if($stats==1){
                                             ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: black">waiting for approval</span>
 <?php } ?>


                                             </td>

          <td>
           <td><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect blue waves-light btn blue darken-1"  > View Details</a></td>
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
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/plugins/chart.js/chart.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/dashboard.js"></script>
        
    </body>
</html>
<?php } ?>