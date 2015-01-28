
<?php
	require ("includes/config.inc.php");
	
	$message=null;
	$errors=0;

	
	
?>

		
<?php

$gpi = urldecode(base64_decode($_GET['abcd']));

if (isset($_POST['occId'])) {
	$goi = $_POST['occId'];
} else {
	$goi = urldecode(base64_decode($_GET['efgh']));
}

// if user try to guess the GET parameter and guessed the wrong value, redirect to products.php
$t = mysqli_query($con, "SELECT * FROM occurrence WHERE productId=$gpi AND occId=$goi");
if (mysqli_num_rows($t) < 1) {
	header("Location: products.php");
}


if (isset($_POST['updateColour'])) {
	// get the ID by selecting the products with the selected colour
	$quer = "SELECT occId FROM occurrence WHERE productId=$gpi AND occColour='".$_POST['colour']."'";
					$occIdQuery = mysqli_query($con, $quer);
					if (mysqli_num_rows($occIdQuery) < 1) {
						$goi = $_POST['occId'];
					} else {
					$res = mysqli_fetch_assoc($occIdQuery);
					$goi = $res['occId'];
					}
}

if (isset($_POST['updateSize'])) {
	// this will then allow users to change the size of the product if they want
	// combining the updateSize and updateColour will define the occId that needs to be submitted to the cart
	$quer = "SELECT occId FROM occurrence WHERE productId=$gpi AND occSize='".$_POST['size']."'";
					$occIdQuery = mysqli_query($con, $quer);
					if (mysqli_num_rows($occIdQuery) < 1) {
						$goi = $_POST['occId'];
					} else {
					$res = mysqli_fetch_assoc($occIdQuery);
					$goi = $res['occId'];
					}
}


			$errors = 0;
			if (isset($_POST['additem'])) {
				// if the stock is 0, show an error that no stock is available
				//$occSt = $_POST['ocSt'];
				//if ($occSt > 1) {
				//	$errors++;
				//}
				//$t = mysqli_query($con, "");
				
				//STEP 1: Get the price
				$cartItemDetailsQuery = mysqli_query($con, "SELECT p.productName, o.occPrice, o.occStock FROM product p NATURAL JOIN occurrence o WHERE occId=$goi");
				$ciDetails = mysqli_fetch_assoc($cartItemDetailsQuery);
				$productName = $ciDetails['productName'];
				$occPrice = $ciDetails['occPrice'];
				$occSt = $ciDetails['occStock'];
				
				// STEP 2: Get or Create CartId only if the stock is not 0
				if ($occSt > 0) {
					// get cartId where the $_SESSION['userId'] is ACTIVE
					$cartQuery = sprintf("SELECT cartId FROM cart WHERE userId='%s' AND cartStatus='active'", $userId);
					$result = mysqli_query($con, $cartQuery);
					// if no active cartId for the userId
					if (mysqli_num_rows($result) < 1) {
					  // STEP 3: Need to create a new cart and get its cartId BUT check if there is a saved cart
					
					
					  // create a new cart with the userId
							$ins = sprintf("INSERT INTO cart (userId, cartStatus) VALUES ('%s', 'active')", $userId);
							mysqli_query($con, $ins);
							$cartId = mysqli_insert_id($con);
						
					} else {
					  $row = mysqli_fetch_assoc($result);
					  $cartId = $row['cartId'];
					}
					
					// STEP 4: Cart ID has been obtained
					// STEP 5: Add a line item to cart for new purchase
					//
					// A better structure would be to see whether occurrenceId is already in this cart. Update qty if it is, insert if not
					// check if there is an existing occId in a cartId
					$check = mysqli_query($con, "SELECT o.occStock, i.cartItemId, i.cartItemQty FROM cartitem i INNER JOIN occurrence o ON (i.occId = o.occId) WHERE i.occId=$goi AND i.cartId=$cartId");
					$res = mysqli_fetch_assoc($check);
					$ost = $res['occStock'];
					$cqty = $res['cartItemQty'];
					if (mysqli_num_rows($check) == 0) {
					  
					  // create a new line of cart item with the need fields if there is not
					  $ins = sprintf("INSERT INTO cartitem (cartId, occId, cartItemQty, cartItemPrice) VALUES (%s, %s, 1, %s)", $cartId, $goi, $occPrice);
					  mysqli_query($con, $ins);
					 
					  $message = "$productName is added in cart $goi";
					} elseif ($ost > $cqty) {
					  // if the stock is more than the quantity, add quantity (till its not equal)
					  $addQuantity = mysqli_query($con, "UPDATE cartitem SET cartItemQty = cartItemQty + 1 WHERE occId = $goi");
					
					  $message = "Added 1 quantity to $productName in cart $goi";
					  } elseif ($ost == $cqty) {
						$message = "You have $cqty in cart already. Stock is only $ost. Go to Cart if you want to delete item";
					  }
					
				} else {
					$message = "Sorry $occSt stock available! Please wait for the admin to re-stock this item";
				}
			}


		
		
		$fromQuery = mysqli_query($con, "SELECT o.occStock, o.occSize, o.occColour, p.picturePath FROM occurrence o NATURAL JOIN pictures p WHERE o.occId='$goi'");
		$re = mysqli_fetch_assoc($fromQuery);
			$colour = $re['occColour'];
			$size = $re['occSize'];
			$occPic = $re['picturePath'];
			$occSt = $re['occStock'];
		
		//$gsi = $_GET['occSize'];
		//$gc = $_GET['occColour'];
		//$goc = str_replace('%20', ' ', $gc);
		
		//p.productName, p.productDescription,
//$sizeQuery = mysql_query("SELECT (SELECT group_concat(DISTINCT occSize) FROM occurrence WHERE productId=".$gpi.") as occSize, 
//(SELECT group_concat(DISTINCT occColour) FROM occurrence WHERE productId=".$gpi.") as occColour,
//(SELECT group_concat(DISTINCT occId) FROM occurrence WHERE productId=".$gpi.") as occId");
		
		//colour should be in product table?? just like adidas do it
		// add and occColour in select
		// if first select is empty, disable 2nd.. if not empty, check value then update 2nd select
		
		//get only the size
		
		
		?>
			
<html>
	<head>
		
	</head>
	
	
	<body>
		<!--nav must be positioned after all the $_POST to ensure it gets updated properly-->
		<?php include("includes/nav.inc.php"); ?>
			
		<form method="POST" action="">
			<?php
				$productQuery = mysqli_query($con, "SELECT p.productName, p.productDescription, o.occPrice FROM `product` p NATURAL JOIN `occurrence` o JOIN `pictures` pi ON (o.occId = pi.occId) WHERE o.productId='$gpi'");
				$proRes = mysqli_fetch_assoc($productQuery);
					$proName = $proRes['productName'];
					$proDes = $proRes['productDescription'];
					$occPri = $proRes['occPrice'];
				
				print "<div style='float: left;'><img src='$occPic'></div>";
				print "<div style='float: left;'><h2>$proName</h2> <b>&pound;$occPri</b><br><b>Stock: $occSt</b><p>$proDes</p></div>";
				
			?>
			<br style="clear: both;">
				
			<b>Colour:</b>
			<?php
				if(isset($_POST['colour'])){
						$colour = $_POST['colour'];
						}
						
				$colourQuery = mysqli_query($con, "SELECT DISTINCT occColour FROM occurrence WHERE productId=$gpi");
				
					?>
					
			<select name="colour" onchange="this.form.submit()">
				<?php
				while ($data = mysqli_fetch_array($colourQuery)) {
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
			(Other colour/s might be available)
			<input type="hidden" name="updateColour">
		</form>	
			
			
		<form method="POST" action="">
			<br><b>Size:</b>
			<select name="size" onchange="this.form.submit()">
				<?php
				// when colour is  changed, the submitted size is the current size	
				if(isset($_POST['size'])){
						$size = $_POST['size'];
						}
			
				if ($colour != null) {
					
				$updateSize = mysqli_query($con, "SELECT occSize FROM occurrence WHERE productId = $gpi AND occColour = '$colour'");
					while ($dat = mysqli_fetch_array($updateSize)) {
						$osi = $dat['occSize'];
					?>
						<option value="<?php print $osi ?>" <?php if($size == $osi){ echo "selected"; } ?>>
							<?php print $osi ?>
						</option>
					<?php
					}
				} 
				?>
				
			</select>
			(Changes depending on the selected colour)
			<input type="hidden" name="occId" value="<?php $goi ?>">
			<input type="hidden" name="updateSize">
		</form>	
			
			
		
		<form method="POST" action="">
			<input type="hidden" name="occId" value="<?php print $goi ?>">
			<input type="hidden" name="message" value='<?php print $message ?>'>
			<input type="hidden" name="cartNum" value="<?php print $cartNum ?>">
			<input type="hidden" name="ocSt" value="<?php print $occSt ?>">
			<input type="submit" name="additem" value="Add to Cart">
		</form>
		
		<p style="color: red"><?php echo $message; ?></p>
		<form action="addtocart.php" method="POST">
			<!--to set the colour and size of the item?-->
			<input type="hidden" name="occId" value="<?php print $goi ?>">
			<input type="submit" name="Go to cart" value="Go to Cart">
		</form>
		
		
		
		
		<?php
		
		////////////////////////////////////////
		// isset post feedback
		///////////////////////////////////////
		if (isset($_POST['postFB'])) {
			if (!isset($_SESSION['log'])) {
				$errors = "<p style='color: red'>You need to be logged in to post feedback!</p>";
			} else {
				if (!empty($_POST['feedback'])) {
					$fb = $_POST['feedback'];
					$ui = $_POST['userId'];
					$pi = $_POST['proId'];
					$rate = $_POST['rate'];
					
					// helps prevent SQL injection
					$fb = mysqli_real_escape_string($con, $fb);
					
					mysqli_query($con, "INSERT INTO `feedback` (feedback, userId, productId, rate) VALUES ('$fb', '$ui', '$pi', $rate)");
				} else {
					$errors = "<p style='color: red'>You did not type anything in Feedback!</p>";
				}
			}
		}
		?>
		<hr>
		<h3>Recently viewed</h3>
		<?php
		
			if (!array_key_exists('recentViews', $_SESSION)) {
			
				$_SESSION['recentViews'] = array();
				array_push($_SESSION['recentViews'], $goi);
			} else {
				
				// check if the occId is already in the session, if not..
				// count the number of session.. if 5 or more,
				// remove the older array..
				
				//http://stackoverflow.com/questions/15265723/limit-array-to-5-items
				if (!in_array($goi, $_SESSION['recentViews'])){
					$count = count($_SESSION['recentViews']);
					if($count>=5) {
						array_shift($_SESSION['recentViews']);
						
					}
					array_push($_SESSION['recentViews'], $goi);
				
				}
			}
			// added to place the div inside to the left side
			echo "<div style='float: left'>";
			foreach ($_SESSION['recentViews'] as $key => $occId){
				
				$quer = mysqli_query($con, "SELECT p.productName, p.productId, o.occColour FROM product p NATURAL JOIN occurrence o WHERE occId='$occId'");
				$res = mysqli_fetch_assoc($quer);
				$pn = $res['productName'];
				$oc = $res['occColour'];
				$pi = $res['productId'];
				
				// float right to arrange from latest (left) to oldest (right)
				echo "<div style='float: right; margin-left: 10px'><a href='product.php?productId=$pi&occId=$occId'><b>$pn</b> <br><i>$oc</i></a></div>";
			}
			echo "</div>";
		?>
		<br>
		<br>
		<hr style="clear: both">
		<h3>Reviews</h3>
		<?php
			$q = "SELECT AVG(rate) as avrg FROM feedback WHERE productId='$gpi'";
			$query = mysqli_query($con, $q);
			$res = mysqli_fetch_assoc($query);
			$avg = $res['avrg'];
			echo "<b>Average ratings:</b>";
			printf(" %.2f<br>", $avg);
		?>
		<?php if ($errors != '0') { print "$errors"; } ?>
		<br>
		Recently bought this? Why not leave a feedback about this item?<br>
		<form method="POST" action="">
			
			<h4>Post a feedback:</h4>
			Rate:<select name="rate">
				<option selected="true" value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>(Select 1 - 5)<br>
			<textarea name="feedback" rows="3" cols="40" placeholder="Leave a feedback!"></textarea><br>
			
			
			
			<input type="hidden" name="userId" value="<?php print $userId; ?>">
			<input type="hidden" name="proId" value="<?php print $gpi; ?>">
			
			<input type="submit" name="postFB" value="Post!">
		</form>
		<!--feedbackId, userId, feedback, rate?, productId (NOT occId), postTime-->
		<hr>
			
			<?php
			$fbQ = mysqli_query($con, "SELECT * FROM feedback WHERE productId='$gpi'");
			
			
			if (mysqli_num_rows($fbQ) > 0) {
				while ($res = mysqli_fetch_assoc($fbQ)) {
					$userId = $res['userId'];
					$uiQ = mysqli_query($con, "SELECT * FROM user WHERE userId = '$userId'");
					$result = mysqli_fetch_assoc($uiQ);
					$fnme = $result['firstname'];
					$lnme = $result['lastname'];
					
					$feedback = $res['feedback'];
					$rate = $res['rate'];
					$pt = $res['postTime'];
					
					echo "<p>$fnme $lnme - Posted: $pt - Rate: $rate  <br>$feedback</p>";
				}
			} else {
				echo "<p>Be the first to comment!</p>";
			}
			?>
		<hr>	
		
	</body>
</html>
