<?php
/*
	file: php/getOrganizations.php
	desc: Gets organizations from database and puts the 
		  results into JSON-data object.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
if(isset($_SESSION['user'])){
	$JSON = array(); //array for results as JSON
	include('dbConnect.php');
	$sql="SELECT * FROM organization ORDER BY name";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		$JSON["organizations"][]=$row; //name of JSON-array "organizations"
	}
	echo json_encode($JSON); //encodes the data into JSON-object
}else echo 'Fail';
?>