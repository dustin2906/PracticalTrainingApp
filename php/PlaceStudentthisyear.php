<?php 
/** 
 * file: PlaceStudentthisyear.php
 * desc: List training places and their students this year
 */
if(isset($_GET['group'])) $group=$_GET['group'];else $group='%%';

include('dbConnect.php');
$sql="SELECT organization.name AS Place,
CONCAT(student.firstname,' ',student.lastname) AS Student,
training.start AS Started, training.end AS Training_ends
FROM `organization`
INNER JOIN training
ON organization.organizationID=training.organizationID
INNER JOIN student
ON training.studentID=student.studentID
WHERE YEAR(now())=YEAR(training.start)
ORDER BY Place, Started, Student";


$result=$conn->query($sql);
?>
<div class="container">
  <h2>All students in database</h2>
  <?php if($group!='%%') echo '<p><a href="index.php?page=allstudents">Show all</a></p>' ?>
              
  <table style="width:100%">
    
      <tr>
        <th>Place</th>
        <th>Student</th>
        <th colspan="2">Started</th>
        <th>Training_Ends</th>
      </tr>

      <?php 
      //list the results of the query as table row <tr> </tr> here
      while($row=$result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>'.$row['Place'].'</td>';
          echo '<td>'.$row['Student'].'</td>';
          echo '<td>'.$row['Started'].'</td>';
          echo '<td>'.$row['Training_ends'].'</td>';
          echo '</tr>';
      }
      $conn->close(); // close connection, if not needed in this script anymore
      ?>
  
  </table>
</div>