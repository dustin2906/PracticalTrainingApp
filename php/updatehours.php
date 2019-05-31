<?php
/*
	file:	php/updatehours.php
	desc:	Updates supervisorhours-table. Rowid tells which supervisorhoursID
			to update. Id is used to go back to correct supervisorview
*/
if(!empty($_POST)){
	$id=$_POST['id'];
	$rowid=$_POST['rowid'];
	$year=$_POST['year'];
	$hours=$_POST['hours'];
	include('dbConnect.php');
	$sql="UPDATE supervisorhours SET year=$year, hours=$hours	
			WHERE supervisorhoursID=$rowid";
	if($conn->query($sql)===TRUE){
		header("location:../SuptrainApplication.php?page=supervisorinfo&id=$id");
	}else header('location:../SuptrainApplication.php?page=error');
}else header('location:../SuptrainApplication.php?page=error');
?>