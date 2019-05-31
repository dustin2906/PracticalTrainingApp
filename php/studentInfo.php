<?php
/*
	file:	php/studentInfo.php
	desc:	Shows info about the selected supervisor.
			Form for adding year+hours for that year
*/
if(isset($_GET['id'])) $id=$_GET['id']; 
else header('location:SuptrainApplication.php?page=allstudents');
if(isset($_GET['add'])) $add=$_GET['add'];else $add='';
if(isset($_GET['edit'])) $edit=$_GET['edit'];else $edit='';
include('dbConnect.php');
$sql="SELECT * FROM student WHERE studentID='$id'";

$result=$conn->query($sql);
if($result->num_rows > 0){
	//student found
	$row=$result->fetch_assoc(); //results into a row
?>
<h1 class="h3 mb-3 font-weight-normal">Student Info</h1>
<div class="card d-inline-flex mystyle">
  <div class="text-center">
	<?php
	//displays profile image, if exists. Default avatar.png otherwise
	if(empty($row['imagestudent'])){
		echo '<img class="img-responsive img-thumbnail" width="150px" src="img/avatar.png" />';
	}else{
		echo '<img class="img-responsive img-thumbnail" width="150px" src="img/students/'.$row['imagestudent'].'" />';
	}
	?>
  </div>
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['firstname'].' '.$row['lastname'].' <a href="SuptrainApplication.php?page=editStudent&id='.$id.'">[Edit]</a></h4>';?>
    <p class="card-text">StudentID: <?php echo $row['studentID']?></p>
		<p class="card-text">Email: <?php echo $row['email']?></p>
		<p class="card-text">Phone: <?php echo $row['phone']?></p>
		<p class="card-text">Training Finished: <?php echo $row['practicaltrainingdone']?></p>
		<p class="card-text">Group name: <?php echo $row['groupname']?></p>
		<p class="card-text">Training: <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add</button></p>
 
	<?php
	//show the form for adding resources, if add=ok is found in GET
	if($edit=='ok'){
		include('php/frmEditTraining.php');
	}
	$sql="SELECT trainingID,training.start,training.end,training.supervisorhours,organization.name,CONCAT(supervisor.firstname,' ',supervisor.lastname) AS
	teacher FROM training
	INNER JOIN student
	ON training.studentID=student.studentID
	INNER JOIN organization
	ON training.organizationID=organization.organizationID
	INNER JOIN supervisor
	ON training.supervisorID=supervisor.supervisorID
	WHERE training.studentID='$id'
	ORDER BY start DESC";
	$result=$conn->query($sql);
	?>
	<table class="table table-striped">
		<thead>
			<tr><th>Start</th><th>End</th><th>Place</th><th>Supervisor</th><th>Supervisorhours</th><th></th><th></th></tr>
		</thead>
		<tbody>
		<?php
		while($row=$result->fetch_assoc()){
			echo '<tr>';
			echo '<td>'.$row['start'].'</td>';
			echo '<td>'.$row['end'].'</td>';
			echo '<td>'.$row['name'].'</td>';
			echo '<td>'.$row['teacher'].'</td>';
			echo '<td>'.$row['supervisorhours'].'</td>';
			echo '<td><a href="SuptrainApplication.php?page=studentInfo&id='.$id.'&edit=ok&rowid='.$row['trainingID'].'">[Edit]</a> ';
			echo '<a href="php/delTraining.php?id='.$id.'&rowid='.$row['trainingID'].'">[Delete]</a></td>';
			echo '</tr>';
		};
		?>
		</tbody>
	</table>
  </div>
</div>

<?php
}else header('location:SuptrainApplication.php?page=allstudents');
?>

 <!-- The Modal -->
 <div class="modal fade" id="myModal">
	 <div class="modal-dialog">
		 <div class="modal-content">

			 <!-- Modal Header -->
			 <div class="modal-header">
				 <h4 class="modal-title">Add Training</h4>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			 </div>

			 <!-- Modal body -->
			 <div class="modal-body">
<form action="php/addTraining.php?id=<?php echo $_GET['id']; ?>" method="post" id="training">
	<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> Starting: </span>
		</div>
		<input type="date" name="start">
	  </div>
		<div class="input-group mb-3 input-group-sm">
			<div class="input-group-prepend">
				<span class="input-group-text"> Ending: </span>
			</div>
			<input type="date" name="end">
		  </div>
			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text"> Supervisor </span>
				</div>
				<select name="supervisorID">
					<option></option>
					<?php
					$sql="SELECT firstname, lastname, supervisorID
							FROM `supervisor`";
					$result=$conn->query($sql);

					while($row=$result->fetch_assoc()){
						echo '<option value="'.$row['supervisorID'].'">';
						echo $row['firstname'].' '.$row['lastname'];
						echo '</option>';
					}	 ?>
				</select>
			  </div>
				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text"> Organization </span>
					</div>
					<select name="organizationID">
						<option></option>
						<?php
						$sql="SELECT name, organizationID
								FROM `organization`";
						$result=$conn->query($sql);

						while($row=$result->fetch_assoc()){
							echo '<option value="'.$row['organizationID'].'">';
							echo $row['name'];
							echo '</option>';
						}	 ?>
					</select>
				  </div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text"> Supervisor Hours </span>
						</div>
						<input type="number" name="supervisorhours">
					  </div>
				</form>
			 </div>
			 <!-- Modal footer -->
			 <div class="modal-footer">
				 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				 <button type="submit" class="btn btn-primary" form="training">Save</button>
			 </div>

		 </div>
	 </div>
 </div>

 


