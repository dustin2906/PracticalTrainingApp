<?php
/*
	file: php/getTraining.php
	desc: Gets students training data from database and puts the 
		  results into JSON-data object.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
if(isset($_SESSION['user'])){
	if(isset($_GET['studentID'])) $studentID=$_GET['studentID'];else $studentID='';
	$JSON = array(); //array for results as JSON
	include('dbConnect.php');
	$sql="SELECT start,end,name,supervisor.firstname,supervisor.lastname FROM training
			INNER JOIN student
			ON training.studentID=student.studentID
			INNER JOIN organization
			ON training.organizationID=organization.organizationID
			INNER JOIN supervisor
			ON training.supervisorID=supervisor.supervisorID
			WHERE training.studentID='$studentID'
			ORDER BY start DESC";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		$JSON["trainings"][]=$row; //name of JSON-array "students"
	}
	echo json_encode($JSON); //encodes the data into JSON-object
}else echo 'Fail';
?>