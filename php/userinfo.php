<?php
/*
	file: 	php/userinfo.php
	desc:	Displays the form to change password
*/
?>
<div class="text-center">
	<h3>Change password</h3>
	<?php
		if(isset($_SESSION['pwdChange'])){
			echo '<p class="alert alert-info">';
			echo $_SESSION['pwdChange'];
			echo '</p>';
			$_SESSION['pwdChange']='Type old + new twice!';
		}
	?>
	<form class="form-signin" action="php/updatePassword.php" method="post">
		<input type="password" name="inputPassword" class="form-control"
			placeholder="Password now" autofocus required />
		<input type="password" name="newPassword" class="form-control"
			placeholder="New Password" required />
		<input type="password" name="newPassword1" class="form-control"
			placeholder="Retype New Password" required />
		<button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
	</form>
</div>