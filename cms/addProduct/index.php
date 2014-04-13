<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<h1>Add Product</h1>
	<div class="hideStatus" id="submitResult"><div class="submitProgress" id="submitProgress"><p class="hideStatus" id="completeMsg"></p></div></div>
	<form id="addItem" class="formContainer">
		<div class="hideStatus" id="addItemNameMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="addItemName">Item Name:</label>
			<input type="text" id="addItemName" class="addItemName" name="addItemName" data-pat="Letters, numbers, ampersands, spaces, and quotes" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\x26\x20\x22]{0,99}$" maxlength="100" required/>
		</div>

		<div class="hideStatus" id="addItemDescMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="addItemDesc">Description:</label>			
			<textarea id="addItemDesc" class="addItemDesc" name="addItemDesc" rows="5" cols="30" maxlength="500" data-pat="Letters, numbers, ampersands, spaces, and quotes" placeholder="Write more detailed information about the item here" required></textarea>
		</div>

		<div class="hideStatus" id="addItemPriceMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="addItemPrice">Price (<?php echo $settings['currency'] ?>):</label>
			<input type="number" id="addItemPrice" class="addItemPrice" step="0.01" name="addItemPrice" data-type="Currency (Decimal)" min="0.00" required/>
		</div>

		<div class="hideStatus" id="addItemQuantityMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="addItemQuantity">Stock Quantity:</label>
			<input type="number" id="addItemQuantity" class="addItemQuantity" name="addItemQuantity" data-type="Integer" step="1" min="0" required/>
		</div>

		<div class="hideStatus" id="imgFileMsg"><p class="status error validateMsg"></p></div>
		<label for="imgFile">Primary Image:</label>
		<input class="upFile" type="file" name="imgFile" id="imgFile" accept="image/*" required>

		<div class="uploading">
			<div class="uploadedImages" id="mainImage"></div>
			<div class="hideProgress" id="progressWrapper">
				<progress class="progressBar" id="progressBar" max="100" value="0">0%</progress>
			</div>
		</div>

		<div class="hideStatus" id="exImgFile1Msg"><p class="status error validateMsg"></p></div>
		<label for="exImgFile1" class="aboveLabel">Extra Images:</label>
		<fieldset class="extraImages">
			<div id="addedImages">
				<input class="upFile" type="file" name="exImgFile" id="exImgFile1" accept="image/*">
				<div class="uploading">
					<div class="uploadedImages" id="exImg1"></div>
					<div class="hideProgress" id="exProgressWrap1">
						<progress class="progressBarHidden" id="exProgressBar1" max="100" value="0">0%</progress>
					</div>
				</div>
			</div>

			<div id="maxWarning" class="hideStatus"><p class="status error">Max. 5 extra images reached</p></div>			
			<button type="button" class="addExImages" id="addExImages">Add More Images</button>

		</fieldset>

		<div class="hideStatus" id="selectedCatMsg"><p class="status error validateMsg"></p></div>

		<div class="formGroup">
			<label class="aboveLabel">Category:</label>
			<div id="parentCat" class="parentCat">
				<ul class="catTree" id="catTree">
					<li id="rootCat"><i class="icon fa fa-folder" id="catNode0"></i>
						<input type="radio" name="selectedCat" class="hidden" id="parentCat0" value="0" disabled required>
						<label for="parentCat0">Root</label>
						<ul id="subCatList0">
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<?php include (INCL_ROOT . "formControls.php"); ?>

	</form>
</div>

<?php include (INCL_ROOT . "footer.php") ?>