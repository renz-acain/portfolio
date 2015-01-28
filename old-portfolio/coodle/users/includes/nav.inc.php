<div class="contain-to-grid fixed">
	<nav class="top-bar">
		<ul id="top_title" class="title-area">
		<!-- Title Area -->
			<li class="name">
				<h1><a href="../index.php"><img src="../imgs/logo.png"></a></h1>
			</li>
    
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
		</ul>
		  <section class="top-bar-section">
		  
		  
			<!-- Right Nav for small section -->
			
			<ul class="left show-for-small" align="center">
				
				<li class="<?php echo ($userNavID == 1) ?"active" :"" ;?>"><a href="dashboard.php">Dashboard</a></li>
				
				<!-- <li align="left"><label><small>What would you like to do today?</small></label></li> -->
				<li class="divider"></li>
				<li class="<?php echo ($userNavID == 2) ?"active" :"" ;?>"><a href="profile.php">My Profile</a></li>
				<li class="divider"></li>
				<li class="<?php echo ($userNavID == 3) ?"active" :"" ;?>"><a href="tasks.php">Tasks</a></li>
				<li class="divider"></li>
				<li class="<?php echo ($userNavID == 4) ?"active" :"" ;?>"><a href="messaging.php">Messaging</a></li>
				<li class="divider"></li>
				<li class="<?php echo ($userNavID == 5) ?"active" :"" ;?>"><a href="how-to.php">How-to-videos</a></li>
				<li class="divider"></li>
				<li class="<?php echo ($userNavID == 6) ?"active" :"" ;?>"><a href="feedback.php">Feedback</a></li>
			</ul>
		  
			<!-- left Nav Section -->
			<ul  id="top_bar" class="left show-for-medium-up" align="center">
				<li align="left" class="show-for-small"><label><small>Main pages</small></label></li>
				<li class="divider"></li>
				<li><a href="../index.php">Home</a></li>
				<li class="divider"></li>
				<li><a href="../about.php">About Us</a></li>
				<li class="divider"></li>
				<li><a href="../features.php">Apps</a></li>
				<li class="divider"></li>
			</ul>
			<!-- right Nav Section -->
			<ul class="right  show-for-medium-up" align="center">
				<li class="divider"></li>
				<li><a href="#">Hello <?php echo $userHandle->getProperty('firstName'); ?>!</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		  </section>
	</nav>
</div>
            <!-- end of nav -->
            
		  
            <!-- Start of sub-nav pages -->	
		  <div id="container">
			<div class="row">
				<div class="small-12 columns hide-for-small space">
					<dl class="sub-nav">
						<dd class="<?php echo ($userNavID == 1) ?"active" :"" ;?>"><a href="dashboard.php">My Dashboard</a></dd>
						<dd class="<?php echo ($userNavID == 2) ?"active" :"" ;?>"><a href="profile.php">My Profile</a></dd>
						<dd class="<?php echo ($userNavID == 3) ?"active" :"" ;?>"><a href="tasks.php">Tasks</a></dd>
						<dd class="<?php echo ($userNavID == 4) ?"active" :"" ;?>"><a href="messaging.php">Messaging</a></dd>
						<dd class="<?php echo ($userNavID == 5) ?"active" :"" ;?>"><a href="how-to.php">How-to-videos</a></dd>
						<dd class="<?php echo ($userNavID == 6) ?"active" :"" ;?>"><a href="feedback.php">Feedback</a></dd>
					</dl>
				</div>
				
			</div> 
			<hr class="hide-for-small" id="wid">
		  <!-- the closing tag of container is in the html -->
	<!-- End of sub-nav bar pages -->