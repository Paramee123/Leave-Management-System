<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:myprof.php');
}
else{
$eid=$_SESSION['emplogin'];

}
    ?>


<!DOCTYPE html>
<html>
  <head>
    <title>Title of the document</title>
    <style>
      div {
        margin-bottom: 10px;
      }
      label {
        display: inline-block;
        width: 200px;
		padding:20px;
        color: black;
		font-weight: bold;
	
      }
      input {
        padding:  5px;
		border: none;
		outline:none;
		width:500px;
		font-weight: bold;
      }
	  .card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}


.button {
  border-radius: 4px;
  background-color: #04AA6D;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 2px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
    </style>
	
<script type="text/javascript">
            function printSection(el){
                var getFullContent = document.body.innerHTML;
                var printsection = document.getElementById(el).innerHTML;
                document.body.innerHTML = printsection;
                window.print();
                document.body.innerHTML = getFullContent;
            }
        </script>

  </head>
  <body>
 
    <form action="/form/submit" method="post">
	
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
 <div class="card" id="card">
 <br/><br/><br/>
 <img src="logo-b.png" height="100px" width="300px">
      <div>
        <label for="name">Employee Code:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->EmpId);?>" type="text" autofocus readonly />
      </div>
	  <div>
        <label for="name">Name With Initials:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->NamewithInitials);?>" type="text" autofocus readonly />
      </div>
	  <div>
        <label for="name">First Name:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->FirstName);?>" type="text" autofocus readonly />
      </div>
	  <div>
        <label for="name">Last Name:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->LastName);?>" type="text" autofocus readonly />
      </div>
      <div>
        <label for="name">Email:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->EmailId);?>" type="text" autofocus readonly />
      </div>
      <div>
        <label for="name">Date of Birth:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->Dob);?>" type="text" autofocus readonly />
      </div>
      <div>
        <label for="name">Team:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->Team);?>" type="text" autofocus readonly />
      </div>
      <div>
        <label for="name">Immeadiate Supervisor:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->Supervisor);?>" type="text" autofocus readonly />
      </div>
	   <div>
        <label for="name">Designation:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->Designation);?>" type="text" autofocus readonly />
      </div>
      <div>
        <label for="name">Qualifications:</label>
        <input id="name" name="username" value="<?php echo htmlentities($result->Qualifications);?>" type="text" autofocus readonly />
      </div>
      
	  
	  
<?php }}?>	  
</div>	
	
  
    </form>
<button class="button" onclick="printSection('card')"><span>Print this page</span></button>
  </body>
</html>