<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	include("sanitise_input.php");

	$id = (isset($_GET["id"]) ? $conn->real_escape_string(sanitise_input($_GET["id"])) : 0);

	// If preset type is dropdown, get dropdown values
	if ($id <> 0) {
		if(! $stmt = $conn->prepare("SELECT * FROM cf_dropdown_value WHERE cf_id=?")) 
		{	
			die();		
		} else {
				$stmt->bind_param('i', $id);
			} 
				
			if($stmt->execute()) {
			
				$result = $stmt->get_result();
				
			} else {
				die("Could not retrieve presets");
			}

			$jsonData = [];

			$i = 0;

		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$i++;
			$opt = array(
				"id" => $row["cfdv_id"],
				"name" => $row["cfdv_title"],
				"value" => $row["cfdv_value"],
			);

			$jsonData["opt" . $i] = $opt;
		}

		echo json_encode($jsonData);
	}
	else
	{
		// Get defined custom field data
		if(! $stmt = $conn->prepare("SELECT * FROM custom_field")) {	
			echo "ERROR:" . $conn->error;
			die();	
		}
			
		if($stmt->execute()) {
		
			$result = $stmt->get_result();
			
		} else {
			die("Could not retrieve presets");
		}

		$jsonData = [];
		$i = 0;

		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$i++;
			$preset = array(
				"id" => $row["id"],
				"name" => $row["cf_name"],
				"cfType" => $row["cf_type"],
				"min" => $row["cf_min"],
				"max" => $row["cf_max"],
				"letters" => $row["cf_letters"],
			);

			$jsonData["preset" . $i] = $preset;
		}
	$stmt->free_result();
	echo json_encode($jsonData);
	}
	
?>