<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<a href="../manageProducts"><div title="Manage Products" id="manProdBtn" class="formButton cmsManageBtn topControls"><?php include (IMG_ROOT . 'svg/manage.svg')?></div></a>
	<h1 class="inlineTitle">Add Product</h1>

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
			<textarea id="addItemDesc" class="addItemDesc" name="addItemDesc" rows="5"  data-pat="Letters, numbers, ampersands, spaces, and quotes" placeholder="Write more detailed information about the item here" required></textarea>
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
		<fieldset class="productFieldset">
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
				<small>Hint: You cannot choose "Root" as the product category, click the folder icon to expand.</small>
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

		<div class="formGroup">
			<label for="meta" class="aboveLabel">Product Data:</label>
			<fieldset id="meta" class="productFieldset">
				<strong>Add custom attributes to better describe the product:</strong>
				 <small>Creating preset <a href="../addattribute">custom attributes</a> enables you to choose the data type for more useful, searchable and comparable data. It also expedites the process of adding them to products.</small>
				 <div class="metaContainer" id="metaContainer">
					 <div class="keyValueGroup">
						<div class="formGroup">
							<div class="hideStatus" id="name0Msg"><p class="status error validateMsg"></p></div>
							<label for="name0">Name:</label>
							<input type="text" id="name0" class="metaName" data-pat="Letters, numbers, parentheses, quotes" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$">
						</div>
						<div class="formGroup">
							<div class="hideStatus" id="value0Msg"><p class="status error validateMsg"></p></div>
							<label for="value0">Value:</label>
							<input type="text" id="value0" class="metaValue" data-pat="Letters, numbers, parentheses, quotes" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$">
						</div>
					</div>
				</div>
				<div class="addMetaButtons">
					<button type="button" class="addMeta" id="addMeta">Add Attribute</button>
					<div class="presets">
						<button type="button" class="addMeta" id="addPreset">Add From Presets</button>
						<select id="metaPreset" data-type="Text" class="metaPreset">
							<option value="Default" selected>Default</option>
						</select>
					</div>
				</div>
			</fieldset>
		</div>

		<?php include (INCL_ROOT . "formControls.php"); ?>

	</form>
</div>

<?php include (INCL_ROOT . "footer.php") ?>