<?php

require("includes/config.inc.php");


?>
<html>
	<head>
		
		<title>Change address</title>
		
	</head>
		
	<body>
		
		<?php
		include("includes/nav.inc.php");
			if (!isset($_SESSION['roleId'])) {
				
				$_SESSION['roleId'] = 0;
				
			}
			/////////////////////////
			// This page will only be accessible by a logged in member
			////////////////////////
			$errSave = null;
			if ((!isset($_SESSION['log'])) || ($_SESSION['roleId'] != 1)) {
				echo "Registered members only!";
			} else {
					
			
					$billAdd = "yes";
					$errors = array();
					$emptyCount = 0;
					$berrors = 0;
					$addressId = $_SESSION['addressId'];
					$log = sprintf("%s", $_SESSION['log']);
					if ($log == "in") {
						$strQ = "SELECT u.emailAdd, u.firstname, u.lastname, a.address1, a.address2, a.city, a.postcode FROM user u INNER JOIN address a ON (a.userId = u.userId) WHERE a.userId='$userId' AND a.addressId='$addressId'";
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
						
					
						// use count for arrays to know how many it has
						if (count($errors) < 1) {
							// get the POST from here to add in the include so we can display it in the other page.
							 mysqli_query($con, "UPDATE address SET address1='$address1', address2='$address2', city='$townOrCity', postcode='$postcode' WHERE addressId='$addressId' AND userId='$userId'");
							  // delete addressId session
							  
							
							header("Location: user.php");
							exit;
						}
				} // end of $_POST[submit]
					
					
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
					
					<h3>Delivery Address</h3>
					<form action="" method="POST">
						Email Address:
						<input type="email" name="email" placeholder="Type email .." value="<?php print $email; ?>">*
						<br>
						Firstname:
						<input type="text" name="firstname" placeholder="Type name ..." value="<?php print $firstname; ?>">*
						<br>
						Lastname:
						<input type="text" name="lastname" placeholder="Type name ..." value="<?php print $lastname; ?>">*
						<br>
						Address 1:
						<input type="text" name="address1" placeholder="Type Street name ..." value="<?php print $address1; ?>">*
						<br>
						Address 2:
						<input type="text" name="address2" placeholder="Type 2nd line of address ..." value="<?php print $address2; ?>">(Optional)
						<br>
						City:
						<input type="text" name="townOrCity" placeholder="Type City ..." value="<?php print $city; ?>">*
						<br>
						Postcode:
						<input type="text" name="postcode" placeholder="Type postcode ..." value="<?php print $postcode; ?>">*<br>
						<input type="submit" name="submit" value="Save">
						
							
						
					</form>
					<p>Fields with * are required. Do not leave them blank.</p>
		<?php
			}
		?>
	</body>	
		
</html>