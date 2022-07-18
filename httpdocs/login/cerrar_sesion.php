<?php
$_SESSION = array();
session_destroy();
header("location: http://10.2.0.66");
exit;
?>
