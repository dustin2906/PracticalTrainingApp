<?php 
/** 
 * file:trainingPlaceandStudent.php
 * desc: List training places and their students at the moment
 */
if(isset($_GET['place'])) $place=$_GET['place'];else $place='%%';

include('dbConnect.php');
$sql="SELECT organization.name AS Place,
CONCAT(student.firstname,' ',student.lastname) AS Student,
training.start AS Started, training.end AS Training_ends
FROM `organization`
INNER JOIN training
ON organization.organizationID=training.organizationID
INNER JOIN student
ON training.studentID=student.studentID
WHERE organization.name like '$place' AND (now() BETWEEN training.start AND training.end)
ORDER BY Student, Started";


$result=$conn->query($sql);
?>
<div class="container">
  <h2>All students in database</h2>
  <?php if($place!='%%') echo '<p><a href="SuptrainApplication.php?page=trainingPlaceandStudent">Show all</a></p>' ?>
              
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Organization</th>
        <th>Student</th>
        <th>Training_Started</th>
        <th>Training_Ends</th>
      </tr>

    </thead>
    <tbody>
      <?php 
      //list the results of the query as table row <tr> </tr> here
      while($row=$result->fetch_assoc()) {
          echo '<tr>';
          echo '<td><a href="SuptrainApplication.php?page=trainingPlaceandStudent&place='.$row['Place'].'">'.$row['Place'].'</td>';
          echo '<td>'.$row['Student'].'</td>';
          echo '<td>'.$row['Started'].'</td>';
          echo '<td>'.$row['Training_ends'].'</td>';
          echo '</tr>';
      }
      $conn->close(); // close connection, if not needed in this script anymore
      ?>
    </tbody>
  </table>
</div>