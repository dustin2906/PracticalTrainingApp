<?php
/*
	file:	php/session.php
	desc:	Checks if $_SESSION['user'] is set. If not answers back
			to calling AJAX with status=fail, otherwise status=ok.
			Answer will be send as JSON.
*/
session_start();
if(isset($_SESSION['user'])) $JSON='{"status":"ok","user":"'.$_SESSION['user'].'"}';
else $JSON='{"status":"fail"}';
echo $JSON;
?>