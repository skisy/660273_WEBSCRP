<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>
<div class="right-content">
	<h1>Manage Custom Attributes</h1>
</div>

<?php include (INCL_ROOT . "footer.php"); ?>