
<?php
/*
	file:	php/frmEditTraining.php
	
			Gets the data from table into the form
*/
if(isset($_GET['rowid'])) $rowid=$_GET['rowid'];else $rowid='';
$sql="SELECT trainingID,training.start,training.end,training.supervisorhours,organization.name,CONCAT(supervisor.firstname,' ',supervisor.lastname) AS
teacher,supervisor.supervisorID, organization.organizationID FROM training
INNER JOIN student
ON training.studentID=student.studentID
INNER JOIN organization
ON training.organizationID=organization.organizationID
INNER JOIN supervisor
ON training.supervisorID=supervisor.supervisorID WHERE trainingID=$rowid";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()){

	echo '<form class="card-text" action="php/updateTraining.php" method="post">';
	echo '<input type="hidden" name="id" value="'.$id.'"/>';
	echo '<input type="hidden" name="rowid" value="'.$rowid.'"/>';
	echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> Start: </span>
		</div>
		<input type="date" name="start" class="form-control"
			value="'.$row['start'].'">
		</div>';
		echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> End: </span>
		</div>
		<input type="date" name="end" class="form-control"
			value="'.$row['end'].'">
		</div>';
		echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> Supervisor </span>
		</div>
		<select name="supervisorID">';
		$sql2="SELECT firstname, lastname, supervisorID
		FROM `supervisor`";
$result=$conn->query($sql2);
		while($row2=$result->fetch_assoc()){
			echo '<option value="'.$row2['supervisorID'].'">';
			echo $row2['firstname'].' '.$row2['lastname'];
			echo '</option>';
		}
		echo '</select>
		</div>';
		echo '<div class="input-group mb-3 input-group-sm">
			<div class="input-group-prepend">
				<span class="input-group-text"> Organization </span>
			</div>
			<select name="organizationID">';
			$sql="SELECT name, organizationID
			FROM `organization`";
		$result=$conn->query($sql);

		while($row=$result->fetch_assoc()){
		echo '<option value="'.$row['organizationID'].'">';
		echo $row['name'];
		echo '</option>';
		}	
		echo	'</select>
			</div>';
		echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text">Supervisor Hours:</span>
		</div>
		<input type="number" min="0" max="100" name="supervisorhours" class="form-control"
			value="'.$row['supervisorhours'].'">
	  </div>';
	echo '<button class="btn btn-primary btn-block">Update</button>';
	echo '</form>';
}else echo '<p class="alert alert-info">Can not edit</p>';
?>