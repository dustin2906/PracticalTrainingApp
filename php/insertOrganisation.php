<?php
/*
	file: php/insertOrganisation.php
	desc: Inserts into organization-table if all the fields have values and
		  email is not already in database
*/
if(!empty($_POST)){
	//inserting into database if ok
	
	$id=$_POST['organizationID'];
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
	};
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNeworg']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	//check that email is not already in database table organization-table
	include('dbConnect.php');
	$sql="SELECT email FROM organization WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNeworg']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	if(!$error){
		//insert into database
		
		$sql="INSERT INTO organization (organizationID,name,email,phone,contactperson,address)
				VALUES('$id','$name','$email','$phone','$contactperson','$address')";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNeworg']='<p class="alert alert-success">Organisation added!</p>';
			//get the id of inserted record->can go to edit page
			header('location:../SuptrainApplication.php?page=newOrganisation');
		}else{
			$_SESSION['insNeworg']='<p class="alert alert-danger">Was not able to insert!</p>';
			header('location:../SuptrainApplication.php?page=newOrganisation');
		}
	}else header('location:../SuptrainApplication.php?page=newOrganisation');
}else header('location:../SuptrainApplication.php');
?>



