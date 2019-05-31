<?php
/*
	file: php/addTraining.php
	desc: Gets id of student,supervisor, organization, supervisorhours, start, end and inserts into 
			Training table
*/
if(!empty($_POST)){
	$id=$_GET['id'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$place=$_POST['organizationID'];
	$supervisor=$_POST['supervisorID'];
	$supervisorhours=$_POST['supervisorhours'];
	include('dbConnect.php');
	$sql="INSERT INTO training (studentID,start,end,organizationID,supervisorID,supervisorhours) 
			VALUES('$id','$start','$end','$place','$supervisor','$supervisorhours')";
	if($conn->query($sql)===TRUE){ echo "success";
		header("location:../SuptrainApplication.php?page=studentInfo&id=$id");
	}else header('location:../SuptrainApplication.php?page=error');
}else header('location:../SuptrainApplication.php');
?>
