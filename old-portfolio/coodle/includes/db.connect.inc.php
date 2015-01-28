<?php
	$host = "renzluck-acain.me.uk.mysql";
	$database = "renzluck_acain_";
	$username = "renzluck_acain_";
	$password = "6R5Uzedh";

	$link = mysql_connect($host,$username,$password);

	if (!$link) {
		die("<strong>Connection to database failed:</strong>" . mysqli_connect_error());
	}

	//select database
	$db_selected = mysql_select_db($database, $link);
	if (!$db_selected) {
		die ("Error Select Database: " . mysqli_connect_error());
	}


/* close connection */
#$mysqli->close();
?>