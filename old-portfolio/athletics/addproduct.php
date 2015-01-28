
<?php
require("includes/config.inc.php");



$emptyCount = 0;
$errors = array();
$success = null;
?>
<html>
	<head>
		<title>Add a product</title>
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
		
				
					if (isset($_POST['addItem'])) {
						// check if they are empty
						$pn = $_POST['pn'];
						$ci = $_POST['ci'];
						$descr = $_POST['descr'];
						$im = $_POST['im'];
						$co = $_POST['co'];
						$si = $_POST['si'];
						$pr = $_POST['pr'];
						$st = $_POST['st'];
						$arr = array('pn', 'ci', 'descr', 'im', 'co', 'si', 'pr', 'st');
						// empty check
						foreach($arr as $field) {
							if (empty($_POST[$field])) {
								$emptyCount++;
							  }
						}
						
						// check if the required fields has value
						if ($emptyCount > 0) {
						  $errors[] = "$emptyCount required field/s are empty!";
						} else {
							// mysqli_real_escape to help with sql injection prevention
							$pn = mysqli_real_escape_string($con, $pn);
							$ci = mysqli_real_escape_string($con, $ci);
							$descr = mysqli_real_escape_string($con, $descr);
							$im = mysqli_real_escape_string($con, $im);
							$co = mysqli_real_escape_string($con, $co);
							$si = mysqli_real_escape_string($con, $si);
							$pr = mysqli_real_escape_string($con, $pr);
							$st = mysqli_real_escape_string($con, $st);
							
							// if the product exists, get its proId
							$checkQ = mysqli_query($con, "SELECT * FROM product WHERE productName='$pn'");
							if (mysqli_num_rows($checkQ) > 0) {
								$res = mysqli_fetch_assoc($checkQ) or die ($checkQ);
								$pi = $res['productId'];
							} else {
								// if it does NOT exist, insert it then get its productId
								mysqli_query($con, "INSERT INTO `product` (productName, categoryId, productDescription) VALUES ('$pn', '$ci', '$descr')");
								$pi = mysqli_insert_id($con);
								
							}
								$check2Q = mysqli_query($con, "SELECT * FROM `occurrence` WHERE productId='$pi' AND occSize='$si' AND occColour='$co'") or die($check2Q);
								if (mysqli_num_rows($check2Q) > 0) {
									$res = mysqli_fetch_assoc($check2Q) ;
									$oi = $res['occId'];
									$errors[] = "Product already exists with the <b>Occurrence ID</b> of $oi!";
								} else {
								
								mysqli_query($con, "INSERT INTO `occurrence` (productId, occColour, occSize, occPrice, occStock) VALUES ('$pi', '$co', '$si', '$pr', '$st')");
								
								$oi = mysqli_insert_id($con);
								
								mysqli_query($con, "INSERT INTO `pictures` (picturePath, occId) VALUES ('$im', '$oi')");
								$success = "Successfully added the product!";
							}
							
						}
					}
						
					?>
				<div style="float: left;">
				<table style="border-collapse: collapse;">
					<h3>List of existing products:</h3>
					<tr style="border: 1px solid black;">
						<th>Product Name</th>
						<th>Colour</th>
						<th>Size</th>
					</tr>
				<?php
					$query = mysqli_query($con, "SELECT * FROM product p NATURAL JOIN occurrence o");
					while ($res = mysqli_fetch_array($query)) {
									$pn = $res['productName'];
									$oc = $res['occColour'];
									$osi = $res['occSize'];
								?>
									<tr style="border: 1px solid black;">
										<td><?php print $pn ?></td>
										<td><?php print $oc?></td>
										<td><?php print $osi ?></td>
									</tr>
								<?php
								}
								?>
				</table>
				</div>
				
				<div style="float: left; margin-left: 20px;">
					<?php
						echo "$success";
						
						if (count($errors) > 0) {
									?>
										<h4 style="color: red">Errors</h4>
										<?php
											foreach ($errors as $e) {
											?>		
												<p style="color: red"><?php echo $e; ?></p>
										   <?php		
										   }
									   }
						
						
					?>
					<form method="POST" action="">
						<h3>Add new product:</h3>
						<p><b><i>NOTES:</i></b><br>1. First, check the item if it exists. Use the guide shown. <br>Otherwise, you will get an error after typing all the information.<br>
						2. Category ID GUIDE: ||| 5 = Jerseys ||| 6 = Shorts ||| 7 = Shoes ||| 8 = Accessories |||<br>
						3. Image path must start with "imgs/products/", <br>follows by the name and extension of image in the specified folder.<br></p>
						<table style="border-collapse: collapse;">
							
							<tr>
								<th>Occurrence ID</th><td><input type="text" name="oi" value="Auto" size="4" readonly></td>
							</tr>
							<tr>
								<th>Category ID</th><td><input type="text" name="ci" placeholder="#" size="2"></td>
							</tr>
							<tr>	
								<th>Product Name</th><td><input type="text" name="pn" placeholder="Type product name">*</td>
							</tr>
							<tr>	
								<th>Description</th><td><textarea name="descr" rows="3" cols="18" placeholder="Type description"></textarea>*</td>
							</tr>
							<tr>	
								<th>Image Path</th><td><input type="text" name="im" placeholder="imgs/products/nameOfImg">*</td>
							</tr>
							<tr>	
								<th>Colour</th><td><input type="text" name="co" placeholder="Type the colour">*</td>
							</tr>
							<tr>	
								<th>Size</th><td><input type="text" name="si" placeholder="Enter size">*</td>
							</tr>
							<tr>	
								<th>Price</th><td><input type="text" name="pr" placeholder="Price" size="5">*</td>
							</tr>
							<tr>	
								<th>Stock</th><td><input type="text" name="st" placeholder="#" size="1">*</td>
							</tr>
							<tr>
								<td><input type="submit" name="addItem" value="Add new item!"></td>	
							</tr>	
			
						</table>
						
					</form>
				</div>
		<?php
			}
		?>
	</body>
</html>