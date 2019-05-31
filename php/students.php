<?php
/*
	file: php/students.php
	desc: Gets all the students from database and puts the 
		  results into JSON-data object.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
if(isset($_SESSION['user'])){
	if(isset($_GET['search'])) $search=$_GET['search'];else $search='%%';
	if(isset($_GET['group'])) $group=$_GET['group'];else $group='';
	$JSON = array(); //array for results as JSON
	include('dbConnect.php');
	$sql="SELECT * FROM student ";
	if(empty($group)){
		$sql.="WHERE lastname LIKE '%%$search%%' OR firstname LIKE '%%$search%%'
		OR groupname LIKE '%%$search%%'";
	}else $sql.="WHERE groupname='$group'";
	$sql.="	ORDER BY lastname, firstname";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		$JSON["students"][]=$row; //name of JSON-array "students"
	}
	echo json_encode($JSON); //encodes the data into JSON-object
}else echo 'Fail';
?>