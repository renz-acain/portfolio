<?php
#start session
session_start();

#set navigation id
$userNavID = 2;

#authentication check
require_once("includes/auth.check.inc.php");

#load the user class
require_once("../library/user.class.php");

if(isset($_SESSION['coodle']['userHandle']))
{
	$userHandle = unserialize($_SESSION['coodle']['userHandle']);
}
#define base URL
define("__BASE_URL__","../");

#include connection to db
include_once("../includes/db.connect.inc.php");
?>


<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  
<link rel="shortcut icon" href="../imgs/logo-small.png" type="image/png" />

  <link rel="stylesheet" href="../stylesheets/app.css">
  <link rel="stylesheet" href="../stylesheets/default.css">
  <script src="../javascripts/vendor/custom.modernizr.js"></script>
  <script src="../javascripts/dates.js"></script>
  
   <title>Coodle - Profile</title>

</head>
<body>
	
	<!-- Start of nav bar -->
		<?php include("includes/nav.inc.php"); ?>
	<!-- End of nav -->
	
	
		<div class="row">
			<h1>My Profile</h1>
			<p>Update your profile and see if there is new message or task for you.</p>
		</div>
	</div> <!-- Closing tag of the container in PHP -->
	<div class="row">
				<div class="medium-6 columns  space">
					<div class="row">
					<div class="small-6 columns">
						<img src="../imgs/renz.jpg">
					</div>
					<div class="small-6 columns">
						<p><b><?php echo $userHandle->getProperty('firstName'); ?></b><br>
						<a href="messaging.php">1 new message(s)</a><br>
						<a href="tasks.php">1 new task(s)</a></p>
					</div>
					</div>
					<div class="row">
						<div class="small-8 small-centered columns">
							<a href="#" class="button small radius expand  space" data-reveal-id="editProfile">Edit Profile</a>
							<a href="tasks.php" class="button small radius expand">Assign tasks</a>
							<a href="messaging.php" class="button small radius expand">Send a Message</a>
							<a href="how-to.php" class="button small radius expand">How-to video</a>
						</div>
					
					</div>
					
				</div>
				<hr class="show-for-small space">
				<div class="medium-6 columns">
					<h2>To-do list</h2>
						<div class="section-container accordion" data-section="accordion">
							<!-- The date today -->
							<section class="active">
								<p class="title" data-section-title><a><script>
										document.write(dayNames[day] + " " + date + " " + monthNames[month] + " " + year + "<br />");
									</script></a></p>
								<div class="content" data-section-content>
									 <p>No tasks for this day</p>
								</div>
							</section>
							
							<!-- The next day -->
							<section>
								<p class="title" data-section-title><a><script>
										document.write(dayNames[tomDay] + " " + tomDate + " " + monthNames[tomMonth] + " " + tomYear + "<br />");
									</script></a></p>
								<div class="content" data-section-content>
									 <p>No tasks for this day</p>
								</div>
							</section>
							
							
							<!-- The next day -->
							  <section>
									<p class="title" data-section-title>
										<a>
											<script>
												document.write(dayNames[nDay] + " " + nDate + " " + monthNames[nMonth] + " " + nYear + "<br />");
											</script>
										</a>
									</p>
								    <div class="content" data-section-content>
									 <p>No tasks for this day</p>
									 <p>No tasks for this day</p>
									 <p>No tasks for this day</p>
									 <p>No tasks for this day</p>
									 <p>No tasks for this day</p>
								    </div>
							  </section>
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
					<li><a href="../sitemap.php">Sitemap</a></li>
				</ul>
			</div>
		</div>
	</div> 
</footer>
<!-- End of footer --> 
	
	
<!-- The start of editing the profile-->	
<div id="editProfile" class="reveal-modal small">
		<form class="custom" data-abide>
			<fieldset>
				<legend>Edit profile</legend>
				<div class="row">
					<div class="medium-6 columns">
					  <label>Firstname:</label>
					  <input type="text" placeholder="Enter first name ..">
					</div>
					<div class="medium-6 columns">
					  <label>Lastname:</label>
					  <input type="text" placeholder="Enter family name ..">
					</div>
					<div class="medium-6 columns">
						<div class="email-field">
								<label>Email address:<small>required</small></label>
								<input type="email" placeholder="Enter the name here .." required>
								<small class="error">An email address is required.</small>
						</div>
					</div>	
					<div class="medium-6 columns">
					<label>Family Role</label>
						<select id="customDropdown">
					    <option>Son</option>
					    <option>Daughter</option>
					    <option>Father</option>
					    <option>Mother</option>
					    <option>Others</option>
					    
					  </select>
					
					</div>
					 <a class="button small radius">Edit</a>
				</div>			
				
			 
			</fieldset>
		</form>
		
		 <a class="close-reveal-modal">&#215;</a>
	</div>	
	
<!-- list of javascripts -->
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? '../javascripts/vendor/zepto' : '../javascripts/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="../javascripts/foundation/foundation.js"></script>
	
	<script src="../javascripts/foundation/foundation.abide.js"></script>
	
	<script src="../javascripts/foundation/foundation.alerts.js"></script>
	
	<script src="../javascripts/foundation/foundation.clearing.js"></script>
	
	<script src="../javascripts/foundation/foundation.cookie.js"></script>
	
	<script src="../javascripts/foundation/foundation.dropdown.js"></script>
	
	<script src="../javascripts/foundation/foundation.forms.js"></script>
	
	<script src="../javascripts/foundation/foundation.interchange.js"></script>
	
	<script src="../javascripts/foundation/foundation.joyride.js"></script>
	
	<script src="../javascripts/foundation/foundation.magellan.js"></script>
	
	<script src="../javascripts/foundation/foundation.orbit.js"></script>
	
	<script src="../javascripts/foundation/foundation.placeholder.js"></script>
	
	<script src="../javascripts/foundation/foundation.reveal.js"></script>
	
	<script src="../javascripts/foundation/foundation.section.js"></script>
	
	<script src="../javascripts/foundation/foundation.tooltips.js"></script>
	
	<script src="../javascripts/foundation/foundation.topbar.js"></script>
	
  
  <script>
    $(document).foundation();
  </script>
</body>
</html>
