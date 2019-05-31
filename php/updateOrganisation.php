<?php
/*
	file: php/updateOrganisation.php
	desc: Updates supervisor-table if all the fields have values and
		  email is not already in database. Update by the field supervisorID
*/
if(!empty($_POST)){
	//updating  database if ok
	
	$id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$contactperson=$_POST['contactperson'];
	$address=$_POST['address'];
	$error=false;	
	session_start();
	$_SESSION['insNeworg']='';
	if(empty($id) OR empty($name) OR empty($contactperson) OR empty($phone) OR empty($address)){
		$_SESSION['insNeworg']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNeworg']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	//check that email is not already in database table supervisor-table
	include('dbConnect.php');
	$sql="SELECT organizationID FROM organization WHERE organizationID='$organizationID'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNeworg']='<p class="alert alert-danger">OrganizationID is already in db!</p>';
		$error=true;
	}
	
	if(!$error){
		//update database
		$sql="UPDATE organization SET organizationID='$id', name='$name', email='$email', phone='$phone',contactperson='$contactperson', address='$address'
			WHERE organizationID='$id'";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNeworg']='<p class="alert alert-success">Organisation updated!</p>';
			header("location:../SuptrainApplication.php?page=editOrganisation&id=$id");
		}else{
			$_SESSION['insNeworg']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../SuptrainApplication.php?page=editOrganisation&id=$id");
		}
	}else header("location:../SuptrainApplication.php?page=editOrganisation&id=$id");
}else header('location:../SuptrainApplication.php');
?>