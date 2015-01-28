<?php
require ("includes/config.inc.php");
?>
<html>
	<head>
		<title>Products</title>
	</head>
	
	
	<body>
		<?php
		include("includes/nav.inc.php");
		
		echo "<div style='float: left;'>";
				echo "<b>Categories</b><br>";
			$catQuery = mysqli_query($con, "SELECT * FROM category") or die(mysql_error()); 
				while($data = mysqli_fetch_array( $catQuery )) {
					$ci = $data['categoryId'];
					$cd = $data['categoryDescription'];
					$cp = $data['categoryPicture'];
			?>
			<!--display the categories-->
			<a href="products.php?qwert=<?php print urlencode(base64_encode($ci)); ?>"><?php print "$cd"; ?></a><br>

			<?php
			}
			?>
			<a href='products.php'>See all</a>
			</div>
			<div style="float:left; margin-left: 20px;">
			<?php
			if (isset($_GET['qwert'])) {
				
				$ci = urldecode(base64_decode($_GET['qwert']));
				// if user try to guess the GET parameter and guessed the wrong value, redirect to products.php
				$t = mysqli_query($con, "SELECT * FROM category WHERE categoryId = $ci");
				if (mysqli_num_rows($t) < 1) {
					header("Location: products.php");
				}
		
			$catQuery = mysqli_query($con, "SELECT * FROM category WHERE categoryId = $ci") or die(mysql_error()); 
				while($data = mysqli_fetch_array( $catQuery )) {
					$cd = $data['categoryDescription'];
					$cp = $data['categoryPicture'];
			
			
			print "<img src='$cp'>";
			?>

			<?php
			// doing the process this way prevents the items on being duplicated in the list
					$proQuery = mysqli_query($con, "SELECT productName, productId FROM product WHERE categoryId=$ci");
					while ($result = mysqli_fetch_array($proQuery)) {
						$pi = $result['productId'];
						$pn = $result['productName'];
						
						$occQuery = mysqli_query($con, "SELECT occColour, occPrice, occSize, occId FROM occurrence WHERE productId=$pi");
						$occResult = mysqli_fetch_array($occQuery);
						$oc = $occResult['occColour'];
						$oId = $occResult['occId'];
						$osi = $occResult['occSize'];
						$op = $occResult['occPrice'];
			?>
			
			<!--display the items with price under the categories-->
			
					<a href="product.php?abcd=<?php print urlencode(base64_encode($pi)); ?>&efgh=<?php print urlencode(base64_encode($oId)) ?>"><p><?php print "$pn &pound;$op" ?></p></a>
				<?php
					}
				}
			} else {
				
			?>
			
			
				<b>Products</b>
			<?php
			// doing the process this way prevents the items on being duplicated in the list
					$proQuery = mysqli_query($con, "SELECT productName, productId FROM product") or die(mysql_error());
					while ($result = mysqli_fetch_array($proQuery)) {
						$pi = $result['productId'];
						$pn = $result['productName'];
						
						$occQuery = mysqli_query($con, "SELECT occColour, occPrice, occSize, occId FROM occurrence WHERE productId=$pi");
						$occResult = mysqli_fetch_array($occQuery);
						$oc = $occResult['occColour'];
						$oId = $occResult['occId'];
						$osi = $occResult['occSize'];
						$op = $occResult['occPrice'];
			?>
			
			<!--display the items with price under the categories-->
			
					<a href="product.php?abcd=<?php print urlencode(base64_encode($pi)) ?>&efgh=<?php print urlencode(base64_encode($oId)) ?>"><p><?php print "$pn &pound;$op" ?></p></a>
					
			<?php
					}

				
					
				?>
				
			</div>	
				<?php
			}
				?>
			
		<br>				
	</body>
</html>