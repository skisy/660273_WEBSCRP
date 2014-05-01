<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<h1>Content Management</h1>
	<section class="cmsOverview" id="cmsOverview">
		<h2>Overview</h2>
		<p id="cmsOverviewText"></p>
	</section>
</div>
<?php include (INCL_ROOT . 'footer.php');?>