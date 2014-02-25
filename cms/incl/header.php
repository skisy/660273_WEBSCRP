<?php 
	session_start();
	$settings = parse_ini_file("incl/config.ini");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $settings['title']?></title>
		<meta name="description" content="WEBSCRP - Shop CMS">
		<meta name="author" content="Phil Hobbs">
		<link rel="stylesheet" type="text/css" href="assets/css/style.php">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<script type="text/javascript" src="assets/js/scripts.js"></script>
		<script type="text/javascript" src="assets/js/ajax.js"></script>
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
					<input type="text" name="product-search" id="searchInput" value="" placeholder="Search" required>
					<!--<button type="submit" class="search-icon">
					</button> -->
					<a href='#' class="searchToggle">Advanced Search &#062;&#062;</a>
				</nav>
				<div class="basket">
					<a href="#">
						<?php include ('img/shopping-cart.svg'); ?>
						<span class="basket-quantity">0</span> <!-- Add php/js(?) to display current quantity of items in basket-->
					</a>
				</div>
			</div>
		</header>
		
		<div id="wrapper">
			<div class="main-content" id="main-content">