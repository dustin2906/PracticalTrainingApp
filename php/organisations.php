<?php
/*
	file:	organisations.php
	desc:	Lists all organisation.
*/
include('dbConnect.php'); //uses the database connection created in dbConnect.php
//SQL-query used for this script
$sql="SELECT *
		FROM `organization` 
		WHERE organizationID"; 
$result=$conn->query($sql);
?>
<div class="text-center">
<h1 class="h1 mb-3 font-weight-normal title">All Organisations</h1>
<p><a class="btn information" href="SuptrainApplication.php?page=newOrganisation">Add New Organisation</a></p>

<table class="table table-striped">
    <thead>
      <tr>
		<th>OrganisationID</th><th>Name of organisation</th><th>Contact person</th><th>Email</th><th>Phone</th>
		<th>Address</th><th></th><th></th>
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td><a class="mystyle2" href="SuptrainApplication.php?page=organisations&group='.$row['organizationID'].'">'.$row['organizationID'].'</a></td>';
			echo '<td>'.$row['name'].'</td>';
			echo '<td>'.$row['contactperson'].'</td>';
			echo '<td>'.$row['email'].'</td>';
			echo '<td>'.$row['phone'].'</td>';
			echo '<td>'.$row['address'].'</td>';
			echo '<td><a class="btn information" href="SuptrainApplication.php?page=organisationInfo&id='.$row['organizationID'].'">Information</a></td>';
			echo '<td><a class="mystyle2"  href="php/delOrganisation.php?&id='.$row['organizationID'].'">[Delete]</a></td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
  </div>
  
  
  
  
  
  