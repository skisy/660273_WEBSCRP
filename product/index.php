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
			<div class="hideStatus" id="quantityMsg"><p class="status error validateMsg">Can't add any more of this item to your basket</p></div>
		<h1 id="productName">Product Information</h1>
		<div class="productData" id="productContainer">
			<div class="productImages" id="additionalImagesDiv"></div>
		</div>
		<div class="productDescDiv" id="productDescriptionContainer"></div>
		<div class="productMeta" id="productMeta"></div>
		<div id="goShopping" class="formButton basketControls goShoppingBtn bottomBasketControls"><?php include (IMG_ROOT . "svg/checkout.svg")?>Back to Shop</div>
	</div>
		
<?php include (INCL_ROOT . "footer.php") ?>