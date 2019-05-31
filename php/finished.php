<?php 
/** 
 * file: finished.php
 * desc: List students in one group and have finished training
 */

include('dbConnect.php');
$sql="SELECT groupname,firstname,lastname,email, practicaltrainingdone
FROM `student`
WHERE practicaltrainingdone=true
ORDER BY lastname,firstname";


$result=$conn->query($sql);
?>
<div class="container">
  <h2>All students in database</h2>
  <?php echo '<p><a class="btn information" href="SuptrainApplication.php?page=allstudents">Show all</a></p>' ?>
              
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Groupname</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Training finished</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      //list the results of the query as table row <tr> </tr> here
      while($row=$result->fetch_assoc()) {
          echo '<tr>';
          echo '<td><a href="SuptrainApplication.php?page=finished&group='.$row['groupname'].'">'.$row['groupname'].'</td>';
          echo '<td>'.$row['firstname'].'</td>';
          echo '<td>'.$row['lastname'].'</td>';
          echo '<td>'.$row['email'].'</td>';
          echo '<td>'.$row['practicaltrainingdone'];
          echo '</tr>';
      }
      $conn->close(); // close connection, if not needed in this script anymore
      ?>
    </tbody>
  </table>
</div>