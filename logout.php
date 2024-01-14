<?php
session_start();
$_SESSION["user"] = null;
unset($_SESSION["user"]);
$_SESSION["event"] = null;
unset($_SESSION["event"]);
session_destroy();
header("location: login.php");
exit;
?>