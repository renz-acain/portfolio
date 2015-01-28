<?php

require("includes/config.inc.php");

?>

<html>
	<head>
		<title>Admin page</title>
	</head>
	<body>
		<?php
		
			include("includes/nav.inc.php");
		
			if (!isset($_SESSION['roleId'])) {
				
				$_SESSION['roleId'] = 0;
				
			}
			
			/////////////////////////
			// This page will only be accessible by a logged in member
			////////////////////////
			if ((!isset($_SESSION['log'])) || ($_SESSION['roleId'] != 2)) {
				echo "Only accessible by an admin!";
			} else {
		?>
				
				<h1>Hello Admin!</h1>
				<p>What do you want to do?</p>
				
				<!--////////////////-->
				<!--RECENT ORDERS-->
				<!--////////////////-->
				<h2>Recent purchases</h2>
				<p>Change status of orders:</p>
				<table style="border-collapse: collapse;">
						<tr style="border: 1px solid black;">
							<th>Order Id</th>
							<th>Delivery Id</th>
							<th>Cart Id</th>
							<th>Payment Id</th>
							<th>Total Payment</th>
							<th>Order Date</th>
							<th>Order Status</th>
							<th>Action</th>
						</tr>
				<?php
					if (isset($_POST['changeStatus'])) {
						$os = $_POST['ordStat'];
						$oi = $_POST['orId'];
						echo "Order ID: $oi - Order Status changed to $os";
						mysqli_query($con, "UPDATE `order` SET orderStatus='$os' WHERE orderId='$oi'");
					}
				
				?>
					
				<?php
					$query = mysqli_query($con, "SELECT * FROM `order` o NATURAL JOIN payment p NATURAL JOIN delivery d ORDER BY orderDate DESC");
					while ($res = mysqli_fetch_array($query)) {
						$oi = $res['orderId'];
						$di = $res['deliveryId'];
						$ci = $res['cartId'];
						$pi = $res['paymentId'];
						$tp = $res['totalPayment'];
						$od = $res['orderDate'];
						$os = $res['orderStatus'];
				?>
				<form action="" method="POST">
						<tr style="border: 1px solid black;">
							<td><?php print $oi ?></td>
							<td><?php print $di ?></td>
							<td><?php print $ci ?></td>
							<td><?php print $pi ?></td>
							<td><?php print $tp ?></td>
							<td><?php print $od ?></td>
							<td><select name="ordStat">
								<option <?php if ($os == "To be seen") { echo "selected"; }?> value="To be seen">To be seen</option>
								<option <?php if ($os == "Processing") { echo "selected"; }?> value="Processing">Processing</option>
								<option <?php if ($os == "Sent") { echo "selected"; }?> value="Sent">Sent</option>
							</select></td>
							<input type="hidden" name="orId" value="<?php print $oi ?>">
							<td><input type="submit" name="changeStatus" value="Update!"></td>
						</tr>
				</form>
				<?php
					}
				?>
				</table>
				
				<!--/////////////////-->
				<!--PRODUCT MANAGEMENT-->
				<!--/////////////////-->
				
				<h2>Product management</h2>
				<p>Handling stock (Starting from the least stock)</p>
				<h3>Or ADD a new product! Click <a href="addproduct.php"><b>Add</b></a></h3>
					<table style="border-collapse: collapse;">
						<tr style="border: 1px solid black;">
							<th>Occurrence ID</th>
							<th>Product Name</th>
							<th>Colour</th>
							<th>Size</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>
					
					<?php
				
						if (isset($_POST['changeStock'])) {
							$ost = $_POST['stck'];
							$oi = $_POST['occId'];
							if (is_numeric($ost)) {
								echo "<p style='color: red'>Occurence Id: $oi - Stock changed to $ost</p>";
								mysqli_query($con, "UPDATE `occurrence` SET occStock='$ost' WHERE occId ='$oi'");
							} else {
								echo "<p style='color: red'>Enter a number! Thanks!</p>";
							}
						}
					
						$query = mysqli_query($con, "SELECT * FROM product p NATURAL JOIN occurrence o ORDER BY occStock");
						while ($res = mysqli_fetch_array($query)) {
							$pn = $res['productName'];
							$oi = $res['occId'];
							$oc = $res['occColour'];
							$osi = $res['occSize'];
							$op = $res['occPrice'];
							$ost = $res['occStock'];
						?>
						<form action="" method="POST">
							<tr style="border: 1px solid black;">
								<td><?php print $oi ?></td>
								<td><?php print $pn ?></td>
								<td><?php print $oc?></td>
								<td><?php print $osi ?></td>
								<td><?php print $op ?></td>
								<td><input type='text' size="1" name='stck' value="<?php print $ost ?>"></td>
								<input type='hidden' name='occId' value="<?php print $oi ?>">
								<td><input type="submit" name="changeStock" value="Update!"></td>
							</tr>
						</form>
						<?php
						}
						?>
						
					</table>
					
				<!--///////////////-->
				<!--MEMBERS MANAGEMENT-->
				<!--///////////////-->
				<h2>Members list</h2>
				<table>
					<tr>
						<th>User ID</th>
						<th>Email address</th>
						<th>Firstname</th>
						<th>Lastname</th>
					</tr>
				<?php
					if (isset($_POST['deleteUser'])) {
						$ui = $_POST['ui'];
						echo "$ui";
						mysqli_query($con, "DELETE FROM `user` WHERE userId='$ui'");
						echo "Successfully deleted!";
					}
				
					//$query = mysqli_query($con, "SELECT * FROM user u NATURAL JOIN address a NATURAL JOIN user_role ur NATURAL JOIN role r");
					$query = mysqli_query($con, "SELECT * FROM `user`");
					while ($res = mysqli_fetch_array($query)) {
						$ui = $res['userId'];
						$fn = $res['firstname'];
						$ln = $res['lastname'];
						$ea = $res['emailAdd'];
				?>
				<form method="POST" action="">
						<tr>
							<td><?php print $ui ?></td>
							<td><?php print $ea ?></td>
							<td><?php print $fn ?></td>
							<td><?php print $ln ?></td>
							
							<input type="hidden" name="ui" value="<?php print $ui ?>">
								
							<td><input type="submit" name="deleteUser" value="Delete!"></td>
						</tr>
				</form>		
				<?php
					}
				?>
				</table>
				
				<?php
				
			} // end of user check	
				?>
	</body>
</html>