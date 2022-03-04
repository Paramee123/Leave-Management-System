<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
$eid=$_SESSION['emplogin'];
if(isset($_POST['update']))
{

$fname=clean($_POST['firstName']);
$lname=clean($_POST['lastName']);   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$team=$_POST['team']; 
$address=clean($_POST['address']); 
$mobileno=$_POST['mobileno'];
$DOJ=$_POST['DOJ']; 
$des=$_POST['designation'];
$qua=clean($_POST['qualifications']);
$supervisor=$_POST['supervisor'];
$nwi=clean($_POST['namewithinitials']);

 if(!empty($fname) AND !empty($lname) AND !empty($address) AND !empty($nwi) AND !empty($qua)){
$sql="update tblemployees set NamewithInitials=:nwi,FirstName=:fname,LastName=:lname,Gender=:gender,DOJ=:DOJ,Dob=:dob,Team=:team,Address=:address,Designation=:des,Qualifications=:qua,Supervisor=:supervisor,Phonenumber=:mobileno where EmailId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':team',$team,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->bindParam(':DOJ',$DOJ,PDO::PARAM_STR);
$query->bindParam(':des',$des,PDO::PARAM_STR);
$query->bindParam(':qua',$qua,PDO::PARAM_STR);
$query->bindParam(':nwi',$nwi,PDO::PARAM_STR);
$query->bindParam(':supervisor',$supervisor,PDO::PARAM_STR);
$query->execute();
$msg="Employee record updated Successfully";
}
}
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Update Employee</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.comment {
        resize: none;
        height: 300px;
        width: 600px;
      }  
      
@page {
   margin: 0;
}
            </style>



<script type="text/javascript">
    function Validate() {
        //Regex for Valid Characters i.e. Alphabets, Numbers and Space.
        var regex = /^[A-Za-z0-9 ]+$/
 
        //Validate TextBox value against the Regex.
        var isValid1 = regex.test(document.getElementById("firstName").value);
		var isValid2 = regex.test(document.getElementById("lastName").value);
		var isValid3 = regex.test(document.getElementById("address").value);
		var isValid4 = regex.test(document.getElementById("supervisor").value);
		var isValid5 = regex.test(document.getElementById("designation").value);
		var isValid6 = regex.test(document.getElementById("qualifications").value);
        if (!isValid1 & !isValid2 & !isValid3 & !isValid4 & !isValid5 & !isValid6) {
            alert("Contains Special Characters.");
        } else {
            alert("Does not contain Special Characters.");
        }
 
        return isValid;
    }


</script>



    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="color: green;">Update employee details</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
<?php 
$eid=$_SESSION['emplogin'];
$sql = "SELECT * from  tblemployees where EmailId=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
 <div class="input-field col  s12">
<label for="empcode">Employee Code</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text" autocomplete="off" readonly required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="Namewithinitials">Name with Initials</label>
<input  name="namewithinitials" id="namewithinitials" maxlength="30" type="text"  >
</div>


<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>" maxlength="10"  type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Last name </label>
<input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" maxlength="20" type="text" autocomplete="off" required>
</div>


<div class="input-field col m6 s12">
<label for="fromdate">Date of Birth</label>
<input placeholder="" name="dob" type="text" onfocus="(this.type = 'date')"  id="date">
</div>


<div class="input-field col m6 s12">
<label for="gender">Gender</label>
<input id="gender" name="gender" type="text"  value="<?php echo htmlentities($result->Gender);?>" readonly autocomplete="off" required>

</div>

<div class="input-field col m6 s12">
<label for="address">Address</label>
<input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" maxlength="50" autocomplete="off" required>
</div>
<?php }}?>

<div class="input-field col s12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required>
 </div>

</div>
</div>
     
	 
<div class="input-field col m6 s12">
<label for="Team">Team</label><br/>
<input id="team" name="team" type="text" value="<?php echo htmlentities($result->Department);?>" readonly autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="supervisor">Immeadiate Supervisor</label>
<input id="supervisor" name="supervisor" type="text" readonly autocomplete="off" required>
</div>


<div class="input-field col m6 s12">
<label for="fromdate">Date of Join</label>
<input placeholder="" name="DOJ" type="text" onfocus="(this.type = 'date')"  id="date" required>
</div>

<div class="input-field col m6 s12">
<label for="designation">Designation</label>
<input id="designation" name="designation" type="text" readonly autocomplete="off" required>
</div>
 
<div class="input-field col m6 s12">
<textarea onkeydown="maximumChars(500,this)"  class="comment" id="qualifications" name="qualifications"> 
</textarea>
<div>Total Characters: <span id="maxChars"> 0</span></div>
</div>                                                  

<div class="input-field col s12">
<button type="submit" name="update" onclick="Validate() id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>
<button name="printprev"  class="waves-effect waves-light btn indigo m-b-xs" ><a href="myprof.php"  style="color:white">Print</a></button>
</div>





                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        <script type="text/javascript">
  var maximumChars= function(maxChars, input){
 
    var totalChars= input.value.length;
    var displayChars=document.getElementById('maxChars');
    
    if(maxChars>totalChars){
     displayChars.innerHTML=totalChars+" out of "+maxChars;
     displayChars.style.color="green";
     input.style.borderColor = "green";
    }else{
     displayChars.innerHTML="Maximum "+maxChars+" characters are allowed";
     displayChars.style.color="red";
     input.style.borderColor = "red";
    }
}
</script>
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 