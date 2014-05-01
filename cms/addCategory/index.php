<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>
<div class="right-content">
	<a href="../manageCategories"><div title="Manage Categories" id="manCatBtn" class="formButton cmsManageBtn topControls"><?php include (IMG_ROOT . 'svg/manage.svg')?></div></a>
	<h1 class="inlineTitle">Add Category</h1>
	
	<div class="hideStatus" id="submitResult"><div class="submitProgress" id="submitProgress"><p class="hideStatus" id="completeMsg"></p></div></div>
	<form id="addCategory" class="formContainer">

		<div class="hideStatus" id="addCatNameMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="addCatName">Name:</label>
			<input type="text" id="addCatName" name="addCatName" data-pat="Letters, numbers, ampersands, spaces, and quotes" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\x26\x20\x22]{0,49}$" maxlength="50" required>
		</div>

		<div class="hideStatus" id="selectedCatMsg"><p class="status error"></p></div>
		<div class="formGroup">
			<label class="aboveLabel">Parent Category:</label>
			<div id="parentCat" class="parentCat">
				<ul class="catTree" id="catTree">
					<li id="rootCat">
						<i class="icon fa fa-folder" id="catNode0"></i>
						<input type="radio" name="selectedCat" id="parentCat0" value="0" checked required>
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

<?php include (INCL_ROOT . "footer.php"); ?>