<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['add']))
{
function clean($value)
{
	$value = trim($value);
	$value = stripcslashes($value);
	$value = strip_tags($value);
	
	return $value;
}

	

$empid=clean($_POST['empcode']);
$nwi=clean($_POST['namewithinitials']);
$fname=clean($_POST['firstName']);
$lname=clean($_POST['lastName']);   
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$gender=$_POST['gender']; 
$dob=clean($_POST['dob']); 
$team=clean($_POST['team']); 
$DOJ=clean($_POST['DOJ']); 
$des=clean($_POST['designation']);
$qua=clean($_POST['qualifications']);
$supervisor=clean($_POST['supervisor']);
$address=clean($_POST['address']); 
$mobileno=clean($_POST['mobileno']); 
$status=1;

if(!empty($empid)AND !empty($nwi)AND !empty($fname)AND !empty($lname)AND !empty($email)AND !empty($password)AND !empty($supervisor)AND !empty($designation)AND !empty($description))
{
$sql="INSERT INTO tblemployees(EmpId,NamewithInitials,FirstName,LastName,EmailId,Password,Gender,Dob,Team,DOJ,Designation,Qualifications,Supervisor,Address,Phonenumber,Status)VALUES(:empid,:nwi,:fname,:lname,:email,:password,:gender,:dob,:team,:DOJ,:des,:qua,:supervisor,:address,:mobileno,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':nwi',$nwi,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':team',$team,PDO::PARAM_STR);

$query->bindParam(':DOJ',$DOJ,PDO::PARAM_STR);
$query->bindParam(':des',$des,PDO::PARAM_STR);
$query->bindParam(':qua',$qua,PDO::PARAM_STR);
$query->bindParam(':supervisor',$supervisor,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Employee record added Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}
else {
	echo "You Must Complete All From Flieds";
}



}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Add Employee</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
         <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
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
        </style>
    <script type="text/javascript">
function valid()
{
if(document.addemp.password.value!= document.addemp.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.addemp.confirmpassword.focus();
return false;
}
return true;
}
</script>

<script>
function checkAvailabilityEmpid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'empcode='+$("#empcode").val(),
type: "POST",
success:function(data){
$("#empid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailabilityEmailid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#emailid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script>
$(function () {
        //Normal Configuration
        $("[id*=qualifications]").MaxLength({ MaxLength: 10 });
 
</script>


    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="color: #396EB0;font-weight:bold;font-size:16px">Add employee</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>


<div class="input-field col  s12">
<label for="empcode">Employee Code(Must be unique)</label>
<input  name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="Namewithinitials">Name with Initials</label>
<input  name="namewithinitials" id="namewithinitials" type="text"  >
</div>


<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="firstName" type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Last name</label>
<input id="lastName" name="lastName" type="text" autocomplete="off" required>
</div>


<div class="input-field col m6 s12">
<label for="fromdate">Date of Birth</label>
<input placeholder="" name="dob" type="text" onfocus="(this.type = 'date')"  id="date">
</div>


<div class="input-field col m6 s12">
<select  name="gender" autocomplete="off">
<option value="">Gender...</option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
</div>


<div class="input-field col s12">
<label for="address">Address</label>
<input id="address" name="address" type="tel" maxlength="50" autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="password">Password</label>
<input id="password" name="password" type="password" autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="confirm">Confirm password</label>
<input id="confirm" name="confirmpassword" type="password" autocomplete="off" required>
</div>


<div class="input-field col m6 s12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" maxlength="10" autocomplete="off" required>
 </div>

</div>
</div>
                                                                                                     

<div class="input-field col m6 s12">
<select  name="team" autocomplete="off">
<option value="">Team</option>
<?php $sql = "SELECT DepartmentName from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->DepartmentName);?>"><?php echo htmlentities($result->DepartmentName);?></option>
<?php }} ?>
</select>
</div>

<div class="input-field col m6 s12">
<label for="supervisor">Immeadiate Supervisor</label>
<input id="supervisor" name="supervisor" type="text" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="fromdate">Date of Join</label>
<input placeholder="" name="DOJ" type="text" onfocus="(this.type = 'date')"  id="date" required>
</div>


<div class="input-field col m6 s12">
<label for="designation">Designation</label>
<input id="designation" name="designation" type="text" autocomplete="off" required><br/>
</div>
 
<div class="input-field col m6 s12"><br/>
<label for="description" style="font-size:14px">Educational Qualifications</label><br>
<textarea onkeydown="maximumChars(500,this)" style="width:770px" class="comment" id="qualifications" maxlength="500" name="qualifications" title="1/500">
</textarea>
<div>Total Characters: <span id="maxChars"> 0</span></div>

</div>

<div class="input-field col s12" style="margin-top: 30px;">
<button type="submit" name="add" onclick="return valid();" id="add" class="waves-effect blue waves-light btn blue darken-1">Submit</button>

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
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 