<?php
/*
	file: php/getStudent.php
	desc: Get one student based on the studentID from database and puts the 
		  results into JSON-data object.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
if(isset($_SESSION['user'])){
	if(isset($_GET['studentID'])) $studentID=$_GET['studentID'];else $studentID='';
	$JSON = array(); //array for results as JSON
	include('dbConnect.php');
	$sql="SELECT * FROM student WHERE studentID='$studentID'";
	$sql.="	ORDER BY lastname, firstname";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		$JSON["students"][]=$row; //name of JSON-array "students"
	}
	echo json_encode($JSON); //encodes the data into JSON-object
}else echo 'Fail';
?>