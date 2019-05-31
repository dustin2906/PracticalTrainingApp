<?php
/*
	file:	php/newSupervisor.php
	desc:	Form to add new supervisor
			Displays $_SESSION['insNewMsg'] -variable if exists to show
			messages from inserting script (success or errors)
*/
echo '<h3>Add New Supervisor</h3>';
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
?>
<form action="php/insertSupervisor.php" method="post">
<div class="form-group">
		<label for="supervisorID">SupervisorID</label>
		<input type="text" name="supervisorID" class="form-control" autofocus required />
	</div>
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" name="firstname" class="form-control" autofocus required />
	</div>
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input type="text" name="lastname" class="form-control" required />
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" required />
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" required />
	</div>
	<button type="submit" class="btn btn-primary btn-block">Insert</button>
</form>