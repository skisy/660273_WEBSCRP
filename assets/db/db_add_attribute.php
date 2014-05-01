<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	$valid = true;

	$name = $conn->real_escape_string(sanitise_input($_POST["attrName"]));
	$type = $conn->real_escape_string(sanitise_input($_POST["attrType"]));


	// Check chosen data type of attribute
	switch ($type)
	{
		case "Text":
			$letters = $conn->real_escape_string(sanitise_input($_POST["attrLet"]));
			$max = NULL;
			$min = NULL;
			break;
		case "Integer":
		case "Decimal":
			$max = (is_numeric($_POST["attrMax"]) ? $conn->real_escape_string(sanitise_input($_POST["attrMax"])) : NULL);
			$min = (is_numeric($_POST["attrMin"]) ? $conn->real_escape_string(sanitise_input($_POST["attrMin"])) : NULL);
			$letters = 0;
			break;
		case "Date":
		case "Boolean":
		case "Dropdown":
			$max = NULL;
			$min = NULL;
			$letters = 0;
			break;
		default:
			break;
	}

	// Disable autocommit (all inserts must succeed)

	$conn->autocommit(false);

	// Insert attribute record

	if(! $stmt = $conn->prepare("INSERT INTO custom_field (cf_name, cf_type, cf_min, cf_max, cf_letters) values (?, ?, ?, ?, ?)")) 
	{
		$valid = false;
		die();	
	} else {
		$stmt->bind_param('ssddi', $name, $type, $min, $max, $letters);
	}

	if(! $stmt->execute()) {
		$valid = false;
		die();
	}

	// Get automatically generated id
	$cf_id = $conn->insert_id;

	// If dropdown type selected - additional inputs for dropdown options will be present.
	// Insert as related records (using above id) into cf_dropdown_value table
	if ($type == "Dropdown")
	{
		$metaExists = true;

		$i = 1;

		while ($metaExists)
		{
			if (isset($_POST["dropTitle" . $i]))
			{
				$name = $conn->real_escape_string(sanitise_input($_POST["dropTitle" . $i]));
				$value = $conn->real_escape_string(sanitise_input($_POST["dropValue" . $i]));
				
				if(! $stmt = $conn->prepare("INSERT INTO cf_dropdown_value (cf_id, cfdv_title, cfdv_value) values (?, ?, ?)")) 
				{
					$valid = false;
					die();	
				} else {
					$stmt->bind_param('iss', $cf_id, $name, $value);
				}

				if(! $stmt->execute()) {
					$valid = false;
					die();
				}
			}
			else
			{
				$metaExists = false;
			}
			$i++;
		}
	}

	// Commit all queries
	if(!$conn->commit()) { $valid=false; }

	// Return result
	if ($valid)
	{
		echo '{"result":"success"}';
	}
	else
	{
		echo '{"result":"failed"}';
	}
?>