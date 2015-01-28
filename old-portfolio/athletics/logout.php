<?php
	session_start();
	
	unset($_SESSION['log']);
	unset($_SESSION['userId']);
	unset($_SESSION['roleId']);
	
	header("Location: index.php");
	exit;
?>
