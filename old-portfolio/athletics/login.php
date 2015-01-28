<?php
require("includes/config.inc.php");

?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<?php
			include("includes/nav.inc.php");
		?>
		<h1>Login</h1>
		<p>Login by filling in the form and clicking on Login.</p>
		<?php
			if (isset($_SESSION['regSuc'])) {
				echo "You have successfully registered!";
				unset($_SESSION['regSuc']);
			}
		?>
		<form method="POST" action="">
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
						$email = mysqli_real_escape_string($con, $email);
						$password = mysqli_real_escape_string($con, $password);
						$emQuery = mysqli_query($con, "SELECT userId FROM user WHERE emailAdd='$email'");
						$query = mysqli_query($con, "SELECT u.userId, r.roleId FROM user u NATURAL JOIN user_role r WHERE u.emailAdd='$email' AND u.password='$password'");

						if (mysqli_num_rows($emQuery) < 1) {
							$errors[] = "Invalid email address.";
						} elseif (mysqli_num_rows($query) < 1) {
							
							$errors[] = "Password is wrong!";
						}
						
					} else {
						$errors[] = "Fill in ALL the fields please.";
					}
					
					// if no errors... get the userId then go to the user page..
					if (count($errors) < 1) {
						$res = mysqli_fetch_assoc($query);
						$_SESSION['userId'] = $res['userId'];
						$_SESSION['roleId'] = $res['roleId'];
						$_SESSION['log'] = "in";
						if ($res['roleId'] == 1) {
							header("Location: user.php");
							exit;
						} elseif ($res['roleId'] == 2) {
							header("Location: admin.php");
							exit;
						}
						
						
					}
					
				}
			?>
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
						
				}
			?>
			Email Address:<br>
			<input name="email" type="email" placeholder="Type your email ..."><br>
			Password:<br>
			<input name="password" type="password" placeholder="Type password ..."><br>
			<input name="login" type="submit" value="Login">	
		</form>
	</body>
</html>