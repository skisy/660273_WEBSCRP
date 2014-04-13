<?php 

	$title = $settings['title'];
	$pathDirs = explode("/", $_SERVER['PHP_SELF']);
	$page = $pathDirs[count($pathDirs)-2];
	$section = isset($pathDirs[count($pathDirs)-3]) == TRUE ? $pathDirs[count($pathDirs)-3] : 'Home';

		if(isset($page))
	{
		switch ($page)
		{
			case "660273":
				$title .= " - Home";
				break;
			case "cms":
				$title .= " - CMS";
				break;
			case "admin":
				$title .= " - Admin";
				break;
			case "addAttribute":
				$title .= " - Add Attribute";
				break;
			case "addCategory":
				$title .= " - Add Category";
				break;
			case "addProduct":
				$title .= " - Add Product";
				break;
			case "manageAttributes":
				$title .= " - Manage Attributes";
				break;
			case "manageCategories":
				$title .= " - Manage Categories";
				break;
			case "manageProducts":
				$title .= " - Manage Products";
				break;
		}
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="WEBSCRP - Shop CMS">
		<meta name="author" content="Phil Hobbs">
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/660273/assets/css/style.php">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link rel="icon" type="image/png" href="/660273/favicon.png" />
		<link rel="apple-touch-icon" href="/660273/favicon.png" />

		<?php if ($page == "660273"): ?>
			<script type="text/javascript" src="/660273/assets/js/scripts.js"></script>
		<?php elseif ($page == "cms" || $section == "cms"): ?>
			<script type="text/javascript" src="/660273/assets/js/cms.js"></script>
			<?php if ($page == "addProduct"): ?>
				<script type="text/javascript" src="/660273/assets/js/imgUpload.js"></script>
			<?php endif; ?>
		<?php endif; ?>

		<script type="text/javascript" src="/660273/assets/js/ajax.js"></script>
		<title><?php echo $title ?></title>
	</head>
	<body>

		<?php if ($page == "660273"): ?>

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


		<?php elseif ($page == "cms" || $section == "cms"): ?>

				<header id="head-wrapper">
					<div class="header-container">
						<div id="shop-name">
							<h1><a href="/660273"><?php echo $settings['title']?></a></h1>
						</div>
					</div>
				</header>
		
				<div id="wrapper">
					<div class="main-content cms" id="main-content">

		<?php endif; ?>
