<?php
/*
	file:	php/delTraining.php
	desc:	Removes record in db table training. Returns to correct view by id (trainingID)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
if(isset($_GET['rowid'])) $rowid=$_GET['rowid'];else $rowid='';
include('dbConnect.php');
$sql="DELETE FROM training WHERE trainingID=$rowid";
if($conn->query($sql)===TRUE){
	header("location:../SuptrainApplication.php?page=studentInfo&id=$id");
}else header('location:../SuptrainApplication.php?page=error');
?>