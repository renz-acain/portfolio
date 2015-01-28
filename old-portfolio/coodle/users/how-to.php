<?php
#start session
session_start();

#set navigation id
$userNavID = 5;

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
	<title>Coodle - How-To-Videos</title>
	<link rel="stylesheet" href="../stylesheets/app.css">
	
  <link rel="stylesheet" href="../stylesheets/default.css">
	<script src="../javascripts/vendor/custom.modernizr.js"></script>
</head>
<body>



	<!-- Start of nav bar -->
		<?php include("includes/nav.inc.php"); ?>
	<!-- End of nav -->
		<div class="row">
			<h1>How-to videos</h1>
			<p>Learn different things by watching our How-to videos collection</p>
		</div>
	</div> <!-- Closing tag of the container in PHP -->
	<div class="row">
		<div class="small-12 columns">
			<div class="row">
				<div class="large-12 columns">
				<h3>How-to videos</h3>
				</div>
			</div>
			<div class="row">
			
				<div class="large-3 columns ">
					<p>Here are some How-To-Videos that cover a range of different things. Each video is aimed at the very beginner and explains in detail each step to be taken.</p>
				</div>
				
				
				
				
				
				<div class="large-9 columns">
					
					
					
									
					
					<!-- New video  -->
					<div class="row">
						<a href="#" data-reveal-id="video1">
							<div align="center" class="small-4 large-4 columns">
								<img src="../imgs/ironing.png" />
							</div>
							<div class="small-8 large-8 columns">
								<p><strong>How to Iron</strong></a><br>
								This shows you how to iron by giving you easy to follow, step by step instructions to flawlessly remove every crease.</p>
								<!-- <ul class="inline-list">
								  <li><a href="">Reply</a></li>
								  <li><a href="">Share</a></li>
								</ul> -->
							</div>			
						
					</div>
					<hr>
					<!-- New video  -->
					<div class="row">
						<a href="#" data-reveal-id="video2">
							<div align="center" class="small-4 large-4 columns">
								<img src="../imgs/cake.png" />
							</div>
							<div class="small-8 large-8 columns">
								<p><strong>How to Bake a Cake</strong></a><br>
								This shows you how to bake a cake by giving you easy to follow, step by step instructions to bake a victoria sponge cake.</p>
								<!-- <ul class="inline-list">
								  <li><a href="">Reply</a></li>
								  <li><a href="">Share</a></li>
								</ul> -->
							</div>
						
					</div>
					<hr>
					<!-- New video  -->
					<div class="row">
						<a href="#" data-reveal-id="video3">
							<div align="center" class="small-4 large-4 columns">
								<img src="../imgs/internet.png" />
							</div>
							<div class="small-8 large-8 columns">
								<p><strong>How to Use the Internet</strong></a><br>
								This shows you how to use the internet by giving you easy to follow, step by step instructions to give people of any age a basic understanding of the internet.</p>
								<!-- <ul class="inline-list">
								  <li><a href="">Reply</a></li>
								  <li><a href="">Share</a></li>
								</ul> -->
							</div>
						
					</div>
					<hr>
				 </div>
			</div>
			 
			    <!-- Right Sidebar -->

			 
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
	
	
	
	
	<div id="video1" class="reveal-modal small">
		<div class="row text-center">
			<h1>How to Iron a Shirt</h1>
			<div class="flex-video">
				<iframe width="100%" height="310" src="//www.youtube.com/embed/mXDspMt69WY?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
			</div>
			<p>This How-To-Video shows you how to iron by giving you easy to follow, step by step instructions to flawlessly remove every crease.</p>
		</div>
		
		 <a class="close-reveal-modal">&#215;</a>
	</div>
	
	<div id="video2" class="reveal-modal small">
		<div class="row text-center">
			<h1>How To Bake a Cake</h1>
			<div class="flex-video">
				<iframe width="100%" height="310" src="//www.youtube.com/embed/trOh9qdld50?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
			</div>
			<p>This How-To-Video shows you how to bake a cake by giving you easy to follow, step by step instructions to bake a victoria sponge cake.</p>
		</div>
		
		 <a class="close-reveal-modal">&#215;</a>
	</div>
	
	<div id="video3" class="reveal-modal small">
		<div class="row text-center">
			<h1>How To Use The Internet</h1>
			<div class="flex-video">
				<iframe width="300" height="200" src="//www.youtube.com/embed/-Q08tftUJ30?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
			</div>	
			<p>This How-To-Video shows you how to use the internet by giving you easy to follow, step by step instructions to give people of any age a basic understanding of the internet.</p>
		</div>
		
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
