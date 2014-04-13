<?php
	if (isset($_FILES['imgFile']))
	{
		try {
		    switch ($_FILES['imgFile']['error']) {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
		            throw new RuntimeException('nofile');
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:
		            throw new RuntimeException('sizelimit');
		        default:
		            throw new RuntimeException('unknown');
		    }

		    // Check filesize
		    if ($_FILES['imgFile']['size'] > 2097152) {
		        throw new RuntimeException('sizelimit');
		    }

		    $fileName = $_FILES['imgFile']['name'];
		    $fileType = $_FILES['imgFile']['type'];
		    $acceptedExt = array("image/gif","image/jpeg","image/jpg","image/png");

		    if (!in_array($fileType, $acceptedExt))
		    {
		    	throw new RuntimeException('format');
		    }

		    $fileContent = file_get_contents($_FILES['imgFile']['tmp_name']);
		    $dataURL = 'data:' . $fileType . ';base64,' . base64_encode($fileContent); 

		    $jsonData = json_encode(array(
		    	'name' => $fileName,
		    	'type' => $fileType,
		    	'dataUrl' => $dataURL));

		    echo $jsonData;

		} catch (RuntimeException $e) {
		    $error = $e->getMessage();
		    echo $error;
		}
	}
	else
	{
		echo 'sizelimit';
	}
 
 ?>