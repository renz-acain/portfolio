<html>
<?php


require("includes/config.inc.php");
if (!isset($_SESSION['deCheck'])) {
	header("Location: addtocart.php");
	exit;
} else {
	unset($_SESSION['deCheck']);
}

if (isset($_GET['abcd'])) {
unset($_SESSION['pCheck']);


$getOrderId = urldecode(base64_decode($_GET['abcd']));

?>
	<head>
		<title>Thank you!</title>
	</head>
	<body>
		<?php include("includes/nav.inc.php") ?>
		<h1>Thank you!</h1>
		<p>Thank you for choosing Isherwoods Athlethics! The item will be with you within 7 days :)</p>
		<?php
		
			$query = "SELECT * FROM `order` WHERE orderId = $getOrderId";
			$getIds = mysqli_query($con, $query) or die($query);
			$res = mysqli_fetch_assoc($getIds);
			$delId = $res['deliveryId'];
			$payId = $res['paymentId'];
			$orderDate = $res['orderDate'];
			$cartId = $res['cartId'];
			$orderStat = $res['orderStatus'];
			//echo $getOrderId; testing purpose
		?>
		
		<h2>Order details</h2>
		<p>The details of your purchase is as shown below:</p>
		<table>
			<tr>
				<th>
					Product
				</th>
				<th>Colour</th>
				<th>
					Size
				</th>
				<th>
					Qty
				</th>
				<th>
					Price
				</th>
			</tr>
		<?php
		$query = "SELECT * FROM cartitem WHERE cartId = $cartId";
		$getItems = mysqli_query($con, $query);
		while ($res = mysqli_fetch_assoc($getItems)) {
			$occId = $res['occId'];
			$qty = $res['cartItemQty'];
			$ciPrice = $res['cartItemPrice'];
			
			$getProQ = "SELECT p.productName, o.occColour, o.occSize FROM occurrence o NATURAL JOIN product p WHERE o.occId = $occId";
			$getProDetails = mysqli_query($con, $getProQ);
			while ($res = mysqli_fetch_assoc($getProDetails)) {
				$occC = $res['occColour'];
				$proName = $res['productName'];
				$occS = $res['occSize'];
				echo "<tr><td>$proName</td><td>$occC</td><td>$occS</td><td>$qty</td><td>$ciPrice</td></tr>";
			}
		}
		if ($cartId != 0) {
			$query = mysqli_query($con, "SELECT SUM(cartItemPrice) AS total FROM cartitem WHERE cartId='$cartId'");
			$row = mysqli_fetch_assoc($query);
			$total = $row['total'];
		} else {
			$total = 0;
		}
		$deliQuery = mysqli_query($con, "SELECT deliveryMethod, deliveryCost, addressId FROM `delivery` WHERE deliveryId='$delId'");
		$res = mysqli_fetch_assoc($deliQuery);
		$delCost = $res['deliveryCost'];
		$delMet = $res['deliveryMethod'];
		$addressId = $res['addressId'];
		?>
		<tr>
		<th colspan="4" align="right">Delivery Cost:</th>
		
		<?php
			$delMet = ucfirst($delMet);
			printf("<td align='right'>%.2f</td>", $delCost);
			echo "<td>($delMet)</td>";
			$incDel = $total + $delCost;
		?>
		
		</tr>
		
		  <tr>
			<th colspan="4" align="right">Total:</th>
			
			<td align="right"><?php print $incDel ?></td>
			<td><?php $vat = .2; $vatIs = round(($incDel * $vat), 2); $roundedVat = printf("(inc. VAT of 20&#37;, %.2f)", $vatIs); ?></td>
		  </tr>
		
		</table>
		<h3>Delivery details:</h3>
		<?php
			$addQuery = mysqli_query($con, "SELECT * FROM `address` NATURAL JOIN `user` WHERE addressId='$addressId'");
			$res = mysqli_fetch_assoc($addQuery);
			$address1 = $res['address1'];
			$address2 = $res['address2'];
			$city = $res['city'];
			$pc = $res['postcode'];
			$fn = $res['firstname'];
			$ln = $res['lastname'];
			echo "<p>Firstname: $fn<br> Lastname: $ln<br> Address1: $address1<br> Address2: $address2<br> City: $city<br> Postcode: $pc</p>";
		?>
		
		<h3>Payment details:</h3>
		<?php
			$paQuery = mysqli_query($con, "SELECT * FROM payment NATURAL JOIN address WHERE paymentId='$payId'");
			$res = mysqli_fetch_assoc($paQuery);
			$nc = $res['nameOnCard'];
			$cd = $res['creditCard'];
			$baddressId = $res['addressId'];
			$baddress1 = $res['address1'];
			$baddress2 = $res['address2'];
			$bcity = $res['city'];
			$bpc = $res['postcode'];
			// hide first 8 of credit number
			$cd = preg_replace("/^\d{8}/", "********-", $cd);
			echo "Name on card: $nc<br> Credit number: $cd";
			echo "<h4>Billing Address:</h4>";
			if ($addressId == $baddressId) {
						print "<p>Same as delivery address.</p>";
					} else {
						?>
						<table>
							<?php
								
								print sprintf("<tr><td><b>Address 1:</b></td><td>%s</td></tr>", $baddress1);
								if (!empty($baddress2)) {
									print sprintf("<tr><td><b>Address 2:</b></td><td>%s</td></tr>", $baddress2);
								}
								print sprintf("<tr><td><b>City:</b></td><td>%s</td></tr>", $bcity);
								print sprintf("<tr><td><b>Postcode:</b></td><td>%s</td></tr>", $bpc);
							?>
						</table>
					<?php
					}
			
		?>
		<p>You have purchased the following:</p>
	</body>
	<?php
} else {
	include("includes/error.php");

}
	?>
</html>
<!--create a new cart when the current cart is changed to ordered-->
<!--do not forget to close the sessions -->
 <!--if user's address is already in database, get addressId then use it
	if not, insert a new address -->
<!--handling address needs to be improved-->