<?php
#start session
session_start();

#set navigation id
$userNavID = 3;

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
  
   <title>Coodle - Assigning tasks</title>

</head>
<body>
	
	<!-- Start of nav bar -->
		<?php include("includes/nav.inc.php"); ?>
	<!-- End of nav -->
	
	<!-- To-do list -->
		<div class="row">
		<h1>Tasks</h1>
			<p>See your to-do list or assign task</p>
		</div>
		
		
	</div> <!-- end of container from php -->
	
	<div class="row">
	
		<p class="small-12 columns text-right">
						<b>
						<script>
							document.write("Date: " + dayNames[day] + " " + date + " " + monthNames[month] + " " + year + "<br />");
						</script>
						</b>
					</p>
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
		
		
		
		<!-- End of To-do list -->
			<div class="medium-6 columns">
				<form>
					<fieldset>
						<legend>Assign tasks</legend>
						<div class="row">
							<div class="small-12 medium-6 columns">
								<label>From:</label>
								<input type="text" placeholder="Name or Mum/Dad">
							</div>
							<div class="small-12 medium-6 columns">
								<label>To:</label>
								<input type="text" placeholder="name or email?">
							</div>	
							
						</div>
						<label>Task/s:</label>
						<input type="text" placeholder="dropdown list or input?"> 
						<label>Note</label>
						<textarea placeholder="Detail of the task"></textarea>
						<div class="row">
							<div class="small-12 medium-6 columns">
								<label>Date:</label>
								<input type="text" placeholder="Today's date in what format?">
							</div>	
							<div class="small-12 medium-6 columns">
								<label>Due Date:</label>
								<input type="date" id="lblDate">
							</div>
						</div>
						<button type="submit" class="small radius">Submit</button>
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
