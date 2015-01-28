
<html>

<head>
<title>Cart page</title>
</head>

<body>
<?php
//fix the cart tomorrow and try to ACTUALLY finish the C grade
// start with the input box for qty [ DONE ]
// dropdownlist
// maybe create an edit button
//maybe put the occId in an array
// if update button is clicked, go back to the product page to edit

// find cartItemId then update the occId

require ("includes/config.inc.php");
// when a colour of cart is changed, all the items in cart changes with same occId

	// if array named userId in $_SESSION does not exist, add one

		$query = sprintf("SELECT i.cartId FROM cartitem i NATURAL JOIN cart c WHERE c.userId='%s' AND c.cartStatus='active'", $userId);
		$cartIdQuery = mysqli_query($con, $query);
		$res = mysqli_fetch_assoc($cartIdQuery);
		$cartId = $res['cartId'];
	

	

if (isset($_POST['cartId'])) {
	$cartId = $_POST['cartId'];
}


$errors = null;
$sameError = null;
$proceedErrors = null;

if (isset($_POST['occId'])) {
	$occId = $_POST['occId'];
}




if (isset($_POST['productId'])) {
   $proId = $_POST['productId'];
}




if (isset($_POST['updateColour'])) {
	// get the ID by selecting the products with the selected colour
	$size = $_POST['occSize'];
	$colour = $_POST['occColour'];
	$quer = sprintf("SELECT occId FROM occurrence WHERE productId=$proId AND occColour='$colour'");
					$occIdQuery = mysqli_query($con, $quer);
					if (mysqli_num_rows($occIdQuery) < 1) {
						$occId = $_POST['occId'];
					} else {
					$res = mysqli_fetch_assoc($occIdQuery);
					$occId = $res['occId'];
					}
					
					$cii = $_POST['cartItemId'];		
						mysqli_query($con, "UPDATE cartitem SET occId = $occId WHERE cartItemId=$cii");
						
						// check for similar occId
						$check = mysqli_query($con, "SELECT cartItemId FROM cartitem WHERE occId=$occId");
						
						//if none, get the occId to display the right product
						if (mysqli_num_rows($check) == 1 ) {
							$idQuery = mysqli_query($con, "SELECT occId FROM cartitem WHERE cartItemId=$cii");
						$re = mysqli_fetch_assoc($idQuery);
						$occId = $re['occId'];
						} elseif (mysqli_num_rows($check) >= 2) {
							//maybe delete the row that is not edited then add quantity instead.
							 mysqli_query($con, "DELETE FROM cartitem WHERE cartItemId != $cii AND occId = $occId");
							 mysqli_query($con, "UPDATE cartitem SET cartItemQty = cartItemQty + 1 WHERE cartItemId = $cii AND occId=$occId");
							$sameError = "Product exists, added 1 quantity instead";
							echo "<p style='color: red'>$sameError</p>";
						}
}

// gets the $size and $proId to identify the occId of the selected size
// then the cartitem's occId for the particular cartItemId will be updated
// Before updating, cartitem table is checked for duplicate occId 
// if there is only one occId, get the occId of the cartItemId
// if there are two, delete the other cartItemId with the same occId
// then add 1 to the quantity
// improve later by adding an alert box (if needed or have enough time)
if (isset($_POST['updateSize'])) {
	$size = $_POST['occSize'];
	$colour = $_POST['occColour'];
	
	$quer = sprintf("SELECT occId FROM occurrence WHERE productId=$proId AND occSize='$size'");
					$occIdQuery = mysqli_query($con, $quer);
					if (mysqli_num_rows($occIdQuery) < 1) {
						$occId = $_POST['occId'];
					} else {
					$res = mysqli_fetch_assoc($occIdQuery);
					$occId = $res['occId'];
					}
			$cii = $_POST['cartItemId'];		
			mysqli_query($con, "UPDATE cartitem SET occId = $occId WHERE cartItemId=$cii");
			
			// check for similar occId
			$check = mysqli_query($con, "SELECT cartItemId FROM cartitem WHERE occId=$occId");
			
			//if none, get the occId to display the right product
			if (mysqli_num_rows($check) == 1 ) {
				$idQuery = mysqli_query($con, "SELECT occId FROM cartitem WHERE cartItemId=$cii");
			$re = mysqli_fetch_assoc($idQuery);
			$occId = $re['occId'];
			} elseif (mysqli_num_rows($check) >= 2) {
				//maybe delete the row that is not edited then add quantity instead.
				 mysqli_query($con, "DELETE FROM cartitem WHERE cartItemId != $cii AND occId = $occId");
				 mysqli_query($con, "UPDATE cartitem SET cartItemQty = cartItemQty + 1 WHERE cartItemId = $cii AND occId=$occId");
				$sameError = "This exists, add quantity instead";
				echo "<p style='color: red'>$sameError</p>";
			}
			
			
			
}


//$fromQuery = mysqli_query($con, "SELECT occSize, occColour FROM occurrence WHERE occId='$occId'");
//		while ($re = mysqli_fetch_array($fromQuery)) {
//			$colour = $re['occColour'];
//			$size = $re['occSize'];
//		}
		

// echo "cart is $cartId";
// Delete line when the button Delete gets clicked
if (isset($_POST['delete'])) {
  $cii = $_POST['cartItemId'];
  mysqli_query($con, "DELETE FROM cartitem WHERE cartItemId = $cii");
}
  
if (isset($_POST['updateQty'])) {
	$cii = $_POST['cartItemId'];
	$qty = $_POST['cartItemQty'];
	mysqli_query($con,"UPDATE cartitem SET cartItemQty = $qty WHERE cartItemId = $cii");
	
}

if (isset($_POST['cartItemQty'])){
	$qty = $_POST['cartItemQty'];
}

if (isset($_POST['checkout'])) {
	$cartNum = $_POST['cartNum'];
	$errors = $_POST['errors'];
		if (($errors == null) && ($cartNum != 0)) {
			$_SESSION['outCheck'] = 1;
			header('Location: checkout.php');
			exit;
		} elseif ($errors != null){
			$proceedErrors = "Error found, please fix it before trying to checkout.";
		} elseif ($cartNum == 0) {
			$proceedErrors = "You cannot proceed without item/s! Come on!";
		}
}

// codes below goes here
//echo "$cii on that row";
?>
<?php

?>





<?php include("includes/nav.inc.php"); ?>
<h2>Your cart</h2>
<?php

// check if the query is running.. if it does not, it means there are no items in the cart.
$cartQuery = sprintf("SELECT p.productName, i.cartItemId, i.cartItemQty, i.cartItemPrice, o.occPrice, o.occSize, o.occColour, o.occStock, o.productId FROM product p, cartitem i, cart c, occurrence o WHERE c.cartId = i.cartId AND i.occId = o.occId AND p.productId = o.productId AND c.cartId = $cartId AND c.cartStatus='active'");
//$result = mysqli_query($con, $cartQuery) or die ("Error fetching cart details" . $cartQuery);
if ((!mysqli_query($con, $cartQuery)) || (mysqli_num_rows(mysqli_query($con, $cartQuery)) < 1)) {
	print '<p>No product in your cart! Shop <a href="products.php">here</a></p>';
	
} else {
	$result = mysqli_query($con, $cartQuery);
	
	
	
	// change the status of cart to saved?
	// when user logged in, set cart to active
	$saveErr = null;
	if (isset($_POST["saveCart"])) {
		$cartNum = $_POST['cartNum'];
		$errors = $_POST['errors'];
		if (($cartNum > 0) && (isset($_SESSION['log'])) && ($errors == null)) {
			
			$quer = mysqli_query($con, "SELECT * FROM cart WHERE cartStatus='saved' AND userId='$userId'");
			
			// if there are no saved, update the active cart but not the ordered cart
			if (mysqli_num_rows($quer) < 1) {
				mysqli_query($con, "UPDATE cart SET cartStatus='saved' WHERE userId='$userId' AND cartStatus='active'");
				header("Location: user.php");
				exit;
			} else {
				$saveErr = "You already have a saved cart! Go to My account to delete or use";
			}
		} elseif ($cartNum < 1) {
			$saveErr = "You're cart is empty!";
		} elseif (!isset($_SESSION['log'])) {
			$saveErr = "Sorry! this is a feature for registered user only. If you have registered, please login.";
		} elseif ($errors != null) {
			$saveErr = "Errors found! Fix them please before saving the cart again.";
		}
	}
?>



<?php


	if (mysqli_num_rows($result) > 0) {
	// the statement above will show an error if the user try to go to the cart without any items.
	
	$total = 0;
	?>
	
	<table>
	  <tr>
		<th>Cart id</th>
		<th>Product</th>
		<th>Colour</th>
		<th>Size</th>
		<th>Stock</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
		
	  </tr>
	  
	<?php
	//Maybe change some query to updates then select to show updated items
	//Get all the fields of the cartitem
	
	
	  while($row = mysqli_fetch_assoc($result)) {
		$proName = $row['productName'];
		$qty = $row['cartItemQty'];
		$cPrice = $row['cartItemPrice'];
		$op = $row['occPrice'];
		$oc = $row['occColour'];
		$ost = $row['occStock'];
		$cii = $row['cartItemId'];
		$proId = $row['productId'];
	
	?>
		<tr>
		
			<td><?php print $cii ?></td>
			<td>
				<?php print $proName ?>
			</td>
		<!--Update the COLOUR-->
			<td>
				<?php
				if(isset($_POST['occColour'])){
							$colour = $_POST['occColour'];
							}
				?>
				<!--Update colour-->
				<form method="POST" action="">
				<select name="occColour" onchange="this.form.submit()">
					<!--Get all the colours from the occurence-->
					<?php
						if (isset($_POST['occColour'])) {
						$colour = $_POST['occColour'];
						}
					
						$colourQuery = mysqli_query($con, "SELECT DISTINCT o.occColour, o.occSize FROM occurrence o NATURAL JOIN cartitem i WHERE i.cartItemId=$cii");
						$res = mysqli_fetch_assoc($colourQuery);
						$colour = $res['occColour'];
						$size = $res['occSize'];
						
						$listColour = mysqli_query($con, "SELECT DISTINCT occColour FROM occurrence WHERE productId=$proId AND occSize='$size'");
						while ($data = mysqli_fetch_array($listColour)) {
						$oc = $data['occColour'];
					?>
							<option value="<?php print $oc ?>" <?php if($colour == $oc){ echo "selected"; } ?>>
								<?php
									print $oc;
								?>
							</option>
					<?php
					}
					?>
				</select>
				<input type="hidden" name="occSize" value="<?php print $size ?>">
				<input type="hidden" name="productId" value="<?php print $proId ?>">
				<input type="hidden" name="cartItemId" value="<?php print $cii ?>">
				<input type="hidden" name="productId" value="<?php print $proId ?>">
				<input type="hidden" name="updateColour">
				</form>
			</td>
		
		
			<!--Update SIZE-->
			<td>
				<form method="POST" action="">
					<select name="occSize" onchange="this.form.submit()">
						<?php
						if (isset($_POST['occSize'])) {
						$size = $_POST['occSize'];
						}
						
						// get the selected row
						$updateSize = mysqli_query($con, "SELECT DISTINCT o.occSize, o.occColour FROM occurrence o NATURAL JOIN cartitem i WHERE i.cartItemId=$cii");
						$res = mysqli_fetch_assoc($updateSize);
						$size = $res['occSize']; // this is the occSize, select this 
						$colour = $res['occColour'];
						
						$listSize = mysqli_query($con, "SELECT DISTINCT occSize FROM occurrence WHERE productId=$proId AND occColour='$colour'");
						
							while ($dat = mysqli_fetch_array($listSize)) {
								$osi = $dat['occSize'];
						?>
								<option value="<?php print $osi ?>" <?php if ($size == $osi) { echo "selected"; } ?>>
									<?php print $osi ?>
								</option>
							<?php
							}
						?>
					</select>
					<!--<input type="hidden" name="occSize" value="<?php print $size ?>"> no need for this because select is $_POST['occSize']-->
					<input type="hidden" name="occColour" value="<?php print $colour ?>">
					<input type="hidden" name="productId" value="<?php print $proId ?>">
					<input type="hidden" name="cartItemId" value="<?php print $cii ?>">
					<input type="hidden" name="cartId" value="<?php print $cartId ?>">
					<input type="hidden" name="updateSize">
				</form>
			</td>
		
			<td><?php print $ost ?></td>
			<td><?php print "&pound;$op"; ?></td>
			<!--Quantity-->
			<td>
				<form method="POST" action="">
					<?php
						mysqli_query($con, "UPDATE cartitem SET cartItemQty = $qty WHERE cartItemId=$cii");
						$updateQty = mysqli_query($con, "SELECT cartItemQty FROM cartitem WHERE cartItemId=$cii");
						$row = mysqli_fetch_assoc($updateQty);
						$qty = $row['cartItemQty'];
					?>
					<input type="text" name="cartItemQty" size="3" value="<?php print $qty ?>" onchange="this.form.submit()">
					
					<input type="hidden" name="cartItemId" value="<?php print $cii ?>">
					<input type="hidden" name="cartId" value="<?php print $cartId ?>">
					<input type="hidden" name="occId" value="<?php print $occId ?>">
					<input type="hidden" name="updateQty">
				</form>	
			</td>
			<!--Totals -->
			<td>
				<?php
				if ($qty <= $ost) {
					$quer = sprintf("UPDATE cartitem SET cartItemPrice = $op * $qty WHERE cartItemId = $cii");
					mysqli_query($con, $quer);
					$priceQuery = sprintf("SELECT cartItemPrice FROM cartitem WHERE cartItemId = $cii");
					$priceQty = mysqli_query($con, $priceQuery);
					$res = mysqli_fetch_assoc($priceQty);
					$p = $res['cartItemPrice'];
					print "&pound;$p";
				} else {
					print "<span style='color: red'>Fail to calculate!</span>";
				}
				?>
			</td>

					<form method="POST" action="">
						<td>
							<input type="hidden" name="occId" value="<?php print $occId ?>">
							<input type="hidden" name="cartId" value="<?php print $cartId ?>">
							<input type="hidden" name="cartItemId" value="<?php print $cii ?>">
							<input type="submit" name="delete" value="Delete">
						</td>
					</form>	
						<td>
							<?php
							if ($qty > $ost) {
										$errors = "Sorry! $ost stock left.";
										print "<span style='color: red'>$errors</span>";
										print "<span style='color: red'>$sameError</span>";
									} 
							?>
						</td>
	<?php
		} // Exit while statement
	?>
	  </tr>
		
	
	
	
	
	<!--Total of all items-->
	<?php
	
		if ($cartId != 0) {
		$query = mysqli_query($con, "SELECT SUM(cartItemPrice) AS total FROM cartitem WHERE cartId=$cartId");
		$row = mysqli_fetch_assoc($query);
		$total = $row['total'];
		}
	?>
	  <tr>
		<th colspan="7" align="right">Total</th>
		<td><?php print "&pound;$total";?></td>
	  </tr>
	  
	</table>
		<form method="POST">
			
			<input type="hidden" name="errors" value="<?php print $errors ?>">
			<input type="hidden" name="cartNum" value="<?php print $cartNum ?>">
			<input type="submit" name="checkout" value="Check out!">
				<?php
			
				print "<span style='color: red'>$proceedErrors</span>";
			//echo "$errors";
			//echo "$cartNum";
			?>
		</form>
		
		<form action="" method="POST">
			
			<!--isset here -->
			<input type="hidden" name="errors" value="<?php print $errors ?>">
			<input type="hidden" name="cartNum" value="<?php print $cartNum ?>">
			<input type="submit" name="saveCart" value="Save cart!">
			<?php
			
				print "<span style='color: red'>$saveErr</span>";
			//echo "$errors";
			//echo "$cartNum";
			?>
		</form>
	<?php
	}
}
?>




</body>
<?php
    mysqli_close($con);
?>

</html>