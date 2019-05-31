<?php
/*
	file:	php/frmEditHours.php
	desc:	Gets supervisorid, supervisorhoursID (rowid) from link Edit
			Gets the data from table into the form
*/
if(isset($_GET['rowid'])) $rowid=$_GET['rowid'];else $rowid='';
$sql="SELECT year, hours FROM supervisorhours WHERE supervisorhoursID=$rowid";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()){

	echo '<form class="card-text" action="php/updatehours.php" method="post">';
	echo '<input type="hidden" name="id" value="'.$id.'"/>';
	echo '<input type="hidden" name="rowid" value="'.$rowid.'"/>';
	echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> Year: </span>
		</div>
		<input type="number" min="2018" name="year" class="form-control"
			value="'.$row['year'].'">
	  </div>';
	echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text">Hours:</span>
		</div>
		<input type="number" min="0" max="100" name="hours" class="form-control"
			value="'.$row['hours'].'">
	  </div>';
	echo '<button class="btn btn-primary btn-block">Update</button>';
	echo '</form>';
}else echo '<p class="alert alert-info">Can not edit</p>';
?>