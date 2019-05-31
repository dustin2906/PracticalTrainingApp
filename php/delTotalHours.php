<?php
/*
	file:	php/delTotalHours.php
	desc:	Removes record in db table supervisorhours by rowid 
			(supervisorhoursID). Returns to correct view by id (supervisorID)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
if(isset($_GET['rowid'])) $rowid=$_GET['rowid'];else $rowid='';
include('dbConnect.php');
$sql="DELETE FROM supervisorhours WHERE supervisorhoursID=$rowid";
if($conn->query($sql)===TRUE){
	header("location:../SuptrainApplication.php?page=supervisorinfo&id=$id");
}else header('location:../SuptrainApplication.php?page=error');
?>