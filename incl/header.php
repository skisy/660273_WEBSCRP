<?php 
	session_start();
	$settings = parse_ini_file("incl/config.ini");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="WEBSCRP - Shop CMS">
		<meta name="author" content="Phil Hobbs">
		<link rel="stylesheet" type="text/css" href="assets/css/style.php">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<script type="text/javascript" src="assets/js/scripts.js"></script>
		<script type="text/javascript" src="assets/js/ajax.js"></script>
		<title><?php echo $settings['title'] ?></title>
	</head>
	<body>
		<header id="head-wrapper">
			<div class="header-container">
				<div id="shop-name">
					<h1><a href="#"><?php echo $settings['title']?></a></h1>
				</div>
				<nav id="top-search">
					<div class="catDropdown">
						<select id="catSelect">
								<option>All</option>
								<option selected="selected">Current</option>
								<option>Electronics &#38; Computers</option>
						</select>
					</div>
					<span class="currentCat" id="currentCat"></span>
					<input type="text" name="product-search" id="searchInput" value="" placeholder="Search" >
					<!--<button type="submit" class="search-icon">
					</button> -->
					<a href='#' class="searchToggle">Advanced Search &#062;&#062;</a>
				</nav>
				<div class="basket" ondragover=dragOverHandle(); ondraglevae=dragLeaveHandle(); ondragenter=dragEnterHandle();>
					<span class="notDisplayed" id="dragHereBasket">Drag item over basket to add</span>
					<span class="notDisplayed" id="releaseHereBasket">Release mouse to add to basket</span>
					<a class="basketLink" id="basketLink" href="#">
						<?php include ('img/shopping-cart.svg'); ?>
						<div id="quantityContainer">
							<div class="basket-quantity" id="basketQuantity">0</div>
						</div>
					</a>
				</div>
			</div>
		</header>
		<div id="wrapper">
			<div class="main-content" id="main-content">