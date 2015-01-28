<div class="contain-to-grid fixed">
				<nav class="top-bar">
					<ul id="top_title" class="title-area">
					<!-- Title Area -->
						<li class="name">
							<h1><a href="index.php"><img src="imgs/logo.png"></a></h1>
						</li>
				
						<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
						<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
					</ul>
					  <section class="top-bar-section">
						<!-- Right Nav Section -->
						<ul id="top_bar" class="left" align="center">
							<li class="divider"></li>
							<li class="<?php echo ($navID == 1) ? "active" : " " ;?>"><a href="index.php">Home</a></li>
							<li class="divider"></li>
							<li class="<?php echo ($navID == 2) ? "active" : " " ;?>"><a href="about.php">About Us</a></li>
							<li class="divider"></li>
							<li class="<?php echo ($navID == 3) ? "active" : " " ;?>"><a href="features.php">Apps</a></li>
							<li class="divider"></li>
						</ul>
						<!-- Left Nav section -->
						<ul class="right" align="center">
						<?php
							@session_start();
							if(!isset($_SESSION['coodle']['userHandle']))
							{
						?>
							<li class="<?php echo ($navID == 4) ? "active" : " " ;?>"><a href="login.php">Login</a></li>
							<li class="divider"></li>
							<li class="<?php echo ($navID == 5) ? "active" : " " ;?>"><a href="signup.php">Register</a></li>
						<?php
							}
							else
							{
						?>	
							<li class="divider"></li>
							<li><a href="users/dashboard.php">My Dashboard</a></li>
							<li class="divider"></li>
							<li><a href="users/logout.php">Logout</a></li>
						<?php
							}
						?>							
						</ul>
					  </section>
				</nav>
</div>