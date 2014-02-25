<?php
	if(file_exists('incl/config.ini')):
		$settings = parse_ini_file('incl/config.ini');
		include ('db/test_db_conn.php');
		include ('incl/header.php');
?>
	<div class="left-content">
			<nav id="catNav">
				&nbsp;
			</nav>			
	</div>
	<div class="right-content">
		<div id="products">
		</div>
	</div>
</div>
	
		
<?php
	include ('incl/footer.php');
	else:
		echo "Config file is missing";
	endif;
?>