<?php
/*
	file:	php/editSupervisor.php
	desc:	Form to edit supervisor
			Displays $_SESSION['insNewMsg'] -variable if exists to show
			messages from inserting script (success or errors)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
echo '<h3>Edit Supervisor</h3>';
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
include('dbConnect.php');
$sql="SELECT * FROM supervisor WHERE supervisorID='$id'";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
}else header('location:../SuptrainApplication.php?page=error');
?>
<div class="row">
 <div class="col-sm-8">
   <h3>Basic info</h3>
   <form action="php/updateSupervisor.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id?>" />
	<div class="form-group">
		<label for="supervisorID">SupervisorID</label>
		<input type="text" name="supervisorID" class="form-control" autofocus required 
			value="<?php echo $row['supervisorID']?>" />
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
		<input type="text" name="phone" class="form-control" required 
			value="<?php echo $row['phone']?>"/>
	</div>
	<button type="submit" class="btn btn-primary btn-block">Update</button>
   </form>
 </div>
 <div class="col-sm-4">
	<h3>Profile image</h3>
	<form action="php/uploadImage.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id?>" />
		<input type="hidden" name="folder" value="supervisors" />
		<div class="form-group">
		 <input type="file" class="form-control" name="imagefile" required />
		</div>
		<button type="submit" class="btn btn-primary btn-lg">Upload</button>
	</form>
	<?php
	//if profileimage existst, show a button to remove it
	if(!empty($row['image'])){
		echo '<img class="img-responsive img-thumbnail" width="150px" src="img/supervisors/'.$row['image'].'" />';
		echo '<a href="php/removeimage.php?id='.$id.'&table=supervisor"><button class="btn btn-lg btn-primary">Remove image</button></a>';
	}
	?>
 </div>
</div>




