<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{





$empid=$_SESSION['emplogin'];
$sql = "SELECT * from attendance a,tblemployees te where te.id=a.Empcode and Type='HALFDAY'";
$query = $dbh -> prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query->execute();
$hresults=$query->fetchAll(PDO::FETCH_OBJ);
$half=$query->rowCount();

$empid=$_SESSION['emplogin'];
$sql = "SELECT * from attendance a,tblemployees te where te.id=a.Empcode";
$query1 = $dbh -> prepare($sql);
$query1 -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query1->execute();
$sresults=$query1->fetchAll(PDO::FETCH_OBJ);
$short=$query1->rowCount();


$tot=$half+$shot;

$empid=$_SESSION['emplogin'];
$sql = "SELECT id SUM(DATEDIFF(FromDate,ToDate) AS Days)  from `tblleaves` tb , `tblemployees` te where te.id=tb.empid and tb.Status='1' and te.EmailId=:empid and tb.LeaveType='Casual Leave'";
$query2 = $dbh -> prepare($sql);
$query2 -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query2->execute();
$cresults=$query2->fetchAll(PDO::FETCH_OBJ);
$casual=$query2->rowCount();
echo $cresults;


$empid=$_SESSION['emplogin'];
$sql = "SELECT * from `tblleaves` tb , `tblemployees` te where te.id=tb.empid and tb.Status='1' and te.EmailId=:empid and tb.LeaveType='Medical Leave test'";
$query1 = $dbh -> prepare($sql);
$query1 -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query1->execute();
$results=$query1->fetchAll(PDO::FETCH_OBJ);
$empcount=$query1->rowCount();





            
$empid=$_SESSION['emplogin'];
$sql = "SELECT * from `tblleaves` tb , `tblemployees` te where te.id=tb.empid and tb.Status='1' and te.EmailId=:empid and tb.LeaveType='Restricted Holiday(RH)'";
$query3 = $dbh -> prepare($sql);
$query3 -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query3->execute();
$results=$query3->fetchAll(PDO::FETCH_OBJ);
$leavtypcount=$query3->rowCount();


$empid=$_SESSION['emplogin'];
$sql = "SELECT * from attendance a,tblemployees te where te.id=a.Empcode and Type='Half Day'";
$query4 = $dbh -> prepare($sql);
$query4 -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query4->execute();
$results=$query4->fetchAll(PDO::FETCH_OBJ);
$leavtypcount=$query4->rowCount();







if($result=1)
{
	
}


$empid=$_SESSION['emplogin'];
$sql = "SELECT * from attendance a,tblemployees te where te.id=a.Empcode and Type='Short Leave'";
$query7 = $dbh -> prepare($sql);
$query7 -> bindParam(':empid',$empid, PDO::PARAM_STR);
$query7->execute();
$results=$query7->fetchAll(PDO::FETCH_OBJ);
$leavtypcount=$query7->rowCount();

}
?>
