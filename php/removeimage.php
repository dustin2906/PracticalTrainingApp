<?php
/*
	file: php/removeimage.php
	desc: Removes profile imagefile and updates table
*/
if(isset($_GET['id'])) $id=$_GET['id'];
include('dbConnect.php');
$sql="SELECT image FROM supervisor WHERE supervisorID=$id";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()) $image=$row['image'];
$sql="UPDATE supervisor SET image='' WHERE supervisorID=$id";
if($conn->query($sql)===TRUE){
	session_start();
	$target_dir="../img/supervisors/";
	unlink($target_dir.$image); //removes the imagefile
	$_SESSION['insNewMsg']='<p class="alert alert-success">Image removed!</p>';
	header("location:../SuptrainApplication.php?page=editSupervisor&id=$id");
}else{
	$_SESSION['insNewMsg']='<p class="alert alert-alert">Failed!</p>';
	header("location:../SuptrainApplication.php?page=editSupervisor&id=$id");
}
?>