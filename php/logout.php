<?php
/*
	file:	php/logout.php
	desc:	Removes the session. Sends statusmsg as JSON.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
session_destroy();
echo '{"status":"Logged out!"}'
?>