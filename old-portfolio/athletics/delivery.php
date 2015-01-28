<?php

require("includes/config.inc.php");

unset($_SESSION['outCheck']);
if (!isset($_SESSION['delCheck'])) {
	header("Location: checkout.php");
	exit;
}


$emptyMessage = null;
	$errors = array();  
	//$success = array ();
	$bemptyCount = 0;
	$emptyCount = 0;
	$billAdd = "yes";
	$berrors = array();
if (isset($_POST['submit'])) {
	
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$townOrCity = $_POST['townOrCity'];
	$postcode = $_POST['postcode'];
	if (isset($_POST['billAdd'])) {
		$billAdd = $_POST['billAdd'];	
	} else {
		$billAdd = "no";
	}

	//no address 2
	$arr = array('email', 'firstname', 'lastname', 'address1', 'townOrCity', 'postcode');
	
	foreach($arr as $field) {
		if (empty($_POST[$field])) {
			$emptyCount++;
		  }
		}
		// check if the required fields has value
	if ($emptyCount > 0) {
	  $errors[] = "$emptyCount required field/s are empty!";
	} else {
	  
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$errors[] = "$email is not a valid email address.";
		  }
		  
		if (!preg_match("/[A-Za-z]/", $firstname)) {
			  $errors[] = "Firstname should be letters only.";
		  }
		  
		if (!preg_match('/[A-Za-z]/', $lastname)) {
			  $errors[] = "Lastname should be letters only.";
		  }
		  
		
		if (!preg_match('/[0-9A-Za-z]/', $address1)) {
			  $errors[] = "Street number and name";
		  }
		  
		 if (!empty($address2)) {
			if (!preg_match('/[A-Za-z]/', $address2)) {
				$errors[] = "Second line of address";
			}
		} 
		  
		if (!preg_match('/[A-Za-z]/', $townOrCity)) {
			  $errors[] = "Enter town or city";
		  }
		  
		  //http://www.townscountiespostcodes.co.uk/postcodes/tools/php-postcode-validation-script.php [ Validation of UK postcode ]
		  $postcode = strtoupper(str_replace(' ','',$postcode));
		if(!preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/",$postcode) || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/",$postcode) || preg_match("/^GIR0[A-Z]{2}$/",$postcode)) {
			  $errors[] = "$postcode is not a UK postcode.";
		}
		
	}
	
	
	
	// if every variables are equal, show Same address for billing and address
	if ($billAdd == "yes") {
		$bfirstname = $firstname;
		$blastname = $lastname;
		$baddress1 = $address1;
		$baddress2 = $address2;
		$btownOrCity = $townOrCity;
		$bpostcode = $postcode;
	} else {

		
		$baddress1 = $_POST['baddress1'];
		$baddress2 = $_POST['baddress2'];
		$btownOrCity = $_POST['btownOrCity'];
		$bpostcode = $_POST['bpostcode'];
	
		//no address 2 because it is optional
		$barr = array('baddress1', 'btownOrCity', 'bpostcode');
		
			foreach($barr as $bfield) {
				if (empty($_POST[$bfield])) {
					$bemptyCount++;
				  }
				}
				// check if the required fields has value
			if ($bemptyCount > 0) {
			  $berrors[] = "$bemptyCount required field/s are empty!";
			} else {
				  
				
				if (!preg_match('/[0-9A-Za-z]/', $baddress1)) {
					  $berrors[] = "Street number and name";
				  }
				  
				 if (!empty($baddress2)) {
					if (!preg_match('/[A-Za-z]/', $baddress2)) {
						$berrors[] = "Second line of address";
					}
				} 
				  
				if (!preg_match('/[A-Za-z]/', $btownOrCity)) {
					  $berrors[] = "Enter town or city";
				  }
				  
				  //http://www.townscountiespostcodes.co.uk/postcodes/tools/php-postcode-validation-script.php [ Validation of UK postcode ]
				  $bpostcode = strtoupper(str_replace(' ','',$bpostcode));
				if(!preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/",$bpostcode) || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/",$bpostcode) || preg_match("/^GIR0[A-Z]{2}$/",$bpostcode)) {
					  $berrors[] = "$bpostcode is not a UK postcode.";
				}
				
			}
	
	}
	

	// use count for arrays to know how many it has
	if ((count($errors) < 1) && (count($berrors) < 1)) {
		// get the POST from here to add in the include so we can display it in the other page.
		$_SESSION['email'] = $email;
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['address1'] = $address1;
		$_SESSION['address2'] = $address2;
		$_SESSION['townOrCity'] = $townOrCity;
		$_SESSION['postcode'] = $postcode;
		
		
		$_SESSION['baddress1'] = $baddress1;
		$_SESSION['baddress2'] = $baddress2;
		$_SESSION['btownOrCity'] = $btownOrCity;
		$_SESSION['bpostcode'] = $bpostcode;
		
		$_SESSION['pCheck'] = 1;
		
		header("Location: payment.php");
		exit;
	}
} // end of $_POST[submit]


?>
<html>
	<head>
		<title>Delivery</title>
		
		
		
		
		
	</head>
	<body>
		<?php include("includes/nav.inc.php"); ?>
		<h1>
			Delivery:
		</h1>
<?php 

?>
<?php
	if (count($errors) > 0) {
		?>
		<h4>Errors on main address</h4>
		<?php
	   foreach ($errors as $e) {
	   ?>		
			   <p style='color: red'><?php echo $e; ?></p>
	   <?php		
	   }
	}
	if (count($berrors) > 0) {
		?>
	 <h4>Errors on bill address</h4>
	 <?php
	foreach ($berrors as $e) {
	?>		
			<p style='color: red'><?php echo $e; ?></p>
	<?php		
	}
			echo "<p style='color: red'>Please ensure you enter the RIGHT details in ALL fields so you don't have to type them again.</p>";
	}
		
	?>
			
		<h2>Delivery Details:</h2>
		<?php
		$log = null;
		if (isset($_SESSION['log'])) {
			$log = $_SESSION['log'];
		}
		if ($log == "in") {
			$strQ = "SELECT u.emailAdd, u.firstname, u.lastname, a.address1, a.address2, a.city, a.postcode FROM `user` u INNER JOIN `address` a ON (a.userId = u.userId) WHERE a.userId='$userId'";
			$query = mysqli_query($con, $strQ) or die($strQ);
			$res = mysqli_fetch_assoc($query);
			$email = $res['emailAdd'];
			$firstname = $res['firstname'];
			$lastname = $res['lastname'];
			$address1 = $res['address1'];
			$address2 = $res['address2'];
			$city = $res['city'];
			$postcode = $res['postcode'];
			?>
			<form action="" method="post">
				Wrong details? Click 
				<input name="clear" type="submit" value="Clear">
			</form>
			<?php
		} else {
			$email = null;
			$firstname = null;
			$lastname = null;
			$address1 = null;
			$address2 = null;
			$city = null;
			$postcode = null;
		}
		
		if (isset($_POST['clear'])) {
			$email = null;
			$firstname = null;
			$lastname = null;
			$address1 = null;
			$address2 = null;
			$city = null;
			$postcode = null;
		}
		
		?>
		
		<!--JAVASCRIPT-->
		<script>
		    function showMe (box) {
				var chboxs = document.getElementById("c1");
				var vis = "none";
					if(!chboxs.checked){
					 vis = "block";
					}
				document.getElementById(box).style.display = vis;
			}
		</script>
		<!--END OF JAVASCRIPT-->
		
		<form action="" method="POST">
			Email Address:
			<input type="email" name="email" placeholder="Type email .." value="<?php print $email ?>">*
			<br>
			Firstname:
			<input type="text" name="firstname" placeholder="Type name ..." value="<?php print $firstname ?>">*
			<br>
			Lastname:
			<input type="text" name="lastname" placeholder="Type name ..." value="<?php print $lastname ?>">*
			<br>
			Address 1:
			<input type="text" name="address1" placeholder="Type Street name ..." value="<?php print $address1 ?>">*
			<br>
			Address 2:
			<input type="text" name="address2" placeholder="Type 2nd line of address ..." value="<?php print $address2 ?>">(Optional)
			<br>
			City:
			<input type="text" name="townOrCity" placeholder="Type City ..." value="<?php print $city ?>">*
			<br>
			Postcode:
			<input type="text" name="postcode" placeholder="Type postcode ..." value="<?php print $postcode ?>">*<br>
			
			<input type="checkbox" id="c1" name="billAdd" checked value="yes" onclick="showMe('hidden')">Use same address for Billing address.<br>
			Be sure to untick the box if the delivery and billing address are different.
			
			
			<div id="hidden" style="display:none">
				<h4>Billing Address:</h4>		
				
				Address 1:
				<input type="text" name="baddress1" placeholder="Type Street name ...">*
				<br>
				Address 2:
				<input type="text" name="baddress2" placeholder="Type 2nd line of address ...">(Optional)
				<br>
				City:
				<input type="text" name="btownOrCity" placeholder="Type City ...">*
				<br>
				Postcode:
				<input type="text" name="bpostcode" placeholder="Type postcode ...">*<br>
			</div>
			<br>
				
			<input type="submit" name="submit" value="Pay">
		</form>
		<p>Fields with * are required. Do not leave them blank.</p>
	</body>
	
</html>