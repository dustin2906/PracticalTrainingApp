<?php
/*
	file:	php/updatePassword.php
	desc:	Reads the old pw, new pw and retyped pw from the form
			Checks that old is correct (from db) and new pw and retyped pw
			are the same. If everything ok, update user table 
			where $_SESSION['userID'] is same as table userID
*/
if(!empty($_POST)){ 	
	//coming from the form
	include('dbConnect.php');
	session_start();
	$sql="SELECT password FROM user WHERE userID=".$_SESSION['userID'];
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//start checking passwords
		$oldpw=$_POST['inputPassword'];
		$newpw=$_POST['newPassword'];
		$newpw1=$_POST['newPassword1'];
		$row=$result->fetch_assoc();
		if(password_verify($oldpw,$row['password'])){
			//old given correctly
			if($newpw==$newpw1){
				//update the password
				$newpassword=password_hash($newpw,PASSWORD_DEFAULT);
				$sql="UPDATE user SET password='$newpassword'
					WHERE userID=".$_SESSION['userID'];
				if($conn->query($sql)=== TRUE){
					//the update query was successfull
					$_SESSION['pwdChange']='Password changed!';
					header('location:../SuptrainApplication.php?page=userinfo');
				}else{
					$_SESSION['pwdChange']='Could not update the password!';
					header('location:../SuptrainApplication.php?page=userinfo');
				}
			}else{
				$_SESSION['pwdChange']='New passwords do not match!';
				header('location:../SuptrainApplication.php?page=userinfo');
			}
		}else{
			$_SESSION['pwdChange']='Type the old password correctly!';
			header('location:../SuptrainApplication.php?page=userinfo');
		}
	}else{
		$_SESSION['pwdChange']='Not able to reach the user!';
		header('location:../SuptrainApplication.php?page=userinfo');
	}
}else header('location:../SuptrainApplication.php');
?>