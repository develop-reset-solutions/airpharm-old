<?php
$_SESSION = array();
session_destroy();
header("location: http://airpharmdpo.com");
exit;
?>
