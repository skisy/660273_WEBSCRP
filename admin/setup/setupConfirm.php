<?php 	
	include ("sitePaths.php");
	
	try {
		if(isset($_POST['shopname']))
		{
			$filename = INCL_ROOT . 'config.ini';
			$file = fopen($filename,"w") or die('Unable to open/create settings files');
			
			$colour = $_POST['theme'];

			$dbname = $_POST["db-name"];
			$server = $_POST["server-ip"];
			$user = $_POST["server-username"];
			$pass = $_POST["server-password"];

			switch ($colour)
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

			$tertiaryCol = "rgb(255,255,255)";
			$basketCol = "white";
			
			$shopname = $_POST['shopname'];
			
			$string = 'title = "' . $shopname . '"
currency = "&pound;"
primary-colour = "' . $primaryCol . '"
secondary-colour = "' . $secondaryCol . '"
tertiary-colour = "' . $tertiaryCol . '"
basket-colour = "' . $basketCol . '"
host-ip = "' . $server . '"
db-name = "' . $dbname . '"
username = "' . $user . '"
password = "' . $pass . '"';

			fwrite($file, $string);
			fclose($file);
		}

		$conn = new mysqli($host, $user, $pass);

		$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname . "; USE " . $dbname . "; ";
		$sql .= file_get_contents(ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "createDB.sql");

		if(!$conn->multi_query($sql))
		{
			die("Couldn't create database");
		}
		$conn->close();

		header('Location: /660273/step2.php');
		exit;
	}
	catch (Exception $ex)
	{
		header('Location: /660273/install.php');
		exit;
	}
?>