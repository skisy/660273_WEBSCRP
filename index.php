<?php 
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
?>


	<div class="left-content">
		<div class="goHome" title="Go to Homepage"><a href="index.php?category=0"><?php include (IMG_ROOT . "svg/home.svg")?></a></div>
		<h1>Categories</h1>
		<nav id="catNav">
		</nav>
	</div>

	<div class="right-content">
					<nav id="top-search" class="shopSearch navUp">
							
								<!--<div class="catDropdown">
									<select id="catSelect">
											<option>All</option>
											<option selected="selected">Current</option>
											<option>Electronics &#38; Computers</option>
									</select>
								</div>
								<span class="currentCat" id="currentCat"></span>-->
								<input type="text" name="product-search" id="searchInput" value="" placeholder="Search products..." >
								<!--<button type="submit" class="search-icon">
								</button> -->

						</nav>
		<div id="breadcrumbs"></div>
		<div id="products"></div>
	</div>
		
<?php include (INCL_ROOT . 'footer.php'); ?>