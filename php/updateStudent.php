<?php
/*
	file: php/updateStudent.php
	desc: Updates supervisor-table if all the fields have values and
		  email is not already in database. Update by the field supervisorID
*/
if(!empty($_POST)){
	//updating  database if ok
	
	$id=$_POST['id'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$groupname=$_POST['groupname'];
	$practicaltrainingdone=$_POST['practicaltrainingdone'];
	$error=false;	
	session_start();
	$_SESSION['insNewstu']='';
	if(empty($id) OR empty($firstname) OR empty($lastname) OR empty($phone) OR empty($groupname)){
		$_SESSION['insNewstu']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNewstu']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	
	include('dbConnect.php');

	
	if(!$error){
		//update database
		$sql="UPDATE student SET studentID='$id', firstname='$firstname', 
			lastname='$lastname', email='$email', phone='$phone', practicaltrainingdone='$practicaltrainingdone', groupname='$groupname'
			WHERE studentID='$id'";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewstu']='<p class="alert alert-success">Student updated!</p>';
			header("location:../SuptrainApplication.php?page=editStudent&id=$id");
		}else{
			$_SESSION['insNewstu']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../SuptrainApplication.php?page=editStudent&id=$id");
		}
	}else header("location:../SuptrainApplication.php?page=editStudent&id=$id");
}else header('location:../SuptrainApplication.php');
?>