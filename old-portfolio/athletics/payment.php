<?php
// question: will it add with marking if we use JS to make it more interactive?
// when pay is clicked, ask user if they want to register by simply adding a password in
// or continue without registration


// display the address entered from delivery details, if wrong, edit (add edit button)
// billing address is same as delivery address? if not, edit (add edit button)
// show the cart as well

require("includes/config.inc.php");
unset($_SESSION['delCheck']);

if (!isset($_SESSION['pCheck'])) {
	
	header("Location: addtocart.php");
	exit;
	
}

$error = null;
$emptyCount = 0;
$date = date_create();
$date1 = date_format($date, 'Y-m-d H:i:s');

if (!isset($_SESSION['email'])) {
	header("Location: index.php");
}

$email = $_SESSION['email'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$address1 = $_SESSION['address1'];
$address2 = $_SESSION['address2'];
$townOrCity = $_SESSION['townOrCity'];
$postcode = $_SESSION['postcode'];

$baddress1 = $_SESSION['baddress1'];
$baddress2 = $_SESSION['baddress2'];
$btownOrCity = $_SESSION['btownOrCity'];
$bpostcode = $_SESSION['bpostcode'];

$query = sprintf("SELECT i.cartId FROM cartitem i NATURAL JOIN cart c WHERE c.userId='%s' AND cartStatus='active'", $userId);
			$cartIdQuery = mysqli_query($con, $query);
			$res = mysqli_fetch_assoc($cartIdQuery);
			$cartId = $res['cartId'];

			
			
function luhn_validate($s) {
						if(0==$s) {
							return(false);
						} // Don't allow all zeros
							$sum=0;
							$i=strlen($s); // Find the last character
							$l = $i%2; // Is length of the string even or odd
							while ($i-- > 0) { // Iterate all digits backwards
								$sum+=$s[$i]; // Add the current digit
								// If the digit is even, add it again. Adjust for digits 10+ by subtracting 9.
								($l==($i%2)) ? (($s[$i] > 4) ? ($sum+=($s[$i]-9)) : ($sum+=$s[$i])) : false;
								}
							return (0==($sum%10)) ;
					}

$delCost = 0;
	if (isset($_POST['delMet'])) {
		$delMet = $_POST['delMet'];
		if ($delMet == "standard") {
			$delCost = 0;
		} elseif ($delMet == "firstclass") {
			$delCost = 7;
		}
		
	}
					
					
if (isset($_POST['submit'])) {
	
	
	$arr = array('creditCard', 'nameOnCard');
	foreach($arr as $field) {
		if (empty($_POST[$field])) {
			$emptyCount++;
		  }
		}
	if ($emptyCount < 1) {
		
		//if (isset($_POST['delCost'])) {
		//	$delCost = $_POST['delCost'];
		//	if ($delCost == 0) {
		//		$delMet = "standard";
		//	} elseif ($delCost == 7) {
		//		$delMet == "firstclass";
		//	}
		//}
		$totalP = $_POST['total'];
		$delCost = $_POST['delCost'];
			if ($delCost == 0) {
				$delMet = "standard";
			} elseif ($delCost == 7) {
				$delMet = "firstclass";
			}
			echo "$delMet $delCost";
		$nameOnCard = $_POST['nameOnCard'];
		
		$creditCard = $_POST['creditCard'];
		
		//if user does not want to use the home address
		//enter billing address
		//if user want to use homeaddress,
		//assign homeaddress to billadd
		
		if (luhn_validate($creditCard)) {
			// base from cartId, deduct the stock of occStock from cartQuantity
			
			
			// deleted type field BUT MIGHT BE NECESSARY LATER ON
			mysqli_query($con, "INSERT INTO `user` (firstname, lastname, emailAdd, userId) VALUES ('$firstname', '$lastname', '$email', '$userId')");
			$add = sprintf("INSERT INTO `address` (address1, address2, city, postcode, userId) VALUES ('$address1', '$address2', '$townOrCity', '$postcode', '$userId')");
			$addressQuery = mysqli_query($con, $add) or die ($add);
			$addressId = mysqli_insert_id($con);
			
			
			
			
			$del = sprintf("INSERT INTO `delivery` (userId, deliveryMethod, deliveryCost, addressId) VALUES ('$userId', '$delMet', '$delCost', $addressId)");
			$deliveryQuery = mysqli_query($con, $del) or die ($del);
			$deliveryId = mysqli_insert_id($con);
			mysqli_free_result($deliveryQuery);
			
			// addressId should depend on the user NO BILLING ADDRESS AT THE MOMENT [ NEEDS TO BE UPDATED ]
			// (this query so far is, when user decided to use the same address for billing address)
			// if all variables are equal.. get same $addressId, if not, create a new addressId for billing address
			if (($address1 == $baddress1) && ($address2 == $baddress2) && ($townOrCity == $btownOrCity) && ($postcode == $bpostcode)) {
				$pay = sprintf("INSERT INTO `payment` (nameOnCard, addressId, creditCard, totalPayment) VALUES ('$nameOnCard', '$addressId', '$creditCard', '$totalP')");
			} else {
				$add = sprintf("INSERT INTO address (address1, address2, city, postcode, userId) VALUES ('$baddress1', '$baddress2', '$btownOrCity', '$bpostcode', '$userId')");
				$addressQuery = mysqli_query($con, $add) or die ($add);
				$baddressId = mysqli_insert_id($con);
				// get new addressId for the billing address
				$pay = sprintf("INSERT INTO `payment` (nameOnCard, addressId, creditCard, totalPayment) VALUES ('$nameOnCard', '$baddressId', '$creditCard', '$totalP')");
			}
			// if statement is to use either same $addressId or new $baddressId in the payment query
			$paymentQuery = mysqli_query($con, $pay) or die ($pay);
			$paymentId = mysqli_insert_id($con);
			mysqli_free_result($paymentQuery);
				
			$ord = "INSERT INTO `order` (deliveryId, cartId, paymentId, orderDate) VALUES ($deliveryId, '$cartId', $paymentId, '$date1')";
			$orderQuery = mysqli_query($con, $ord) or die ($ord);
			$orderId = mysqli_insert_id($con);
			mysqli_free_result($orderQuery);
			
			$upd = "UPDATE cart SET cartStatus='ordered' WHERE cartId='$cartId'";
			$updQuery = mysqli_query($con, $upd);
			
			// deduct the stock
			$upd = mysqli_query($con, "SELECT * FROM cartitem NATURAL JOIN occurrence WHERE cartId='$cartId'");
			while ($resu=mysqli_fetch_array($upd)) {
				$os = $resu['occStock'];
				$ciq = $resu['cartItemQty'];
				$oi = $resu['occId'];
				$os = $os - $ciq;
				mysqli_query($con, "UPDATE occurrence SET occStock='$os' WHERE occId = '$oi'");
			}
			
			//cartId in cartitem, occId, occStock, cartItemQty
			
			unset($_SESSION['email']);
			unset($_SESSION['firstname']);
			unset($_SESSION['lastname']);
			unset($_SESSION['address1']);
			unset($_SESSION['address2']);
			unset($_SESSION['townOrCity']);
			unset($_SESSION['postcode']);
			
			unset($_SESSION['baddress1']);
			unset($_SESSION['baddress2']);
			unset($_SESSION['btownOrCity']);
			unset($_SESSION['bpostcode']);
			
			$_SESSION['deCheck'] = 1;
			header("Location: purchaseDetails.php?abcd=".urlencode(base64_encode($orderId)));
			
			exit;
			// NEXT IS: Update occurenceStock of the products that was bought by the user
			// Change the cartStatus to ordered?
			
		} else {
			$error = "Invalid credit card! Please check again.";
		} // End of luhn validation
				
	} else {
		$error = "Fill all fields please!";
	} // end of checking for empty fields
} // exit of submit




?>
<html>
	<head>
		<title>Payment</title>
	</head>
	<body>
		<?php include("includes/nav.inc.php"); ?>
		<h1>
			Place order:
		</h1>
		<!--add total for all items.. including the del method so change the total depending on the delmet selected. then calculate vat-->
			<h2>Order Details:</h2>
			<p>Wrong product/s? <a href="addtocart.php"><b>Edit it!</b></a></p>
			<?php
				$getQuery = sprintf("SELECT i.cartItemId, i.occId, o.occColour, o.occSize, p.productName, i.cartItemPrice, i.cartItemQty FROM cartitem i INNER JOIN occurrence o ON (i.occId = o.occId) JOIN product p ON (p.productId = o.productId) WHERE i.cartId = $cartId");
				$getItemsToBuy = mysqli_query($con, $getQuery);
				?>
				<table style="text-align: center">
					<tr>
						<th>Product</th>
						<th>Colour</th>
						<th>Size</th>
						<th>Quantity</th>
						<th>Price</th>
					</tr>
					
				<?php
				while ($res = mysqli_fetch_assoc($getItemsToBuy)) {
					$cartItemId = $res['cartItemId'];
					$occId = $res['occId'];
					$occColour = $res['occColour'];
					$occSize = $res['occSize'];
					$proName = $res['productName'];
					$ciQty = $res['cartItemQty'];
					$ciPrice = $res['cartItemPrice'];
					echo "<tr>";
					print "<td>$proName</td>";
					print "<td>$occColour</td>";
					print "<td>$occSize</td>";
					print "<td>$ciQty</td>";
					print "<td>$ciPrice</td>";
					echo "<tr>";
				}
				
				

	if ($cartId != 0) {
	$query = mysqli_query($con, "SELECT SUM(cartItemPrice) AS total FROM cartitem WHERE cartId='$cartId'");
	$row = mysqli_fetch_assoc($query);
    $total = $row['total'];
	}

	
	
?>

<tr align="right">
	<th colspan="4">Delivery Cost:</th>
	<td>
	<?php
		printf("%.2f", $delCost);
		$incDel = $total + $delCost;
	?>
	</td>
</tr>

  <tr align="right">
    <th colspan="4">Total:</th>
	
    <td><?php print $incDel ?></td>
	<td><?php $vat = .2; $vatIs = round(($incDel * $vat), 2); $roundedVat = printf("(inc. VAT of 20&#37;, %.2f)", $vatIs); ?></td>
  </tr>
				</table>
			
				<h3>Delivery method:</h3>
				<form method="POST" action="">
					<input type="radio" name="delMet" value="standard" onclick="this.form.submit()" <?php if($delCost == 0){ echo "checked"; } ?>>Free Standard (3 to 7 days delivery)
					<input type="radio" name="delMet" value="firstclass" onclick="this.form.submit()" <?php if($delCost == 7){ echo "checked"; } ?>>7 pounds First Class (Next day delivery)
					
				</form>
				<hr style="clear: both">
				<h2>Payment Details:</h2>
			<form action="" method="POST">
				<p>We only accept credit card at the moment, sorry for the inconvenience!</p>
				<p style="color: red;">
					<?php print $error ?>
				</p>
				Name on card:
				<input type="text" name="nameOnCard" placeholder="Type exactly how it shows in card..">
				<br>
				Credit Card:
				<input type="text" name="creditCard" placeholder="Type credit card number">
				<input type="hidden" name="delCost" value="<?php print $delCost; ?>">
				<input type="hidden" name="total" value="<?php print $incDel; ?>">
				<br> 
					
					<h3>Billing Address:</h3>
					<p>Change billing address <a href="delivery.php">Edit</a></p>
					<?php
					
					if (($address1 == $baddress1) && ($address2 == $baddress2) && ($townOrCity == $btownOrCity) && ($postcode == $bpostcode)) {
						print "<p>Same as delivery address.</p>";
					} else {
						?>
						<table>
							<?php
							print sprintf("<tr><td><b>Address 1:</b></td><td>%s</td></tr>", $baddress1);
							if (!empty($_SESSION['baddress2'])) {
								print sprintf("<tr><td><b>Address 2:</b></td><td>%s</td></tr>", $baddress2);
							}
							print sprintf("<tr><td><b>City:</b></td><td>%s</td></tr>", $btownOrCity);
							print sprintf("<tr><td><b>Postcode:</b></td><td>%s</td></tr>", $bpostcode);
							?>
						</table>
					<?php
					}
					
					?>
			
				<input type="submit" name="submit" value="Pay">
				
					
			</form>
		
	<!--get sessions then display them for this page only, when successfully paid, insert them into the database
		then destroy them when user successfully paid for items.
		list items here as well -->
	
		
			
			
			<?php
				
			?>
			<div style="float: left;">
			<h2>Delivery Details:</h2>
			<p>Wrong details? <a href="delivery.php"><b>Edit it!</b></a></p>
			<table>
				<?php
				print sprintf("<tr><td><b>Firstname:</b></td><td>%s</td></tr>", $firstname);
				print sprintf("<tr><td><b>Lastname:</b></td><td>%s</td></tr>", $lastname);
				print sprintf("<tr><td><b>Address 1:</b></td><td>%s</td></tr>", $address1);
				if (!empty($_SESSION['address2'])) {
					print sprintf("<tr><td><b>Address 2:</b></td><td>%s</td></tr>", $address2);
				} 
				print sprintf("<tr><td><b>City:</b></td><td>%s</td></tr>", $townOrCity);
				print sprintf("<tr><td><b>Postcode:</b></td><td>%s</td></tr>", $postcode);
				?>
			</table>
		</div>	
		
			
			
		
		
		
	</body>
	
</html>
<!--billing address same as delivery address?-->