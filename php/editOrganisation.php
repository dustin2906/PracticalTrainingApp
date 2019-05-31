<?php
/*
	file:	php/editOrganisation.php
	desc:	Form to edit organisation
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
echo '<h3>Edit Organisation</h3>';
if(isset($_SESSION['insNeworg'])) echo $_SESSION['insNeworg'];
$_SESSION['insNeworg']='';
include('dbConnect.php');
$sql="SELECT * FROM organization WHERE organizationID='$id'";

$result=$conn->query($sql);
if($result->num_rows > 0){
	//organization found
	$row=$result->fetch_assoc(); //results into a row
}else header('location:../SuptrainApplication.php?page=error');
?>
<form action="php/updateOrganisation.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id?>" />
	<div class="form-group">
		<label for="organizationID">OrganisationID</label>
		<input type="text" name="organizationID" class="form-control" autofocus required 
			value="<?php echo $row['organizationID']?>" />
	</div>
	<div class="form-group">
		<label for="name">name</label>
		<input type="text" name="name" class="form-control" autofocus required 
			value="<?php echo $row['name']?>" />
	</div>
	<div class="form-group">
		<label for="contactperson">Contact person</label>
		<input type="text" name="contactperson" class="form-control" required 
			value="<?php echo $row['contactperson']?>"/>
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
		<label for="address">Address</label>
		<input type="text" name="address" class="form-control" autofocus required 
			value="<?php echo $row['address']?>" />
	</div>
	<button type="submit" class="btn btn-primary btn-block">Update</button>
</form>