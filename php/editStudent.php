<?php
/*
	file:	php/editStudent.php
	desc:	Form to edit student
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
echo '<h3>Edit Student</h3>';
if(isset($_SESSION['insNewstu'])) echo $_SESSION['insNewstu'];
$_SESSION['insNewstu']='';
include('dbConnect.php');
$sql="SELECT * FROM student WHERE studentID='$id'";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//student found
	$row=$result->fetch_assoc(); //results into a row
}else header('location:../SuptrainApplication.php?page=error');
?>
<div class="row">
<div class="col-sm-8">
<form action="php/updateStudent.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id?>" />
	<div class="form-group">
		<label for="studentID">StudentID</label>
		<input type="text" name="studentID" class="form-control" autofocus required 
			value="<?php echo $row['studentID']?>" />
	</div>
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" name="firstname" class="form-control" autofocus required 
			value="<?php echo $row['firstname']?>" />
	</div>
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input type="text" name="lastname" class="form-control" required 
			value="<?php echo $row['lastname']?>"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" required 
			value="<?php echo $row['email']?>"/>
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" autofocus required 
			value="<?php echo $row['phone']?>" />
	</div>
	<div class="form-group">
		<label for="practicaltrainingdone">Training Finished</label>
		<input type="text" name="practicaltrainingdone" class="form-control" required 
			value="<?php echo $row['practicaltrainingdone']?>"/>
	</div>
	<div class="form-group">
		<label for="groupname">Group name</label>
		<input type="text" name="groupname" class="form-control" autofocus required 
			value="<?php echo $row['groupname']?>" />
	</div>
	<button type="submit" class="btn btn-primary btn-block">Update</button>
</form>
</div>
<div class="col-sm-4">
	<h3>Profile image</h3>
	<form action="php/uploadImageStudent.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id?>" />
		<input type="hidden" name="folder" value="students" />
		<div class="form-group">
		 <input type="file" class="form-control" name="imagefile" required />
		</div>
		<button type="submit" class="btn btn-primary btn-lg">Upload</button>
	</form>
	<?php
	//if profileimage existst, show a button to remove it
	if(!empty($row['imagestudent'])){
		echo '<img class="img-responsive img-thumbnail" width="150px" src="img/students/'.$row['imagestudent'].'" />';
		echo '<a href="php/removeimageStudent.php?id='.$id.'&table=student"><button class="btn btn-lg btn-primary">Remove image</button></a>';
	}
	?>
 </div>
 </div>