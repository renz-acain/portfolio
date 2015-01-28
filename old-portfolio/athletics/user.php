<?php
require("includes/config.inc.php");
$userId = $_SESSION['userId'];


?>


<html>
	<head>
		<title>User page</title>
	</head>
	<body>
		<?php
			include("includes/nav.inc.php");
		?>
		
			<?php
			
			if (!isset($_SESSION['roleId'])) {
				
				$_SESSION['roleId'] = 0;
				
			}
			/////////////////////////
			// This page will only be accessible by a logged in member
			////////////////////////
			$errSave = null;
			if ((!isset($_SESSION['log'])) || ($_SESSION['roleId'] != 1)) {
				echo "Registered members only!";
			} else {
					if (isset($_POST['deleteSave'])) {
						
						
						$checkAct = mysqli_query($con, "SELECT * FROM cart WHERE userId='$userId' AND cartStatus='active'");
						if (mysqli_num_rows($checkAct) == 0) {
							$errSave = "No cart to save! You might have already saved your current cart. Alternatively, you can just delete your saved cart instead.";
						} else {
							mysqli_query($con, "DELETE FROM cart WHERE cartStatus='saved' AND userId='$userId'");
							mysqli_query($con, "UPDATE cart SET cartStatus='saved' WHERE userId='$userId' AND cartStatus='active'");
						}
					}
					?>
			
				<?php
					if (isset($_POST['delete'])) {
						mysqli_query($con, "DELETE FROM cart WHERE cartStatus='saved' AND userId='$userId'");
					}
				?>
			
			
			<h1>Welcome!</h1>
			<h3>Saved cart</h3>
			<p style="color: red"><?php print $errSave; ?></p>
			<?php
				$acQuery = sprintf("SELECT cartId FROM cart WHERE userId='%s' AND cartStatus='saved'", $userId);
				$actQuery = mysqli_query($con, $acQuery);
				$res = mysqli_fetch_assoc($actQuery);
				$activeCart = $res['cartId'];
	
				// change the cartStatus from active to ordered to show the current cart and previous purchase.			
				$query = "SELECT p.productName, o.occSize, o.occColour, i.cartItemQty, i.cartItemPrice FROM cartitem i
				NATURAL JOIN occurrence o JOIN product p ON (o.productId = p.productId) WHERE cartId='$activeCart'";
				$cartQuery = mysqli_query($con, $query);
				if (mysqli_num_rows($cartQuery) > 0) {
					while ($res = mysqli_fetch_array($cartQuery)) {
						$pi = $res['productName'];
						$os = $res['occSize'];
						$oc = $res['occColour'];
						$ciq = $res['cartItemQty'];
						$cip = $res['cartItemPrice'];
						
						print "<p>$pi $os $oc $ciq $cip</p>";
					}
					
					
					//CONTINUE BUTTON
					if (isset($_POST['continue'])) {
						// delete existing active cart for the user
						mysqli_query($con, "DELETE FROM cart WHERE cartStatus='active' AND userId='$userId'");
						mysqli_query($con, "UPDATE cart SET cartStatus='active' WHERE userId='$userId' AND cartStatus='saved'");
						
						header("Location: addtocart.php");
						exit;
					}
					
					?>
					<form action="" method="POST">
							<input name="continue" type="submit" value="Continue Shopping">
					</form>
					
					
					<?php
					if (isset($_POST['checkout'])) {
						mysqli_query($con, "UPDATE cart SET cartStatus='saved' WHERE userId='$userId' AND cartStatus='active'");
						
						header("Location: checkout.php");
						exit;
					}
					?>
					<form action="" method="POST">
							<input name="checkout" type="submit" value="Checkout">
					</form>
					
					<!--delete buttON-->
					
					<form action="" method="POST">
							<input name="delete" type="submit" value="Delete cart">
					</form>
					
					
					<form action="" method="POST">
							<input name="deleteSave" type="submit" value="Delete and save current cart">
					</form>
					
					<?php
					
				} else {
					print "<p>No items in your cart! <a href='products.php'>Shop now</a></p>";
				}
				
			?>
			
			
			<h3>Previous purchases</h3>
			<?php
			
				$bQuery = sprintf("SELECT c.cartId, o.orderDate, o.orderStatus FROM `cart` c NATURAL JOIN `order` o WHERE c.userId='%s' AND c.cartStatus='ordered'", $userId);
				$boughtQuery = mysqli_query($con, $bQuery);
				
				
				if (mysqli_num_rows($boughtQuery) > 0) {
					
					while ($res = mysqli_fetch_array($boughtQuery)) {
						
							$paidCart = $res['cartId'];
							$orDate = $res['orderDate'];
							$orSta = $res['orderStatus'];
							print "<h4>$orDate</h4>";
							print "<p><b>Status:</b>$orSta</p>";
							// change the cartStatus from active to ordered to show the current cart and previous purchase.
							$query = "SELECT p.productName, o.occSize, o.occColour, i.cartItemQty, i.cartItemPrice
							FROM `cartitem` i NATURAL JOIN occurrence o
							JOIN `product` p ON (o.productId = p.productId)
							WHERE i.cartId='$paidCart'";
							$pcQuery = mysqli_query($con, $query);
							if (mysqli_num_rows($pcQuery) > 0) {
								while ($res = mysqli_fetch_array($pcQuery)) {
									$pi = $res['productName'];
									$os = $res['occSize'];
									$oc = $res['occColour'];
									$ciq = $res['cartItemQty'];
									$cip = $res['cartItemPrice'];
									
									print "<p>Product: $pi<br> Size: $os<br> Colour: $oc<br> Qty: $ciq<br> Price: $cip</p>";
								}
							}
						
					}
				}else {
					print "<p>No previous transaction at the moment. Make one now!</p>";
				}
			?>
			
			<h3>Address: <a href="addressChange.php">Edit</a></h3>
				<table>
					<?php
						$query = mysqli_query($con, "SELECT * FROM address WHERE userId='$userId'");
						$res = mysqli_fetch_assoc($query);
						$address1 = $res['address1'];
						$address2 = $res['address2'];
						$city = $res['city'];
						$postcode = $res['postcode'];
						$_SESSION['addressId'] = $res['addressId'];
						print sprintf("<tr><td><b>Address 1:</b></td><td>%s</td></tr>", $address1);
						if (!empty($address2)) {
							print sprintf("<tr><td><b>Address 2:</b></td><td>%s</td></tr>", $address2);
						}
						print sprintf("<tr><td><b>City:</b></td><td>%s</td></tr>", $city);
						print sprintf("<tr><td><b>Postcode:</b></td><td>%s</td></tr>", $postcode);
					?>
				</table>
		<?php
		}
		?>
	</body>
</html>
<!--show the date of purchases of previous purchases-->
<!--when saving cart, change status..
	maybe add a use saved cart button to activate it?
	or when logged in, make it active?-->
	<!--delete and save current cart or just delete-->