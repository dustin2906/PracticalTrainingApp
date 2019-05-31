<?php
/*
	file:	php/frmAddHours.php
*/
echo '<form class="card-text" action="php/addhours.php" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'"/>';
echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text"> Year: </span>
		</div>
		<input type="number" min="2018" name="year" class="form-control">
	  </div>';
echo '<div class="input-group mb-3 input-group-sm">
		<div class="input-group-prepend">
			<span class="input-group-text">Hours:</span>
		</div>
		<input type="number" min="0" max="100" name="hours" class="form-control">
	  </div>';
echo '<button class="btn btn-primary btn-block">Save</button>';
echo '</form>';
?>