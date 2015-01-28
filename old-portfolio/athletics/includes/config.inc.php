<?php
	$host = "renzluck-acain.me.uk.mysql";
	$database = "renzluck_acain_";
	$username = "renzluck_acain_";
	$password ="6R5Uzedh";
	$selName = "raSel";
	$selPass = "passwordSelect";
	$delName = "raDel";
	$delPass = "passwordDelete";
	$insName = "raIns1";
	$insPass = "passwordInsert";
	$updName = "raUpd";
	$updPass = "passwordUpdate";
	
	// select user
	$con = mysqli_connect($host,$username,$password, $database);
	//
	//// delete user
	//$delCon = mysqli_connect($host,$delName,$delPass,$database);
	//
	//// insert user
	//$insCon = mysqli_connect($host,$insName,$insPass,$database);
	//
	//// update user
	//$updCon = mysqli_connect($host,$updName,$updPass,$database);
	
	
	
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	session_start();
	
	// check if the user is logged in to get the userId
	// if not, create a session for userId if array named userId in $_SESSION does not exist
	if (!array_key_exists('userId', $_SESSION)) {
		$_SESSION['userId'] = uniqid();
	}
	
	$userId = sprintf('%s', $_SESSION['userId']);
	//if no active cart, create a new cartId
	


/* close connection */
#$mysqli->close();
?>