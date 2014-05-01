<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
?>
	<div class="left-content">
		<div class="navDiv">
			<a href="../" class="toOther navButton">Back to Shop</a>
		</div>
	</div>
	<div class="right-content cms">
		<h1>Track your Order</h1>
		<p>Enter your order reference number in below and click <strong>Track</strong> in order to see the current status of your order.</p>

		<div class="hideStatus" id="refNumMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup trackGroup">
			<label for="refNum" class="trackLabel"><strong>Order Reference:</strong></label>
			<input type="text" id="refNum" data-pat="Numbers only" pattern="[0-9]+" required>
			<div id="trackBtn" class="formButton trackBtn">Track</div>
		</div>

		<div id="orderStatus" class="orderStatus"></div>
		<table id="orderProducts">
			<thead>
				<tr>
					<td>Item</td>
					<td>Price</td>
					<td>Quantity</td>
				</tr>
				<tbody id="orderProductsBody">
				</tbody>
			</thead>
		</table>
		<div id="goShopping" class="formButton basketControls goShoppingBtn bottomBasketControls"><?php include (IMG_ROOT . "svg/checkout.svg")?>Back to Shop</div>

	</div>
		
<?php include (INCL_ROOT . "footer.php") ?>