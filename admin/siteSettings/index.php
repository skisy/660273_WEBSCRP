<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	if (isset($_POST["Submit"]))
	{
		try {

			$string = "";

			switch ($_POST["theme"])
			{
				case "purple":
					$primaryCol = "rgb(81,51,171)";
					$secondaryCol = "rgb(228, 222, 245)";
					break;
				case "blue":
					$primaryCol = "rgb(0,105,133)";
					$secondaryCol = "rgb(211,246,255)";
					break;
				case "red":
					$primaryCol = "rgb(172,25,61)";
					$secondaryCol = "rgb(250,221,229)";
					break;
				case "orange":
					$primaryCol = "rgb(233,105,44)";
					$secondaryCol = "rgb(250,219,204)";
					break;
				case "green":
					$primaryCol = "rgb(59,120,86)";
					$secondaryCol = "rgb(217,236,226)";
					break;
				default:
					$primaryCol = "rgb(81,51,171)";
					$secondaryCol = "rgb(228, 222, 245)";
					break;
			}

			$settings["title"] = $_POST["shopname"];
			$settings["primary-colour"] = $primaryCol;
			$settings["secondary-colour"] = $secondaryCol;

			foreach ($settings as $key => $value)
			{
				$string .= $key . '= "' . $value . '"' . PHP_EOL;
			}

			$filename = INCL_ROOT . 'config.ini';
			$file = fopen($filename,"w") or die('cant create file');

			fwrite($file, $string);
			fclose($file);

			header('Location: /660273/');
		}
		catch (Exception $e)
		{}
	}

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'adminNav.php');
?>

<div class="right-content">
	<h1>Site Settings</h1>
	<form id="siteSettings" class="formContainer" method="POST" action="">
		<div class="formGroup">
			<label for="shopname">Shop Name:</label>
			<input type="text" name="shopname" id="shopname" data-pat="Letters and Numbers" pattern="^[a-zA-Z'.,- ]{0,150}$" required>
		</div>

		<div class="formGroup">
			<label for="theme">Theme:</label>
			<select class="theme-picker" name="theme" id="theme" required>
				<optgroup id="dark-options" label="Dark Colours">
					<option id="purple" value="purple">Dark Violet</option>
					<option id="blue" value="blue">Blue Sapphire</option>
					<option id="red" value="red">Crimson</option>	
					<option id="orange" value="orange">Carrot Orange</option>
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
		<input type="submit" name="Submit" value="Submit">
	</form>
</div>

<?php include (INCL_ROOT . 'footer.php');?>