<?php
/*
	file:	php/supervisors.php
	desc:	Displays a list of supervisors. Add New -link on a page
*/
include('dbConnect.php');
$sql="SELECT * FROM supervisor
WHERE supervisorID
ORDER BY supervisorID,firstname,lastname";
$result=$conn->query($sql);
?>
<div class="text-center">
	<h1 class="h3 mb-3 font-weight-normal title">All Supervisors</h1>
	<p><a class="information" href="SuptrainApplication.php?page=newSupervisor">Add New Supervisor</a></p>
	<table class="table table-striped mystyle2">
     <thead>
      <tr><th>SupervisorID</th>
		<th>Firstname</th><th>Lastname</th><th>Email</th><th>Phone</th><th></th><th></th>
      </tr>
     </thead>
     <tbody>
		<?php
		//list the results of the query as table row <tr> </tr> here
		while($row=$result->fetch_assoc()){
			echo '<tr>';
			echo '<td>'.$row['supervisorID'].'</td>';
		  echo '<td>'.$row['firstname'].'</td>';
		  echo '<td>'.$row['lastname'].'</td>';
		  echo '<td>'.$row['email'].'</td>';
		  echo '<td>'.$row['phone'].'</td>';
			echo '<td><a class="btn information" href="SuptrainApplication.php?page=supervisorinfo&id='.$row['supervisorID'].'">More Info</a></td>';
			echo '<td><a href="php/delSupervisor.php?&id='.$row['supervisorID'].'">[Delete]</a></td>';
		  echo '</tr>';
		}
		$conn->close(); //close connection, if not needed in this script anymore
		?>
	 </tbody>
    </table>
</div>