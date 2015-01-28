<nav>
	<br>
		<p style="text-align: right;">
			<?php
				if (!empty($userId)) {
					//only calculate the active cart for the user
					$quer = sprintf("SELECT SUM(i.cartItemQty) as cartNum FROM cartitem i NATURAL JOIN cart c WHERE c.userId='%s' AND cartStatus='active'", $userId);
					$cartNumQ = mysqli_query($con, $quer);
					$res = mysqli_fetch_assoc($cartNumQ);
					$cartNum = $res['cartNum'];
				}
				
				if ($cartNum > 0) {
				?>	
					<form style="text-align: right;" action="addtocart.php" method="post">
					<?php		
						print "$cartNum product/s in ";
					?>
						<input type="submit" value="Shopping Cart">
					</form>
				<?php
				} else {
					$navErr = null;
					if (isset($_POST['postError'])) {
						$navErr = "Add product in cart first";
					}
					?>
					
					<form style="text-align: right;" action="" method="POST">
					<?php
					print "0 item in ";
					
					// prevent error in the addtocart.php when Shopping Cart button is clicked with 0 product in the list
					$quer = mysqli_query($con, "SELECT cartId FROM cart WHERE userId='$userId'");
					$res = mysqli_fetch_assoc($quer);
					$cartId = $res['cartId'];
					?>
						<input type="hidden" name="cartId" value="<?php $cartId ?>">
						<input type="submit" name="postError" value="Shopping Cart">
						
						<p style='color: red;'><?php print $navErr ?></p>
					</form>
					<?php
				}
				
					?>
		</p>
	<h4>
		<a href="index.php">Home</a> <a href="products.php">Products</a>
		<div style="float: right">
			<?php
			if (isset($_SESSION['log'])) {
				$stat = $_SESSION['log'];
				$ri = $_SESSION['roleId'];
				if (($stat == "in") && ($ri == 1)) {
					print '<a href="user.php">My Account</a> | <a href="logout.php">Logout</a>';
				} elseif (($stat == "in") && ($ri == 2)) {
					print '<a href="admin.php">Administration</a> | <a href="logout.php">Logout</a>';
				} else {
				print '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
				}
			} else {
				print '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
			}
			?>
		</div>
	</h4>
	
</nav>


