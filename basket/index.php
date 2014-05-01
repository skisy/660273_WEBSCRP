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

	<div class="right-content">
		<div class="formButton basketControls" id="toCheckout1">Go to checkout<?php include (IMG_ROOT . "svg/checkout.svg")?></div>
		<h1>My Basket</h1>
		<div id="noStockContainer"></div>
		<div id="basketMsgPrice" class="hideStatus"><p class="status notification basketMsg"></p></div>
		<div id="basketMsg" class="hideStatus"><p class="status notification basketMsg"></p></div>
		<div class="basketHead">
			<div class="nameHead">
				Items
			</div>
			<div class="priceHead">
				Price
			</div>
			<div class="quantityHead">
				Quantity
			</div>
		</div>
		<form id="basketContent" class="basketContent">
		</form>
		<a id="emptyBasket" class="emptyBasket">Empty Basket</a>
		<div class="basketTotal">Sub-total: <span id="basketTotal">£0.00</span></div>
		<div class="formButton basketControls bottomBasketControls" id="toCheckout2">Go to checkout<?php include (IMG_ROOT . "svg/checkout.svg")?></div>
		<div id="goShopping1" class="formButton basketControls goShoppingBtn bottomBasketControls"><?php include (IMG_ROOT . "svg/checkout.svg")?>Back to Shop</div>
	</div>
		
<?php include (INCL_ROOT . "footer.php") ?>
