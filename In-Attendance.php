<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['add']))
{

$emp=$_SESSION['emplogin'];
$empid=$_POST['empcode'];
$sql="INSERT INTO attendance(Empcode,EmailId,InTime,OutTime,CurDate,Type)VALUES(:empid,:emp,NOW(),NULL,CURDATE(),NULL)";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':emp',$emp,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$error="Employee record added Successfully";
}
else 
{
$msg="Employee record added Successfully";
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
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
         <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
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
	  
 body {
    font-family: "Work Sans", sans-serif;
 
    background: rgb(230, 230, 230);
}
.time { 
    margin:100px auto;
    background: gray;
    color: #fff;
    border: 7px solid rgb(255, 252, 252);
    box-shadow: 0 2px 10px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    padding: 8px;
    text-align: center;
    width: 300px;
}
.hms {
    font-size: 30pt;
    font-weight: 200;
}
.ampm {
    font-size: 22pt;
}
.date {
    font-size: 15pt;
}
.topnav {
  position: relative;
  overflow: hidden;
  background-color: #003A6B;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
 
  color: white;
}

.topnav-centered a {
  float: left;
  padding: 14px 16px;
  position: absolute;
  top: 50%;
  left: 45%;
  transform: translate(-50%, -50%);
  font-weight:bold;
}
.topnav-centered1 a:hover {
    background-color:white;
    color: black;
}

.topnav-centered1 a {
  float: left;
  padding: 14px 16px;
  position: absolute;
  top: 50%;
  left: 55%;
  transform: translate(-50%, -50%);
   font-weight:bold;
}
.topnav-centered a:hover {
    background-color:white;
    color: black;
}

.logo img {
   margin-left: 2.3em;
   max-width: 100%;
   height: auto !important;
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



    </head>
    <body>

     <div class="topnav">
 <div class="topnav-centered">
    <a href="admin/" class="active">Admin Login</a>
     
  </div>
  <div class="topnav-centered1">
    <a href="index.php" class="active">Employee Login</a>
    
  </div>           
    <div class="logo">
		     <img src="Untitled-1.png" style="width:170px;height:200px">
            </div>
            
      </div>       
   
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                       
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card" style="margin:auto;width:500px;margin-left:auto;padding:10px;height:578px">
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


<div class="time" style="margin-top:10px;margin-left:60px">
        <span class="hms"></span>
        <span class="ampm"></span>
        <br>
        <span class="date"></span>
      </div>


<div style="margin-left:130px">
<label for="empcode" style="text-size:10px;display: block; width: 500px;">Employee Code(Must be unique)</label>
<input  name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" style="width: 170px;" type="text" autocomplete="off" required>
<span id="empid-availability" style="font-size:12px;"></span> 
<button type="submit" name="add" style="margin-left:35px;" onclick="return valid();" id="add" class="waves-effect blue waves-light btn blue darken-1">Submit</button>
</div>


<div class="input-field col s12" style="margin-top: 30px;">


</div>

</div>
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
        <script>
		 function updateTime() {
  var dateInfo = new Date();

  /* time */
  var hr,
    _min = (dateInfo.getMinutes() < 10) ? "0" + dateInfo.getMinutes() : dateInfo.getMinutes(),
    sec = (dateInfo.getSeconds() < 10) ? "0" + dateInfo.getSeconds() : dateInfo.getSeconds(),
    ampm = (dateInfo.getHours() >= 12) ? "PM" : "AM";

  // replace 0 with 12 at midnight, subtract 12 from hour if 13–23
  if (dateInfo.getHours() == 0) {
    hr = 12;
  } else if (dateInfo.getHours() > 12) {
    hr = dateInfo.getHours() - 12;
  } else {
    hr = dateInfo.getHours();
  }

  var currentTime = hr + ":" + _min + ":" + sec;

  // print time
  document.getElementsByClassName("hms")[0].innerHTML = currentTime;
  document.getElementsByClassName("ampm")[0].innerHTML = ampm;

  /* date */
  var dow = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday"
    ],
    month = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ],
    day = dateInfo.getDate();

  // store date
  var currentDate = dow[dateInfo.getDay()] + ", " + month[dateInfo.getMonth()] + " " + day;

  document.getElementsByClassName("date")[0].innerHTML = currentDate;
};

// print time and date once, then update them every second
updateTime();
setInterval(function() {
  updateTime()
}, 1000);


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
