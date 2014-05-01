<?php
include ("sitePaths.php");
include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "db_connect.php");
try {

	if(isset($_POST['sample']))
	{
		$data = file_get_contents(ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "sampleData.sql");

		$conn->multi_query($data);
		$conn->close();

		header('Location: /660273/cms');
	}
	else
	{
		header('Location: /660273/cms');
	}
}
catch(Exception $ex)
{
	echo $ex;
}
?>