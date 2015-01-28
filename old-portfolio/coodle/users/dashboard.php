<?php
#start session
session_start();

#set navigation id
$userNavID = 1;

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
  <title>Welcome back <?php echo $userHandle->getProperty('firstName'); ?>!</title>
<link rel="shortcut icon" href="../imgs/logo-small.png" type="image/png" />

  
  <link rel="stylesheet" href="../stylesheets/app.css">
  <link rel="stylesheet" href="../stylesheets/default.css">
  <link rel="stylesheet" href="../stylesheets/foundation-icons/foundation-icons.css">
  <script src="../javascripts/vendor/custom.modernizr.js"></script>
<script src="../javascripts/dates.js"></script>
</head>
<body>
	<!-- Start of nav bar -->
			<?php include("includes/nav.inc.php"); ?>
	<!-- End of nav -->
		<div class="row">
			<h1>My Dashboard</h1>
			<p>Thank you for choosing coodle. A list of the apps is shown for you to use.</p>

		</div>
	</div>	<!-- Closing tag of the container in PHP -->
		
			<div class="row">
			
			<p class="small-12 columns text-right">
						<b>
						<script>
							document.write("Date: " + dayNames[day] + " " + date + " " + monthNames[month] + " " + year + "<br />");
						</script>
						</b>
					</p>
				<div class="small-12 medium-6 columns">
				
					<span><?php include("../includes/notif.inc.php"); ?></span>
					
					
					
					
					
					
					<div class="row">
						<h2>Red Family</h2>
						<ul class="small-block-grid-3 text-center">
						    <li><img src="../imgs/keith.jpg" alt="Keith Mayoh, the Coodle project manager"><br>Keith Mayoh - Project Manager</li>
						    <li><img src="../imgs/jack.jpg" alt="Jack Pattison, the Coodle copywriter"><br>Jack Pattison - Copywriter</li>
						    <li><img src="../imgs/simon.jpg" alt="Simon Jolley, the Coodle programmer"><br>Simon Jolley - Programmer</li>
						    <li><img src="../imgs/michael.jpg" alt="Michael Fasipe, the Coodle database administrator"><br>Michael Fasipe - Database Administrator</li>
						    <li><img src="../imgs/juv.jpg" alt="Juvenal Ribeiro, the Coodle graphics designer"><br>Juvenal Ribeiro - Graphics Designer</li>
						    <li><img src="../imgs/renz.jpg" alt="Renzluck Acain, the Coodle front-end developer"><br>Renzluck Acain - Front-end Developer</li>
					    </ul>
					</div>
				</div>
		
		
	<!-- Start of button modal -->
	
	<!-- <div class="row space">
		
		<div class="row collapse">
		<div class="small-6 columns">
			<div class="small-12 columns">
				<a href="#" class="button expand secondary round" data-reveal-id="assignModal1">My Profile</a>
			</div>
			<div class="small-12 columns">
				<a href="#" class="button expand alert round" data-reveal-id="assignModal2">Messages</a>
			</div>
			
			<div class="small-12 columns">
				<a href="#" class="button expand success round" data-reveal-id="assignModal3">How-To-Videos</a>
			</div>
		</div>
		<div class="small-1 columns"></div>
		<div class="small-5 columns">
			<div class="small-12 columns">
				<a href="#" class="button expand success round" data-reveal-id="assignModal4">Assign Tasks</a>
			</div>
			
			<div class="small-12 columns">
				<a href="#" class="button expand secondary round" data-reveal-id="assignModal5">Add family member</a>
			</div>
		</div>
		</div>
	</div> -->
	
	
	
<div class="small-12 medium-6 columns">	
				
	<div class="small-12 columns">
		<h2>Apps</h2>
		<ul class="small-block-grid-3 large-block-grid-5 text-center">
			<li>
				<a href="profile.php">
					<figure>
						<img src="../imgs/apps/myprofile.png">
						<figcaption><strong>My Profile</strong></figcaption>
					</figure>
				</a>	
			</li>
			<li>
				<a href="tasks.php">
					<figure>
						<img src="../imgs/apps/feedback.png">
						<figcaption><strong>Assign tasks</strong></figcaption>
					</figure>
				</a>	
			</li>
			<li>
				<a href="messaging.php">
					<figure>
						<img src="../imgs/apps/message.png">
						<figcaption><strong>Messages</strong></figcaption>
					</figure>
				</a>
			</li>
			<li>
				<a href="#" data-reveal-id="myModal">
					<figure>
						<img src="../imgs/apps/family.png">
						<figcaption><strong>Add family member</strong></figcaption>
					</figure>
				</a>	
			</li>
			<li>
				<a href="how-to.php">
					<figure>
						<img src="../imgs/apps/how-to.png">
						<figcaption><strong>How-to videos</strong></figcaption>
					</figure>
				</a>	
			</li>
		</ul>
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


	


	<div id="myModal" class="reveal-modal small">
		<form class="custom" data-abide>
			<fieldset>
				<legend>Add family member</legend>
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
				</div>	
				
			  <a class="button small radius">Request or Add</a>
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
