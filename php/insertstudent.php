<?php
/*
	file: php/insertSupervisor.php
	desc: Inserts into supervisor-table if all the fields have values and
		  email is not already in database
*/
if(!empty($_POST)){
	//inserting into database if ok
	
	$id=$_POST['studentID'];
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
	};
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNewstu']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	//check that email is not already in database table supervisor-table
	include('dbConnect.php');
	$sql="SELECT email FROM student WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNewstu']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	if(!$error){
		//insert into database
		
		$sql="INSERT INTO student (studentID,firstname,lastname,email,phone,practicaltrainingdone,groupname)
				VALUES('$id','$firstname','$lastname','$email','$phone','$practicaltrainingdone','$groupname')";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewstu']='<p class="alert alert-success">Student added!</p>';
			//get the id of inserted record->can go to edit page
			header('location:../SuptrainApplication.php?page=newStudent');
		}else{
			$_SESSION['insNewstu']='<p class="alert alert-danger">Was not able to insert!</p>';
			header('location:../SuptrainApplication.php?page=newStudent');
		}
	}else header('location:../SuptrainApplication.php?page=newStudent');
}else header('location:../SuptrainApplication.php');
?>



