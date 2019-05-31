<?php
/*
	file:	php/delSupervisor.php
	desc:	Removes record in db table organization. Returns to correct view by id (organizationID)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
include('dbConnect.php');
$sql="DELETE FROM supervisor WHERE supervisorID='$id'";
if($conn->query($sql)===TRUE){
	echo "deleted successfully";
	header("location:../SuptrainApplication.php?page=supervisors");
}else header('location:../SuptrainApplication.php?page=error');
$conn->close();
?>