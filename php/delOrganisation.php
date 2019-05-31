<?php
/*
	file:	php/delOrganisation.php
	desc:	Removes record in db table organization. Returns to correct view by id (organizationID)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
include('dbConnect.php');
$sql="DELETE FROM organization WHERE organizationID='$id'";
if($conn->query($sql)===TRUE){
	echo "deleted successfully";
	header("location:../SuptrainApplication.php?page=organisations");
}else header('location:..SuptrainApplication.php?page=error');
$conn->close();
?>