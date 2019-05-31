<?php 
/**
 * file: php/newOrganisation.php
 * desc: form to add new organization
 * Displays $_SESSION['insNeworg']- variable if exists to show messages from inserting script (suceess or errors)
 */
if(isset($_SESSION['insNeworg'])) echo $_SESSION['insNeworg'];
$_SESSION['insNeworg']='';
?>
<h3> Add new organisation</h3>
<form action="php/insertOrganisation.php" method="post">
<div class="form-group">
    <label for="organizationID">OrganisationID</label>
    <input type="text" name="organizationID" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="contactperson">Contact person</label>
    <input type="text" name="contactperson" class="form-control" autofocus required />
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
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control" autofocus required />
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Insert</button>
</form>