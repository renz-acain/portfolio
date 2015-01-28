<?php
#start session
session_start();

#set navigation id
$userNavID = 6;

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
  <meta name="description" content="coodle, family planning application, organised families, to-do-lists, calendars, reminders" />
  
  <link rel="shortcut icon" href="../imgs/logo-small.png" type="image/png" />
  <link rel="stylesheet" href="../stylesheets/app.css">
  <link rel="stylesheet" href="../stylesheets/default.css">
  <script src="../javascripts/vendor/custom.modernizr.js"></script>
  
   <title>Coodle - Questions & Feedback</title>

</head>
<body>
	
	<!-- Start of nav bar -->
		<?php include("includes/nav.inc.php"); ?>
	<!-- End of nav -->
	
	
	
		<div class="row">
			<h1>Questions & Feedback</h1>
			<p>If you have any doubt or questions about our service, please do not hesitate to send us emails</p>
		</div>
	</div> <!-- Closing tag of the container in PHP -->
	
	
	
	<div class="row">
	
	<div class="panel callout space small-12 medium-6 columns">
	<h2>Question & Queries</h2>
				<form class="custom" data-abide>
					<div class="email-field">
						<label>Email: <small>required</small></label>
						<input type="email" placeholder="Enter the email address .." required>
						<small class="error">An email address is required.</small>
					</div>
					<div class="text-field">
						<label>Subject: <small>required</small></label>
						<input type="text" placeholder="Enter the subject .." required>
						<small class="error">Enter the subject of the message please</small>
					</div>
					<div class="row">
						 <div class="large-12 columns">
						   <label>Message:</label>
						   <textarea placeholder="Type your message here . . ."></textarea>
						 </div>
					</div>
						
					
					<button class="button expand round secondary" type="submit">Send!</button>
				</form>
	</div>
	<div class="small-12 medium-6 columns">		
	<form class="custom">
			<fieldset>
		<legend>Feedback</legend>
			
				<label>How would you rate the features incorporated on the Coodle Family Planner? (5 highest)</label>
				  <label for="radio1">
				    <input name="radio1" type="radio" id="radio1" style="display:none;">
				    <span class="custom radio"></span> 1
				 
				    <input name="radio1" type="radio" id="radio1" style="display:none;">
				    <span class="custom radio"></span> 2
				  
				    <input name="radio1" type="radio" id="radio1" style="display:none;">
				    <span class="custom radio"></span> 3
				    
				    <input name="radio1" type="radio" id="radio1" style="display:none;">
				    <span class="custom radio"></span> 4
				    
				    <input name="radio1" type="radio" id="radio1" style="display:none;" CHECKED>
				    <span class="custom radio checked"></span> 5
				  </label>
				 <br> 
				  <!-- question 1 -->
				  <label for="customDropdown">What do you like about Coodle?</label>
					  <select id="customDropdown">
					    <option>Easy-to-use</option>
					    <option>Design</option>
					    <option>The apps</option>
					    <option>Services</option>
					    <option>Readability</option>
					    <option>All of the above!</option>
					  </select>
				  <br> 
				  
				  <!-- another question  -->
				  
				  <label>What features would you like to see on Coodle?</label>
				  <textarea placeholder="Type your message here . . ."></textarea>
				  <br> 
				 
				 <!-- another question  -->
				 
				  <label> How easy do you find it to use Coodle? (5 easiest)</label>
				  <label for="radio2">
				    <input name="radio2" type="radio" id="radio2" style="display:none;">
				    <span class="custom radio"></span> 1
				 
				    <input name="radio2" type="radio" id="radio2" style="display:none;">
				    <span class="custom radio"></span> 2
				  
				    <input name="radio2" type="radio" id="radio2" style="display:none;">
				    <span class="custom radio"></span> 3
				    
				    <input name="radio2" type="radio" id="radio2" style="display:none;">
				    <span class="custom radio"></span> 4
				    
				    <input name="radio2" type="radio" id="radio2" style="display:none;" CHECKED>
				    <span class="custom radio checked"></span> 5
				  </label>
				  <br> 
				 
				<!-- another question  -->
				 
				  <label>What would you give as an overall rating for Coodle? (5 highest)</label>
				  <label for="radio3">
				    <input name="radio3" type="radio" id="radio3" style="display:none;">
				    <span class="custom radio"></span> 1
				 
				    <input name="radio3" type="radio" id="radio3" style="display:none;">
				    <span class="custom radio"></span> 2
				  
				    <input name="radio3" type="radio" id="radio3" style="display:none;">
				    <span class="custom radio"></span> 3
				    
				    <input name="radio3" type="radio" id="radio3" style="display:none;">
				    <span class="custom radio"></span> 4
				    
				    <input name="radio3" type="radio" id="radio3" style="display:none;" CHECKED>
				    <span class="custom radio checked"></span> 5
				  </label>
				  <br> 
				  
				 <!-- another question  --> 
							  
				<label>Do you have any suggestions on how to improve Coodle?</label>
				  <textarea placeholder="Type your message here . . ."></textarea>
					<button class="small radius">Submit!</button>
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
