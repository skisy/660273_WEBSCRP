<?php
	header("Content-Type: application/json");
	//Add server side validation - echo result fail - handle echo result in ajax

	include('db_connect.php');

	$name = $_POST["addItemName"];
	$desc = $_POST["addItemDesc"];
	$price = $_POST["addItemPrice"];
	$stock = $_POST["addItemQuantity"];
	$cat = $_POST["selectedCat"];

	if(! $stmt = $conn->prepare("INSERT INTO product (p_name, p_long_desc, p_price, p_stock_quantity) values (?, ?, ?, ?)")) 
	{
		echo '{"result":"' . $conn->error . '"}';
		die();	
	} else {
		$stmt->bind_param('ssdi', $name, $desc, $price, $stock);
	}

	if(! $stmt->execute()) {
		echo '{"result":"' . $stmt->error . '"}';
		die();
	}

	$itemId = mysqli_insert_id($conn);	// Save auto generated id of product inserted

	// Insert product_category record for product inserted

	if(! $stmt = $conn->prepare("INSERT INTO product_category (p_id, cat_id) values (?, ?)")) 
	{
		echo '{"result":"' . $conn->error . '"}';
		die();	
	} else {
		$stmt->bind_param('ii', $itemId, $cat);
	}

	if(! $stmt->execute()) {
		echo '{"result":"' . $stmt->error . '"}';
		die();
	}

	// Move picture file uploaded in form to image folder on server & insert record for main product image
	$folder = "../../img/products/" . $itemId;
	if (!is_dir($folder)) { mkdir($folder); }

	if(move_uploaded_file($_FILES["imgFile"]["tmp_name"], "../../img/products/" . $itemId . "/" . $_FILES["imgFile"]["name"]))
	{
		if(! $stmt = $conn->prepare("INSERT INTO product_image (p_id, pi_url, pi_main_pic) values (?, ?, ?)")) 
		{
			echo '{"result":"' . $conn->error . '"}';
			die();	
		} else {
			$imageName = $_FILES["imgFile"]["name"];
			$mainPic = 1;
			$stmt->bind_param('isi', $itemId, $imageName, $mainPic);
		}

		if(! $stmt->execute()) {
			echo '{"result":"' . $stmt->error . '"}';
			die();
		}
	}

	for ($i = 1; $i < 6; $i++)
	{
		$fileIndex = "exImgFile" . $i;
		if((isset($_FILES[$fileIndex])) and (move_uploaded_file($_FILES[$fileIndex]["tmp_name"], "../../img/products/" . $itemId . "/" . $_FILES[$fileIndex]["name"])))
		{
			if(! $stmt = $conn->prepare("INSERT INTO product_image (p_id, pi_url, pi_main_pic) values (?, ?, ?)")) 
			{
				echo '{"result":"' . $conn->error . '"}';
				die();	
			} else {
				$imageName = $_FILES[$fileIndex]["name"];
				$mainPic = 0;
				$stmt->bind_param('isi', $itemId, $imageName, $mainPic);
			}

			if(! $stmt->execute()) {
				echo '{"result":"' . $stmt->error . '"}';
				die();
			}
		}
	}

	echo '{"result":"success"}';

?>