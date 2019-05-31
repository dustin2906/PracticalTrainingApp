<?php
/*
	file:	php/uploadImageStudent.php
	desc:	Uploads selected imagefile into given folder.
			Finally updates database table student with imagefile name
*/
if(empty($_POST)) header('location:../SuptrainApplication.php');
else{
	session_start();
	$id=$_POST['id']; 		  //supervisorID or studentID etc
	$folder=$_POST['folder']; //which folder under images to save file
	$imagefile=basename($_FILES['imagefile']['name']); //name of the file
	$target_dir="../img/$folder/"; //defining the folder to save file
	$target_file=$target_dir.$id.'_'.$imagefile; //this is used later
	$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$uploadOk=1; //this is used to check if error happens somewhere in script
	//checking of different file properties later here
	// Check if image file is a actual image or fake image
	if(isset($_POST["folder"])) {
		$check = getimagesize($_FILES["imagefile"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$_SESSION['insNewstu']='<p class="alert alert-info">File is not an image.</p>';
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$_SESSION['insNewstu']='<p class="alert alert-info">Sorry, file already exists.</p>';
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["imagefile"]["size"] > 500000) {
		$_SESSION['insNewstu']='<p class="alert alert-info">Sorry, your file is too large.</p>';
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$_SESSION['insNewstu']='<p class="alert alert-info">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>';
		$uploadOk = 0;
	}
	//if all the checking is ok, upload the file
	if($uploadOk==0){
		//something went wrong when checking the properties
		header("location:../SuptrainApplication.php?page=editStudent&id=$id");
	}else{
		//upload the file
		if(move_uploaded_file($_FILES['imagefile']['tmp_name'],$target_file)){
			//update database
			include('dbConnect.php');
			if($folder=='students') $table='student';
			if($folder=='supervisors') $table='supervisor';
			$idfield=$table.'ID';
			$filename=$id.'_'.$imagefile; //filename used in database
			$sql="UPDATE $table SET imagestudent='$filename' WHERE $idfield='$id'";
			if($conn->query($sql)===TRUE){
				$_SESSION['insNewstu']='<p class="alert alert-success">File uploaded!</p>';
				header("location:../SuptrainApplication.php?page=editStudent&id=$id");
			}else{
				//could not update database -> remove image from filesystem
				unlink($target_dir.$filename); //removes the file
				$_SESSION['insNewstu']='<p class="alert alert-alert">Database not updated!</p>';
				header("location:../SuptrainApplication.php?page=editStudent&id=$id");
			}
		}else{
			$_SESSION['insNewstu']='<p class="alert alert-info">File upload failed!</p>';
			header("location:../SuptrainApplication.php?page=editStudent&id=$id");
		}
	}
}
?>


