<?php
/*
	file: php/removeimageStudent.php
	desc: Removes profile imagefile and updates table
*/
if(isset($_GET['id'])) $id=$_GET['id'];
include('dbConnect.php');
$sql="SELECT imagestudent FROM student WHERE studentID='$id'";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()) $image=$row['imagestudent'];
$sql="UPDATE student SET imagestudent='' WHERE studentID='$id'";
if($conn->query($sql)===TRUE){
	session_start();
	$target_dir="../img/students/";
	unlink($target_dir.$image); //removes the imagefile
	$_SESSION['insNewstu']='<p class="alert alert-success">Image removed!</p>';
	header("location:../SuptrainApplication.php?page=editStudent&id=$id");
}else{
	$_SESSION['insNewstu']='<p class="alert alert-alert">Failed!</p>';
	header("location:../SuptrainApplication.php?page=editStudent&id=$id");
}
?>