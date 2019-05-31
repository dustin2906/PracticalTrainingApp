<?php
/*
	file:	php/frmAddTraining.php
*/
echo '<form class="card-text" action="php/addTraining.php" method="post">';
echo '<input type="hidden" name="trainingID" value="'.$id.'"/>';
echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> Start: </span>
		</div>
		<input type="date" name="start" class="form-control">
		</div>';
echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> End: </span>
		</div>
		<input type="date" name="end" class="form-control">
		</div>';
echo '<div class="input-group mb-3 input-group-sm">
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
				echo <option>;
				echo $row[firstname].' '.$row[lastname];
				echo </option>;
			}	 ?>
		</select>
		</div>'
echo	'<div class="input-group mb-3 input-group-sm">
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
					echo <option>;
					echo $row[name];
					echo </option>;
				}	 ?>
			</select>
			</div>'
echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text">Supervisor Hours:</span>
		</div>
		<input type="number" min="0" max="100" name="supervisorhours" class="form-control">
	  </div>';
echo '<button class="btn btn-primary btn-block">Save</button>';
echo '</form>';
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
<form action="php/inserttraining.php" method="post" id="training">
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
						echo '<option>';
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
							echo '<option>';
							echo $row['name'];
							echo '</option>';
						}	 ?>
					</select>
				  </div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text"> Supervisor Hours </span>
						</div>
						<input type="number" name="solarplexux">
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


