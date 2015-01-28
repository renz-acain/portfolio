<?php
require_once("../library/user.class.php");

if(isset($_SESSION['coodle']['userHandle']))
{
	$userHandle = unserialize($_SESSION['coodle']['userHandle']);

	if($userHandle->getProperty("isAuthenticated") == false)
	{
		fnRedirect();
	}
}
else
{
	fnRedirect();
}



function fnRedirect()
{
	#authentication required
	$msg = "Authentication Required!";
	$msg_type = "warning";
	
	header("location:../login.php?notifMsg=".base64_encode($msg)."&notifType=".base64_encode($msg_type));
}
?>