<?php
/*
	file: php/addhours.php
	desc: Gets id of supervisor, hours and year and inserts into 
			supervisorhours-table
*/
if(!empty($_POST)){
	$id=$_POST['id'];
	$year=$_POST['year'];
	$hours=$_POST['hours'];
	include('dbConnect.php');
	$sql="INSERT INTO supervisorhours(supervisorID,year,hours) 
			VALUES($id,$year,$hours)";
	if($conn->query($sql)===TRUE){
		header("location:../SuptrainApplication.php?page=supervisorinfo&id=$id");
	}else header('location:../SuptrainApplication.php?page=error');
}else header('location:../SuptrainApplication.php');
?>