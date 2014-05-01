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
		<h1>Compare Items</h1>
		<div class="compareItemsContent" id="compareItemsContent"></div>
		<div id="goShopping" class="formButton basketControls goShoppingBtn bottomBasketControls"><?php include (IMG_ROOT . "svg/checkout.svg")?>Back to Shop</div>
	</div>
		
<?php include (INCL_ROOT . "footer.php") ?>