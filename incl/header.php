<?php 
	$title = $settings['title'];
	$pathDirs = explode("/", $_SERVER['PHP_SELF']);
	$page = strtolower($pathDirs[count($pathDirs)-2]);
	$section = isset($pathDirs[count($pathDirs)-3]) == TRUE ? strtolower($pathDirs[count($pathDirs)-3]) : 'Home';
	$shop = false;
	$cms = false;
	$admin = false;

	if(isset($page))
	{
		switch ($page)
		{
			case "660273":
				$shop = true;
				$title .= " - Home";
				break;
			case "cms":
				$cms = true;
				$title .= " - CMS";
				break;
			case "admin":
				$title .= " - Admin";
				$admin = true;
				break;
			case "addattribute":
				$cms = true;
				$title .= " - Add Attribute";
				break;
			case "addcategory":
				$cms = true;
				$title .= " - Add Category";
				break;
			case "addproduct":
				$cms = true;
				$title .= " - Add Product";
				break;
			case "manageattributes":
				$cms = true;
				$title .= " - Manage Attributes";
				break;
			case "managecategories":
				$cms = true;
				$title .= " - Manage Categories";
				break;
			case "manageproducts":
				$cms = true;
				$title .= " - Manage Products";
				break;
			case "product":
				$title .= " - ";
				break;
			case "basket":
				$title .= " - My Basket";
				break;
			case "checkout":
				$title .= " - Checkout";
				break;
			case "track":
				$title .= " - Track Order";
				break;
			case "compare":
				$title .= " - Compare Items";
				break;
			case "ordermanagement":
				$title .= " - Order Management";
				$admin = true;
				break;
			case "sitesettings":
				$title .= " - Site Settings";
				$admin = true;
				break;
			case "setup":
				$title .= " - Setup";
				$admin = true;
				break;
			case "orderproducts":
				$title .= " - Setup";
				$admin = true;
				break;
			default:
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
		<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>-->
		<!--<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->
		<!-- Font Awesome source downloaded and linked to locally. Retrieved from http://fortawesome.github.io/Font-Awesome/ -->
		<link rel="stylesheet" href="/660273/assets/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="/660273/assets/css/style.php">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
		<link rel="icon" type="image/png" href="/660273/favicon.png" />
		<link rel="apple-touch-icon" href="/660273/favicon.png" />
		<script type="text/javascript" src="/660273/assets/js/checkLocalStorage.js"></script>
		<script type="text/javascript" src="/660273/img/svg/images.js"></script>
		<script type="text/javascript" src="/660273/assets/js/ajax.js"></script>
		<script type="text/javascript" src="/660273/assets/js/validate.js"></script>
		<script type="text/javascript" src="/660273/assets/js/topNav.js"></script>
		<script type="text/javascript" src="/660273/assets/js/order.js"></script>

		<?php if ($shop) { ?>
			<script type="text/javascript" src="/660273/assets/js/home.js"></script>
		<?php }

		if ($page == "cms" or $section == "cms") { ?>
			<script type="text/javascript" src="/660273/assets/js/cms.js"></script>
		<?php }

		if ($page == "addproduct") { ?>
			<script type="text/javascript" src="/660273/assets/js/imgUpload.js"></script>
		<?php }

		if ($page == "basket") { ?>
			<script type="text/javascript" src="/660273/assets/js/basket.js"></script>
		<?php } 

		if ($page == "checkout") { ?>
			<script type="text/javascript" src="/660273/assets/js/checkout.js"></script>
		<?php }

		if ($page == "track") { ?>
			<script type="text/javascript" src="/660273/assets/js/track.js"></script>
		<?php } 

		if ($page == "compare") { ?>
			<script type="text/javascript" src="/660273/assets/js/compare.js"></script>
		<?php } 

		if ($page == "product") { ?>
			<script type="text/javascript" src="/660273/assets/js/product.js"></script>
		<?php }

		if ($admin) { ?>
			<script type="text/javascript" src="/660273/assets/js/admin.js"></script>
		<?php } ?>

		<title><?php echo $title ?></title>
		</head>
		<body>
			<div class="inactive" id="overlayCat">
				<?php if (!$cms) { ?>
					<div id="browseCats" class="browseCats">
						<a href="" id="closeCatOverlay" class="closeOverlay">Close</a>
						<h1>Browse Categories</h1>
						<ul class="catTree" id="catTree">
							<li id="rootCat">
								<i class="icon fa fa-plus" id="catNode0"></i>
								<a class="selectedCat" id="parentCat0">All</a>
								<ul id="subCatList0">
								</ul>
							</li>
						</ul>
					</div>
				<?php } ?>
			</div>
			<header id="head-wrapper">
				<div class="header-container">
					<div id="shop-name">
						<h1><a title="Go home" href="/660273"><?php echo $settings['title']?></a></h1>
					</div>

			

						<?php if (!$cms && !$admin): ?>
						<nav class="topNav" id="topNav">
							<span class="textNav">Navigation:</span>
							<div title="Navigation Menu" id="menuButton" class="menuButton topButton"><?php include (IMG_ROOT . 'svg/menu.svg') ?>
								<div class="hoverMenu menuNav" id="menuNav">
									<div class="hoverMenuTitle">
										<strong>Navigation</strong>
										<a class="rightClose" id="closeNav">Close</a>
									</div>
									<div class="hoverMenuContent">
										<div id="navHomeLink" class="formButton hoverMenuBtn menuNavBtn">Home</div>
										<div id="browseCatLink" class="formButton hoverMenuBtn menuNavBtn">Browse Categories</div>
										<div id="compareItemsLink" class="formButton hoverMenuBtn menuNavBtn">Compare Products</div>
										<div id="trackOrderLink" class="formButton hoverMenuBtn menuNavBtn">Track Your Order</div>
									</div>
								</div>
						</div>
							<div title="View basket" id="basketButton" class="basketButton topButton">
								<div id="quickBasket" class="quickBasket hoverMenu">
									<div class="hoverMenuTitle">
										<strong>Basket Summary</strong>
										<a class="rightClose" id="closeBasket" href=''>Close</a>
									</div>
									<div class="hoverMenuContent" id="quickBasketContent"></div>
									<div class="quickTotal" id="quickTotal"></div>
									<div id="quickToBasket" class="formButton hoverMenuBtn">View Full Basket</div>
								</div>
								<span class="notDisplayed" id="dragHereBasket">Drag item over basket to add</span>
								<span class="notDisplayed" id="releaseHereBasket">Release mouse to add to basket</span>
								
									<?php include (IMG_ROOT . 'svg/cart.svg'); ?>
									<div id="quantityContainer">
										<div class="basket-quantity" id="basketQuantity">0</div>
									</div>
								
							</div>
						</nav>
					</div>
				</header>
				<div id="wrapper">
					<div class="main-content" id="main-content">

			<?php elseif ($cms): ?>
					<nav class="topNav" id="topNav">
						<span class="textNav">Navigation:</span>
						<div title="Navigation Menu" id="menuButton" class="menuButton topButton openBasket"><?php include (IMG_ROOT . 'svg/menu.svg') ?>
							<div class="hoverMenu menuNav" id="menuNav">
								<div class="hoverMenuTitle">
									<strong>Navigation</strong>
									<a class="rightClose" id="closeNav">Close</a>
								</div>
								<div class="hoverMenuContent">
									<div id="shopHomeLink" class="formButton hoverMenuBtn menuNavBtn">Shop Home</div>
									<div id="cmsHomeLink" class="formButton hoverMenuBtn menuNavBtn">CMS Home</div>
									<div id="addCategoryLink" class="formButton hoverMenuBtn menuNavBtn">Add Category</div>
									<div id="addProductLink" class="formButton hoverMenuBtn menuNavBtn">Add Product</div>
									<div id="addAttributeLink" class="formButton hoverMenuBtn menuNavBtn">Add Attribute</div>
									<div id="manageCategoriesLink" class="formButton hoverMenuBtn menuNavBtn">Manage Categories</div>
									<div id="manageProductsLink" class="formButton hoverMenuBtn menuNavBtn">Manage Products</div>
									<div id="manageAttributesLink" class="formButton hoverMenuBtn menuNavBtn">Manage Attributes</div>
								</div>
							</div>
						</nav>
					</div>
				</header>
				<div id="wrapper">
					<div class="main-content cms" id="main-content">
			<?php elseif ($admin): ?>
				<nav class="topNav" id="topNav">
					<span class="textNav">Navigation:</span>
						<div title="Navigation Menu" id="menuButton" class="menuButton topButton openBasket"><?php include (IMG_ROOT . 'svg/menu.svg') ?>
							<div class="hoverMenu menuNav" id="menuNav">
								<div class="hoverMenuTitle">
									<strong>Navigation</strong>
									<a class="rightClose" id="closeNav">Close</a>
								</div>
								<div class="hoverMenuContent">
									<div id="shopHomeLink" class="formButton hoverMenuBtn menuNavBtn">Shop Home</div>
									<div id="adminHomeLink" class="formButton hoverMenuBtn menuNavBtn">Admin Home</div>
									<div id="cmsHomeLink" class="formButton hoverMenuBtn menuNavBtn">CMS Home</div>
									<div id="orderManagementLink" class="formButton hoverMenuBtn menuNavBtn">Order Management</div>
									<div id="siteSettingsLink" class="formButton hoverMenuBtn menuNavBtn">Site Settings</div>
									<div id="initialSetupLink" class="formButton hoverMenuBtn menuNavBtn">Initial Setup</div>
								</div>
							</div>
						</nav>
					</div>
				</header>
				<div id="wrapper">
					<div class="main-content cms" id="main-content">
			<?php endif; ?>
