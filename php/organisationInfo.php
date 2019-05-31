<?php
/*
	file:	php/organisationInfo.php
	desc:	Shows info about the selected place.
*/
if(isset($_GET['id'])) $id=$_GET['id']; 
else header('location:SuptrainApplication.php?page=organisations');
if(isset($_GET['edit'])) $edit=$_GET['edit'];else $edit=''; 
include('dbConnect.php');
$sql="SELECT * FROM organization WHERE organizationID='$id'";

$result=$conn->query($sql);
if($result->num_rows > 0){
	//organization found
	$row=$result->fetch_assoc(); //results into a row
?>
<h1 class="h3 mb-3 font-weight-normal">Organisations Information</h1>
<div class="card d-inline-flex mystyle">
  <div class="text-center">
	<img class="img-responsive img-thumbnail" width="150" height="150" src="img/map.jpg" alt="<?php echo $row['organizationID']?>">
  </div>
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['name'].'<a href="SuptrainApplication.php?page=editOrganisation&id='.$id.'">[Edit]</a></h4>';?>
    <p class="card-text">OrganizationID: <?php echo $row['organizationID']?></p>
		<p class="card-text">Email: <?php echo $row['email']?></p>
		<p class="card-text">Phone: <?php echo $row['phone']?></p>
		<p class="card-text">Contact person: <?php echo $row['contactperson']?></p>
		<p class="card-text">Address: <?php echo $row['address']?></p>
	
	
  </div>
</div>
<?php
}
?>