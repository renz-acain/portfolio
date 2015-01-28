<?php

require("includes/config.inc.php");
// check if user came from addtocart.php
// if not, redirect to addtocart.php
//$_SESSION['outCheck'];
if (isset($_SESSION['outCheck'])) {
	$och = $_SESSION['outCheck'];
} else {
	$och = 0;
}
if ($och == 0) {
	header("Location: addtocart.php");
	exit;
} 

$_SESSION['delCheck'] = "1";
if (!isset($_SESSION['log'])) {
?>
<html>
	<head>
		<title>Check out!</title>
	</head>
	<body>
		<?php include("includes/nav.inc.php"); ?>
		<h1>Pick one!</h1>
		
		<table>
			<tr>
				<td><h2>Login</h2></td>
				<td><h2>New customer</h2></td>
			</tr>
			<!--this is for grade B! focus on D and C first-->
			<tr>
				<td>
					<?php
					$emptyCount = 0;
					$errors = array();
					if (isset($_POST['login'])) {
						$email = $_POST['email'];
						$password = $_POST['password'];
						$arr = array('email', 'password');
						foreach ($arr as $field) {
							if (empty($_POST[$field])) {
								$emptyCount++;
							}
						}
						if ($emptyCount < 1) {
							$emQuery = mysqli_query($con, "SELECT userId FROM user WHERE emailAdd='$email'");
							$query = mysqli_query($con, "SELECT userId FROM user WHERE emailAdd='$email' AND password='$password'");
	
							if (mysqli_num_rows($emQuery) < 1) {
								$errors[] = "<p>Invalid email address.</p>";
							} elseif (mysqli_num_rows($query) < 1) {
								$errors[] = "<p>Password is wrong!</p>";
							}
							
						} else {
							$errors[] = "Fill in ALL the fields please.";
						}
						
						// if no errors... go to the user page..
						if (count($errors) < 1) {
							$res = mysqli_fetch_assoc($query);
							$_SESSION['userId'] = $res['userId'];
							$_SESSION['log'] = "in";
							header("Location: delivery.php");
							exit;
						}
						
					}
					?>
					<form method="POST" action="">
						<?php
				if (count($errors) > 0) {
					?>
				 <h4>Errors</h4>
				<?php
					foreach ($errors as $e) {
				?>		
						<p style="color: red"><?php echo $e; ?></p>
						<?php		
						}
					}
				?>
						Email Address:<br>
						<input name="email" type="email" placeholder="Type your email ..."><br>
						Password:<br>
						<input name="password" type="password" placeholder="Type password ..."><br>
						<input name="login" type="submit" value="Login">
					</form>
				</td>
				<td>
					<p>Continue without registration. You can register after purchase.</p>
					<a href="delivery.php">Continue</a>
				</td>
			</tr>
		</table>
		<a href="addtocart.php">Back</a>
	</body>
</html>
<?php
} else {
	
	header("Location: delivery.php");
	exit;
}


?>