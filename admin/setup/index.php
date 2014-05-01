<?php 	
	require_once ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'adminNav.php');
?>

<div class="right-content">
	<h1>Initial Setup</h1>
	<p class="important">Please be aware that running this setup will discard any previously saved settings and will wipe the database specified. It is recommended that you backup everything first!</p>

	<p>Click below to continue.</p>

	<button type="button" onclick="window.location.href = '/660273/install.php';">Continue</button>
	</div>
<?php
	include INCL_ROOT . 'footer.php';

?>