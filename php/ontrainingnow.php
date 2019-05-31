<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
if(isset($_GET['place'])) $place=$_GET['place'];else $place='%%';
include('dbConnect.php');
$sql="SELECT organization.name AS Place,
CONCAT(student.firstname,' ',student.lastname) AS Student,
training.start AS Started, training.end AS Trainingends, student.groupname
FROM `organization`
INNER JOIN training
ON organization.organizationID=training.organizationID
INNER JOIN student
ON training.studentID=student.studentID
WHERE organization.name like '$place' AND (now() BETWEEN training.start AND training.end)
ORDER BY Student, Started";
$result=$conn->query($sql);
?>
<h3>Students in training at the moment</h3>
<?php if($place!='%%') echo '<p><a href="SuptrainApplication.php?page=ontrainingnow">Show all</a></p>' ?>
<table class="table table-striped ">
    <thead>
      <tr>
			<th>Organisation</th><th>Groupname</th><th>Student</th><th>Start</th><th>End</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
			echo '<tr>';
			echo '<td><a href="SuptrainApplication.php?page=ontrainingnow&place='.$row['Place'].'">'.$row['Place'].'</td>';
		  echo '<td>'.$row['groupname'].'</td>';
		  echo '<td>'.$row['Student'].'</td>';
		  echo '<td>'.$row['Started'].'</td>';
		  echo '<td>'.$row['Trainingends'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>