<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'adminNav.php');
?>

<div class="right-content">
	<h1>Site Administration</h1>
	<section class="adminOverview" id="adminOverview">
		<h2>Overview</h2>
		<p id="adminOverviewText"></p>
	</section>
</div>

<?php include (INCL_ROOT . 'footer.php');?>