<?php

require("includes/config.inc.php");



?>
<html>
	<head>
		<title>Registration</title>
	</head>
	<body>
		<?php
			include("includes/nav.inc.php");
		?>
		<h1>Be a part of our brilliant website!</h1>
		<p>Register to allow you save time when purchasing products (No need to type in your address!)<br>
		or saving your products in a cart!</p>
		
		
			<?php
			$errors = array();	
				if (isset($_POST['register'])) {
					$emptyCount = 0;
					
					$arr = array('firstname', 'lastname', 'address1', 'city', 'postcode', 'email', 'password', 'password2');
	
						$email = $_POST['email'];
						$firstname = $_POST['firstname'];
						$lastname = $_POST['lastname'];
						$address1 = $_POST['address1'];
						$address2 = $_POST['address2'];
						$townOrCity = $_POST['city'];
						$postcode = $_POST['postcode'];
						$password = $_POST['password'];
						$password2 = $_POST['password2'];
	
	
					foreach($arr as $field) {
						if (empty($_POST[$field])) {
							$emptyCount++;
						  }
						}
						
					if ($emptyCount < 1) {
						
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
						  
						// password validation.. 1 uppercase,lowercase  and number in the password
						//http://stackoverflow.com/questions/19605150/regex-for-password-must-be-contain-at-least-8-characters-least-1-number-and-bot
						  
						  if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password)) {
								$errors[] = "Password needs to be atleast 8 with 1 uppercase and 1 number";
							}
						
						if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password2)) {
								$errors[] = "Retyping password needs to be atleast 8 with 1 uppercase and 1 number";
							}
						if ($password != $password2) {
							$errors[] = "The passwords you entered does not match!";
						}
						
						
						if (count($errors) < 1) {
							// get the POST from here to add in the include so we can display it in the other page.
							// check if email exists
							// insert the address to the address table
							// get the addressId then assign it to the user
							$check = "SELECT userId FROM user WHERE emailAdd = '$email'";
							
							$checkQuery = mysqli_query($con, $check);
							if (mysqli_num_rows($checkQuery) > 0) {
								$errors[] = "The email address you entered is already in use!";
							} else {
								
								$userId = mysqli_real_escape_string($con, $userId);
								$email = mysqli_real_escape_string($con, $email);
								$password = mysqli_real_escape_string($con, $password);
								$firstname = mysqli_real_escape_string($con, $firstname);
								$lastname = mysqli_real_escape_string($con, $lastname);
								$address1 = mysqli_real_escape_string($con, $address1);
								$address2 = mysqli_real_escape_string($con, $address2);
								$townOrCity = mysqli_real_escape_string($con, $townOrCity);
								$postcode = mysqli_real_escape_string($con, $postcode);
								
								$ins = "INSERT INTO `user` (userId, emailAdd, password, firstname, lastname) VALUES ('$userId', '$email', '$password', '$firstname', '$lastname')";
								mysqli_query($con, $ins);
								
								mysqli_query($con, "INSERT INTO `address` (address1, address2, city, postcode, userId) VALUES ('$address1', '$address2', '$townOrCity', '$postcode', '$userId')");
								
								mysqli_query($con, "INSERT INTO `user_role` (userId) VALUES ('$userId')");
						
							}
							
							$_SESSION['regSuc'] = "yes";
							//$regQuery = ""
							//mysqli_query($con, $regQuery);
							
							header("Location: login.php");
							exit;
						}
						
						
							
					} else {
						$errors[] = "There are $emptyCount blank field/s! Please fill them with the right answer.";
					}
				}
			
			
			
			?>
			
			<form action="" method="POST">
			<h2>Register</h2>
			<?php
				if (count($errors) > 0) {
					?>
				 <h4>Errors</h4>
				 <?php
				foreach ($errors as $e) {
				?>		
						<p style='color: red;'><?php echo $e; ?></p>
				<?php		
				}
						echo "<p style='color: red;'>Please ensure you enter the RIGHT details in ALL fields so you don't have to type them again.</p>";
				}
			?>
			<h3>User details</h3>
			Firstname:<br>
			<input name="firstname" type="text" placeholder="Type your firstname ..."><br>
			Lastname:<br>
			<input name="lastname" type="text" placeholder="Type your lastname ..."><br>
			Address1:<br>
			<input name="address1" type="text" placeholder="Type your streetname ..."><br>
			Address2:<br>
			<input name="address2" type="text" placeholder="Type your 2nd line address ..."><br>
			City:<br>
			<input name="city" type="text" placeholder="Type your city ..."><br>
			Postcode:<br>
			<input name="postcode" type="text" placeholder="Type your postcode ..."><br>
			<h3>Account information</h3>
			Email Address:<br>
			<input name="email" type="email" placeholder="Type your email ..."><br>
			Password:<br>
			<input name="password" type="password" placeholder="Type password ..."><br>
			Re-type password:<br>
			<input name="password2" type="password" placeholder="Retype password ..."><br>
			
			<input name="register" type="submit" value="Submit">
			
		</form>
	</body>
	
	
</html>