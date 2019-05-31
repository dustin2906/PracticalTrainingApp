<?php 
/**
 * file: php/newStudent.php
 * desc: form to add new student
 * Displays $_SESSION['insNewstu']- variable if exists to show messages from inserting script (suceess or errors)
 */
if(isset($_SESSION['insNewstu'])) echo $_SESSION['insNewstu'];
$_SESSION['insNewstu']='';
?>
<div class="container">
<h3> Add new student</h3>
<form action="php/insertstudent.php" method="post">
<div class="form-group">
    <label for="studentID">studentID</label>
    <input type="text" name="studentID" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="practicaltrainingdone">Practical Training Finished</label>
    <input type="number" name="practicaltrainingdone" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="groupname">Group name</label>
    <input type="text" name="groupname" class="form-control" autofocus required />
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Insert</button>
</form>
</div>