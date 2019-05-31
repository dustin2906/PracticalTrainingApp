<?php 
/** file:allstudents.php
 *  desc: lists all students ordered by groupname, lastname, firstname 
 *  displays results in a table (use bootstrap styles)
 * 
 */
//read the group from get-variables if it is coming

//read the start value for paging if it comes, otherwise 0
if(isset($_GET['group'])) $group=$_GET['group'];else $group='%%';

include('dbConnect.php'); //uses the database connection created in dbConnect.php


if(isset($_POST['currentDoneInput'], $_POST['StudentIDDone'])){
        $sql="UPDATE student SET practicaltrainingdone=".$_POST['currentDoneInput']."
        WHERE studentID='".$_POST['StudentIDDone']."'";
        if($conn->query($sql)=== TRUE){}else{}
}


$sql="SELECT *
FROM student
WHERE groupname like '$group'
ORDER BY groupname,lastname,firstname";
//run the query and create a resultset (array of records in query)
$result=$conn->query($sql);
?>
<div class="container">
  <h2>All students in database</h2>
  <div class="link">
<p><a class="btn information" href="SuptrainApplication.php?page=newStudent">Add New Student</a></p>
			<p><a class="btn information"
			href="SuptrainApplication.php?page=finished">
      Student finished Training</a>  <span><a class="btn information"
			href="SuptrainApplication.php?page=notfinish">
      Student unfinished Training</a></span> </p>
		</div>
  <?php if($group!='%%') echo '<p><a href="SuptrainApplication.php?page=allstudents">Show all</a></p>' ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Groupname</th>
        <th>StudentID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Training finished</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php 
      //list the results of the query as table row <tr> </tr> here
      while($row=$result->fetch_assoc()) {
          echo '<tr>';
          echo '<td><a href="SuptrainApplication.php?page=allstudents&group='.$row['groupname'].'">'.$row['groupname'].'</td>';
          echo '<td>'.$row['studentID'].'</td>';
          echo '<td>'.$row['firstname'].'</td>';
          echo '<td>'.$row['lastname'].'</td>';
          echo '<td>'.$row['email'].'</td>';
          echo "<td><input type='checkbox' onclick=\"changeDone(".$row['practicaltrainingdone'].",'".$row['studentID']."')\"";
          if($row['practicaltrainingdone']==1) echo " checked='checked' ";
          echo '></td>';
          echo '<td><a class="btn information" href="SuptrainApplication.php?page=studentInfo&id='.$row['studentID'].'">Information</a></td>';
			    echo '<td><a href="php/delStudent.php?&id='.$row['studentID'].'">[Delete]</a></td>';
          echo '</tr>';
      }
      $conn->close(); // close connection, if not needed in this script anymore
      ?>
      <form method="POST" action="SuptrainApplication.php?page=allstudents" id="DoneChangeForm">
        <input type="hidden" id="currentDoneInput" name="currentDoneInput">
        <input type="hidden" id="StudentIDDone" name="StudentIDDone">
      </form>
    </tbody>
  </table>
</div>