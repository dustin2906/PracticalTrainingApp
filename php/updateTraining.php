<?php
/*
	file:	php/updateTraining.php
	
*/
if(!empty($_POST)){
	$id=$_POST['id'];
	$rowid=$_POST['rowid'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$place=$_POST['organizationID'];
	$supervisor=$_POST['supervisorID'];
	$supervisorhours=$_POST['supervisorhours'];
	include('dbConnect.php');
	$sql="UPDATE training SET studentID='$id',start='$start', end='$end',organizationID='$place',supervisorID='$supervisor',supervisorhours='$supervisorhours'	
			WHERE trainingID=$rowid";
	if($conn->query($sql)===TRUE){
		header("location:../SuptrainApplication.php?page=studentInfo&id=$id");
	}else header('location:../SuptrainApplication.php?page=error');
}else header('location:../SuptrainApplication.php?page=error');
?>