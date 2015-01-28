<?php
session_start();

$_SESSION['log'] = "out";

#prepare notification message
$msg = "Logout Successful!";
$msg_type = "success";

header("location:../login.php?notifMsg=".base64_encode($msg)."&notifType=".base64_encode($msg_type));

?>