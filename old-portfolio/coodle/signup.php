<?php
#start session
session_start();

#set page navigation id
$navID=5;

#define base URL
define("__BASE_URL__","");

#include connection to db
include_once("includes/db.connect.inc.php");

#load user class
require_once("library/user.class.php");

#check if already logged in
if(isset($_SESSION['coodle']['userHandle']))
{
	$msg = "You are already logged in!";
	$msg_type = "info";
	header("location:users/dashboard.php?notifMsg=".base64_encode($msg)."&notifType=".base64_encode($msg_type));
}

#begin registration
if( isset($_REQUEST['btnSubmit']) )
{
		
	# family member/user registration begins here
	$user = new User();
	
	#get details here
	$user->setProperty("firstName",$_REQUEST['txtFirstName']);
	$user->setProperty("lastName",$_REQUEST['txtLastName']);
	$user->setProperty("sex",$_REQUEST['mnuSex']);
	$user->setProperty("maritalStatus",$_REQUEST['mnuMaritalStatus']);
	$user->setProperty("email",$_REQUEST['txtEmail']);
	$user->setProperty("password",$_REQUEST['txtPassword']);
	
	#store details in database
	$result = $user->register();
	$userID = $user->getProperty(userID);
	
	#test success
	if(!is_array($result))
	{
		//new family member/user registration was successful and redirect to success page
		header("location:login.php?userID=".base64_encode($userID)."&action=".base64_encode("just_registered"));
	}
	else
	{
		//Error Occured.		
		$feedback = "Your registration was NOT successful!";
		$feedback .= "<em>".$result['errMsg']."</em>";
		header("location:?notifMsg=".base64_encode($feedback)."&notifType=".base64_encode("error"));
	}//end if
}//end registration

#if user tries to login
if(isset($_REQUEST['btnLogin']))
{
	#processLogin
	$user = new User();
	$user->checkAuth($_REQUEST['txtEmail'],$_REQUEST['txtPassword']);
			
	if($user->getProperty("isAuthenticated"))
	{
		#authentication passed			
		$_SESSION['coodle']['userHandle'] = serialize($user);
		
		
		$feedback = "You successfully registered!";
		header("location:users/dashboard.php?notifMsg=".base64_encode($feedback)."&notifType=".base64_encode("success"));
	}
	else
	{
		#authentication failed
		$msg = "Authentication Failed!";
		$msg_type = "warning";
		
		header("location:login.php?notifMsg=".base64_encode($msg)."&notifType=".base64_encode($msg_type));	
	} //end if authenticated
} //end if login is set
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
<title>Coodle - Register</title>
<link rel="shortcut icon" href="imgs/logo-small.png" type="image/png" />

  <meta name="description" content="coodle, family planning application, organised families, to-do-lists, calendars, reminders, register now" />
  <link rel="stylesheet" href="stylesheets/app.css">
  <link rel="stylesheet" href="stylesheets/default.css">

  <script src="javascripts/vendor/custom.modernizr.js"></script>

</head>
<body>
	<!-- Start of nav bar -->
			<?php include("includes/nav.inc.php") ?>
	<!-- End of nav -->
	
	
	<div id="container">
		<div class="row">
			<div class="small-12 columns">
				<h1>Register for free Coodle</h1>
				<p>Sign-up to free Coodle to make your life happier</p>
                <p><?php require_once("includes/notif.inc.php"); ?></p>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		
		<div class="row">
			<div class="small-11 medium-8 small-centered large-uncentered large-6 columns">
				<div class="panel callout radius">
					<h2>Signup</h2>
					
					<form class="custom" data-abide method="post">
						<div class="email-field">
							<label>Email: <small>required</small></label>
							<input name="txtEmail" type="email" placeholder="someone@email.co.uk" required>
							<small class="error">An email address is required.</small>
						</div>
						<div class="password-field">
							<label>Password: <small>required</small></label>
							<input name="txtPassword" type="password" placeholder="Type your password .." required>
							<small class="error">Password must be 8 characters with 1 capital letter and 1 number.</small>
						</div>
						<div class="name-field">
							<label>Firstname: <small>required</small></label>
							<input name="txtFirstName" type="text" placeholder="Type your first name .." required>
							<small class="error"></small>
						</div>
						
						<div class="name-field">
							<label>Lastname: <small>required</small></label>
							<input name="txtLastName" type="text" placeholder="Type your last name .." required>
							<small class="error"></small>
						</div>
						
                        <div class="row">
					    
					    <div class="large-6 columns">
						 <label for="customDropdown1">Sex:</label>
						 <select name="mnuSex" id="customDropdown1" class="medium">
						   <option DISABLED>SEX</option>
						   <option value="male">Male</option>
						   <option value="female">Female</option>
						 
						 </select>
					    </div>
					     <div class="large-6 columns">
						 <label for="customDropdown2">Marital Status:</label>
						 <select name="mnuMaritalStatus" id="customDropdown2" class="medium">
						   <option DISABLED>Status</option>
						   <option value="1">Single</option>
						   <option value="2">Married</option>
						   <option value="3">Divorced</option>
						 </select>
					  </div>
                     </div>
						
						<label>By submitting this form, you agree to our <a>Terms and Condition.</a></label>
						<button class="button expand round secondary" type="submit" name="btnSubmit">Submit</button>
					</form>
				</div>
				<div align="center" class="show-for-medium-down">
				<p>Already a member?
				<a href="login.php" class="button round success expand">Log-in</a></p>
				</div>
				
			</div>	
	

			<div class="small-12 large-6 columns show-for-large-up">
			<p>Already a member?</p>
				<div class="panel radius">
					<h4>Login</h4>
					<form data-abide method="post">
						<div class="email-field">
							<label>Email: <small>required</small></label>
							<input name="txtEmail" type="email" placeholder="someone@email.co.uk" required>
							<small class="error">An email address is required.</small>
						</div>
						<div class="password-field">
							<label>Password: <small>required</small></label>
							<input name="txtPassword" type="password" placeholder="Type your password .." required>
							<small class="error">Password must be 8 characters with 1 capital letter and 1 number.</small>
						</div>
						<button  type="submit" name="btnLogin">Login</button>
					</form>
				</div>
			</div>
		</div>
	
	</div>
	
	
<!-- Start of footer -->  
<hr>
<footer class="row">
	<div class="small-12 columns">
		<div class="row">
			<div class="small-12 columns">
				<ul class="inline-list">
					<li>&copy;  2013 Coodle</li>
					<li><a href="sitemap.php">Sitemap</a></li>
				</ul>
			</div>
		</div>
	</div> 
</footer>
<!-- End of footer --> 
	
	
<!-- list of javascripts -->
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'javascripts/vendor/zepto' : 'javascripts/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="javascripts/foundation/foundation.js"></script>
	
	<script src="javascripts/foundation/foundation.abide.js"></script>
	
	<script src="javascripts/foundation/foundation.alerts.js"></script>
	
	<script src="javascripts/foundation/foundation.clearing.js"></script>
	
	<script src="javascripts/foundation/foundation.cookie.js"></script>
	
	<script src="javascripts/foundation/foundation.dropdown.js"></script>
	
	<script src="javascripts/foundation/foundation.forms.js"></script>
	
	<script src="javascripts/foundation/foundation.interchange.js"></script>
	
	<script src="javascripts/foundation/foundation.joyride.js"></script>
	
	<script src="javascripts/foundation/foundation.magellan.js"></script>
	
	<script src="javascripts/foundation/foundation.orbit.js"></script>
	
	<script src="javascripts/foundation/foundation.placeholder.js"></script>
	
	<script src="javascripts/foundation/foundation.reveal.js"></script>
	
	<script src="javascripts/foundation/foundation.section.js"></script>
	
	<script src="javascripts/foundation/foundation.tooltips.js"></script>
	
	<script src="javascripts/foundation/foundation.topbar.js"></script>
	
  
  <script>
    $(document).foundation();
  </script>
</body>
</html>
