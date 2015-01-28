<?php
#start session
session_start();

#set navigation id
$userNavID = 4;

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
  
   <title>Coodle - Messaging</title>

</head>
<body>
	
	
	<!-- Start of nav bar -->
		<?php include("includes/nav.inc.php"); ?>
	<!-- End of nav -->

	
	<div class="row">
	
		<h1>Messaging</h1>
		<p>Read the messages or send message to your love ones</p>
	</div>
	
	</div> <!-- Closing tag of the container in PHP -->
	<div class="row">
	
		<div class="small-12 medium-6 columns">
		<h2>Messages:</h2>
			<hr>
			<a href="#" data-reveal-id="myModal">
				<h3>Mum <small>03/12/2013</small></h3>
				<p>Hi my beloved son</p>
			</a>
			<hr>
			<a href="#" data-reveal-id="myModal2">
				<h3>Dad <small>01/12/2013</small></h3>
				<p>Clean your room please!</p>
			</a>
			<hr>
		</div>
		
		
		<div class="small-12 medium-6 columns">

			<form class="custom" data-abide>
				<fieldset>
					<legend>Send a message</legend>
						<div class="email-field">
							<label>To:<small>required</small></label>
							<input type="email" placeholder="Enter the name here .." required>
							<small class="error">An email address is required.</small>
						</div>
						
						<div class="text-field">
							<label>Subject:<small>required</small></label>
							<input type="email" placeholder="Enter the subject .." required>
							<small class="error">Please enter the subject.</small>
						</div>
						
						<div class="row">
							 <div class="large-12 columns">
							   <label>Message:</label>
							   <textarea placeholder="Type your message here . . ."></textarea>
							 </div>
						</div>
							
						
						<button class="button expand round" type="submit">Send!</button>
				</fieldset>		
			</form>
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
	
	
	
	<!-- The messages are here -->
	<div id="myModal" class="reveal-modal small">
	  <h2>Mum <small>sent on: 03/12/2013</small></h2>
	  <p class="lead"><b>Hi my beloved son<b></p>
	  <p>Do not forget to clean your room! Love, Mum</p>
	  <a class="button small radius">Reply</a>
	  <a class="close-reveal-modal">&#215;</a>
	</div>
	
	
	<div id="myModal2" class="reveal-modal small">
	  <h2>Dad <small>sent on: 01/12/2013</small></h2>
	  <p class="lead"><b>Clean your room please!</b></p>
	  <p>Make sure your room is clean when I get home, OK? Love, Dad</p>
	  <a class="button small radius">Reply</a>
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
