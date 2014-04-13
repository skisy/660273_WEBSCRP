<?php
	
	if(move_uploaded_file($_FILES["imgFile"]["tmp_name"], "../../img/products/" . $_FILES["imgFile"]["name"]))
	{
		echo "<img src='/660273/img/products/" . $_FILES["imgFile"]["name"] . "' >";
	}

	/*if(move_uploaded_file($_FILES["exImgFile"]["tmp_name"], "../../img/products/" . $_FILES["exImgFile"]["name"]))
	{
		echo "<img src='/660273/img/products/" . $_FILES["exImgFile"]["name"] . "' >";
	}*/
?>