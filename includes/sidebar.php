     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper" style="background-color: #003A6B">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
<?php
$eid=$_SESSION['eid'];
$sql = "SELECT * from  tblemployees where id=:eid AND Gender='Female'";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($results) {
    
?>	
                         <img src="assets/images/554857.jpg" class="circle" alt=""> 
						 
	<?php }?>
<?php
$eid=$_SESSION['eid'];
$sql = "SELECT * from  tblemployees where id=:eid AND Gender='Male'";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($results) {
    
?>	
	

					<img src="assets/images/3616927.jpg" class="circle" alt=""> 
	 
<?php } ?>
                        </div>
                        <div class="sidebar-profile-info" >
                    
					<?php 
$eid=$_SESSION['eid'];
$sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                <p style="color:#FEFEFE"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
                                <span style="color:#FEFEFE"><?php echo htmlentities($result->EmpId)?></span>
                         <?php }} ?>
                        </div>
                    </div>
              
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion" >
				
				  <li class="no-padding" ><a class="waves-effect waves-grey" href="InAttendance.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE">person</i>In Attendance</a></li>            
  <li class="no-padding" ><a class="waves-effect waves-grey" href="Out-Attendance.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE">person_outline</i>Out Attendance</a></li>            
<hr size="1" width="100%" color="white"> 
  <li class="no-padding" ><a class="waves-effect waves-grey" href="adashboard.php"  style="color:#FEFEFE"  onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE"  >perm_contact_calendar</i>Dashboard</a></li>
  <li class="no-padding" ><a class="waves-effect waves-grey" href="myprofile.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE">account_box</i>My Profiles</a></li>
  <li class="no-padding" ><a class="waves-effect waves-grey" href="emp-changepassword.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE">settings_input_svideo</i>Change Password</a></li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE">apps</i>Leaves<i class="nav-drop-icon material-icons" style="color:#FEFEFE">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul style="background-color: #003A6B">
                                <li><a href="apply-leave.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'">Apply Leave</a></li>
                                <li><a href="leavehistory.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'">Leave History</a></li>
                            </ul>
                        </div>
                    </li>
                
         
               
                  <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php" style="color:#FEFEFE" onMouseOver="this.style.color='black'"  onMouseOut="this.style.color='#FEFEFE'"><i class="material-icons" style="color:#FEFEFE">exit_to_app</i>Logout</a>
                            </li>  
                 
                   
                </ul>
                <div class="footer" style="padding:10px">
                    <p class="copyright" style="font-size:12px;color:#FEFEFE" > Sri Lanka Computer Emergency Readiness Team | Coordination Centre</p>
					
					
                
                </div>
                </div>
            </aside>