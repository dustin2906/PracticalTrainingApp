<?php
/*
	file:	php/delStudent.php
	desc:	Removes record in db table student. Returns to correct view by id (studentID)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
include('dbConnect.php');
$sql="DELETE FROM student WHERE studentID='$id'";
if($conn->query($sql)===TRUE){
	echo "deleted successfully";
	header("location:../SuptrainApplication.php?page=allstudents");
}else header('location:../SuptrainApplication.php?page=error');
$conn->close();
?>