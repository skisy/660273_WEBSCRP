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
			<header id="head-wrapper">
				<div class="header-container">
					<div id="shop-name">
						<h1><a title="Go home" href="/660273">Shop Installation</a></h1>
					</div>
				</div>
				</header>
				<div id="wrapper">
					<div class="main-content cms" id="main-content">

<div class="installContent">
	<h1>Initial Setup</h1>
	<p class="important">No database detected. Please fill in the fields below to set up your shop and install the database.</p>

	<form method="POST" action="/660273/admin/setup/setupConfirm.php" id="site-settings" class="siteSettings">
		<fieldset id="shopDetails">
			<h1>Shop Details</h1>
			<div class="hideStatus" id="shopnameMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="shopname">Shop Name:</label><input type="text" name="shopname" id="shopname" data-pat="Letters and Numbers" pattern="^[a-zA-Z'.,- ]{0,150}$" required>
			</div>
			<div class="hideStatus" id="currencyMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="currency">Currency:</label><select name="currency" id="currency" required disabled>
					<option value="&amp;pound;">&pound;</option>
					<option value="&amp;yen;">&yen;</option>
					<option value="&amp;euro;">&euro;</option>
					<option value="&amp;dollar;">&dollar;</option>
				</select>
				<small><em>The currency feature is disabled as it is not currently fully implemented.</em></small>
			</div>
		</fieldset>

		<fieldset id="shopAppearance">
			<h1>Appearance</h1>
			<div class="hideStatus" id="themeMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="theme">Theme:</label>
				<select class="theme-picker" name="theme" id="theme" required>
					<optgroup id="dark-options" label="Dark Colours">
						<option id="purple" value="purple">Dark Violet</option>
						<option id="blue" value="blue">Blue Sapphire</option>
						<option id="red" value="red">Crimson</option>	
						<!--<option id="orange" value="orange">Carrot Orange</option>-->
						<option id="green" value="green">Amazon Green</option>
					</optgroup>
					<!--<optgroup id="light-options" label="Light Colours" disabled>
						<option id="light-purple" value="Light Colours.rgba(191, 148, 228,">Bright Lavender</option>
						<option id="light-blue" value="Light Colours.rgba(0,165,210,">Bright Cerulean</option>
						<option id="light-red" value="Light Colours.rgba(232, 92, 128,">Blush Pink</option>	
						<option id="light-orange" value="Light Colours.rgba(255,136,77,">Atomic Tangerine</option>
						<option id="light-green" value="Light Colours.rgba(78, 228, 78,">Soft Lime Green</option>
					</optgroup>-->
				</select>
			</div>
		</fieldset>

		<fieldset id="database">
			<h1>Database</h1>
			<div class="formGroup">
				<label for="server-ip">Server IP:</label>
				<input type="text" name="server-ip" id="server-ip" value="127.0.0.1" pattern="^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$" required>
			</div>
			<div class="formGroup">
				<label for="db-name">Database Name:</label>
				<input type="text" name="db-name" id="db-name" value="shopdb">
			</div>
			<div class="formGroup">
				<label for="server-username">Username:</label>
				<input type="text" name="server-username" id="server-username" value="root" required>
			</div>
			<div class="formGroup">
				<label for="server-password">Password:</label>
				<input type="password" name="server-password" id="server-password" value="">
			</div>
		</fieldset>

		<input type="submit" value="Submit">

	</form>

	</div>
			</div>
			<footer id="footer">
					<section id="copy">
						<p>UP660273 &#169; 2013.</p>
					</section>
					<script>
					var x = "Version: " + navigator.userAgent;
					console.log(x);
					</script>
			</footer>	
		</div>
	</body>
</html>