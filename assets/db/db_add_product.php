<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	$name = $conn->real_escape_string(sanitise_input($_POST["addItemName"]));
	$desc = $conn->real_escape_string(sanitise_input($_POST["addItemDesc"]));
	$price = $conn->real_escape_string(sanitise_input($_POST["addItemPrice"]));
	$stock = $conn->real_escape_string(sanitise_input($_POST["addItemQuantity"]));
	$cat = $conn->real_escape_string(sanitise_input($_POST["selectedCat"]));

	$meta = "{";
	$valid = true;

	$metaExists = true;

	$i = 0;

	// Creates JSON formatted string of product data to add to database 
	while ($metaExists)
	{
		if (isset($_POST["name" . $i]) && $_POST["name" . $i] !== "NaN" && $_POST["value" . $i] !== "NaN")
		{
			$meta .= '"' . $conn->real_escape_string(sanitise_input($_POST["name" . $i])) . '":"' . $conn->real_escape_string(sanitise_input($_POST["value" . $i])) . '",';
		}
		else
		{
			$metaExists = false;
		}
		$i++;
	}

	// Strip final slash from JSON formatted string and replace with } to close it
	$jsonMeta = subStr($meta, 0, -1) . "}";

	// Disable autocommit (multiple queries must all succeed)
	$conn->autocommit(false);

	// Insert product record (including JSON string with product data into p_meta field)
	if(! $stmt = $conn->prepare("INSERT INTO product (p_name, p_long_desc, p_price, p_stock_quantity, p_meta) values (?, ?, ?, ?, ?)")) 
	{
		$valid = false;
		die();	
	} else {
		$stmt->bind_param('ssdis', $name, $desc, $price, $stock, $jsonMeta);
	}

	if(! $stmt->execute()) {
		$valid = false;
		die();
	}

	$itemId = mysqli_insert_id($conn);	// Save auto generated id of product inserted

	// Insert product_category record for product inserted
	if(! $stmt = $conn->prepare("INSERT INTO product_category (p_id, cat_id) values (?, ?)")) 
	{
		$valid = false;
		die();	
	} else {
		$stmt->bind_param('ii', $itemId, $cat);
	}

	if(! $stmt->execute()) {
		$valid = false;
		die();
	}

	// Set folder directory for product images (created if not exists)
	$folder = "../../img/products/" . $itemId;
	if (!is_dir($folder)) { mkdir($folder); }

	// Move picture file uploaded in form to image folder on server & insert record for main product image
	if(move_uploaded_file($_FILES["imgFile"]["tmp_name"], "../../img/products/" . $itemId . "/" . $_FILES["imgFile"]["name"]))
	{
		if(! $stmt = $conn->prepare("INSERT INTO product_image (p_id, pi_url, pi_main_pic) values (?, ?, ?)")) 
		{
			$valid = false;
			die();	
		} else {
			$imageName = $_FILES["imgFile"]["name"];
			$mainPic = 1;
			$stmt->bind_param('isi', $itemId, $imageName, $mainPic);
		}

		if(! $stmt->execute()) {
			$valid = false;
			die();
		}
	}

	// Loop through extra image files and move to product image folder on server
	for ($i = 1; $i < 6; $i++)
	{
		$fileIndex = "exImgFile" . $i;
		if((isset($_FILES[$fileIndex])) and (move_uploaded_file($_FILES[$fileIndex]["tmp_name"], "../../img/products/" . $itemId . "/" . $_FILES[$fileIndex]["name"])))
		{
			if(! $stmt = $conn->prepare("INSERT INTO product_image (p_id, pi_url, pi_main_pic) values (?, ?, ?)")) 
			{
				$valid = false;
				die();	
			} else {
				$imageName = $_FILES[$fileIndex]["name"];
				$mainPic = 0;
				$stmt->bind_param('isi', $itemId, $imageName, $mainPic);
			}

			if(! $stmt->execute()) {
				$valid = false;
				die();
			}
		}
	}

	// Commit all queries
	if(!$conn->commit()) { $valid = false; }

	if ($valid) { echo '{"result":"success"}'; }
	else { echo '{"result":"failed"'; }

?>