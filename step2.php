<?php $settings = parse_ini_file('incl' . DIRECTORY_SEPARATOR . 'config.php'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="WEBSCRP - Shop CMS">
		<meta name="author" content="Phil Hobbs">
		<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>-->
		<!--<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->
		<link rel="stylesheet" href="/660273/assets/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="/660273/assets/css/style.php">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
		<link rel="icon" type="image/png" href="/660273/favicon.png" />
		<link rel="apple-touch-icon" href="/660273/favicon.png" />
		<script type="text/javascript" src="/660273/assets/js/checkLocalStorage.js"></script>
		<script type="text/javascript" src="/660273/img/svg/images.js"></script>
		<script type="text/javascript" src="/660273/assets/js/ajax.js"></script>
		<script type="text/javascript" src="/660273/assets/js/validate.js"></script>
		<script type="text/javascript" src="/660273/assets/js/admin.js"></script>
		
		<title>Initial Installation</title>
		</head>
		<body>
			<script>
				emptyLocalStorage();
			</script>
			<header id="head-wrapper">
				<div class="header-container">
					<div id="shop-name">
						<h1><a title="Go home" href="/660273">Shop Installation</a></h1>
					</div>

						</nav>
					</div>
				</header>
				<div id="wrapper">
					<div class="main-content cms" id="main-content">

<div class="installContent">
	<h1>Step 2 - Data</h1>

	<form method="POST" action="/660273/admin/setup/addData.php" id="site-settings" class="siteSettings">
		<fieldset>
			<p class="boldgreen"><strong>Database created and config file written.</strong></p>
			<label for="sample">Insert sample data?:</label>
			<input type="checkbox" id="sample" value="yes" name="sample">
		</fieldset>

		<input type="submit" value="Submit">

	</form>

	</div>
			</div>
			<footer id="footer">
					<section id="copy">
						<p>UP660273 &#169; 2013.</p>
					</section>
			</footer>	
		</div>
	</body>
</html>