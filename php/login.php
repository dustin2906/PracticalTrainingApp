<?php
/*
	file:	php/login.php
	Desc: 	Checks if login is ok. Adds SESSION-variables user and userID
			to session. 
			Returns status = ok and the name of user as JSON-data
*/
header("Access-Control-Allow-Origin: * ");
if(!empty($_POST)){  
	//coming from the form
	$email=$_POST['inputEmail'];
	$password=$_POST['inputPassword'];
	include('dbConnect.php');
	$sql="SELECT userID,password,firstname,lastname FROM user
			WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//found the email given in form + other fields 
		$password=$conn->real_escape_string($password); //removes unwanted characters
		$row=$result->fetch_assoc();	//get the row results
		if(password_verify($password,$row['password'])){
			//login ok
			session_start();
			$_SESSION['user']=$row['firstname'].' '.$row['lastname'];
			$_SESSION['userID']=$row['userID'];
			$JSON='{"status":"ok","user":"'.$_SESSION['user'].'"}';
		}else $JSON='{"status":"fail"}';	//passwords did not match
	}else $JSON='{"status":"fail"}';		//email was not found
}else $JSON='{"status":"fail"}';
echo $JSON; //return the answer of this login as JSON-text
?>


