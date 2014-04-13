<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (INCL_ROOT . 'header.php');
?>


	<div class="left-content">
		<nav id="catNav">
		</nav>			
	</div>

	<div class="right-content">
		<div id="breadcrumbs"></div>
		<div id="products"></div>
	</div>
		
<?php include ('incl/footer.php'); ?>