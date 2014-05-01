<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<a href="../manageAttributes"><div title="Manage Attributes" id="manAttrBtn" class="formButton cmsManageBtn topControls"><?php include (IMG_ROOT . 'svg/manage.svg')?></div></a>
	<h1 class="inlineTitle">Add Custom Attributes</h1>
	
	<div class="hideStatus" id="submitResult"><div class="submitProgress" id="submitProgress"><p class="hideStatus" id="completeMsg"></p></div></div>
	<form id="addAttribute" class="formContainer">
		<div class="hideStatus" id="attrNameMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="attrName">Attribute Name:</label>
			<input type="text" id="attrName" name="attrName" data-pat="Letters, numbers, and spaces" maxlength="50" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\x20\x28\x29]{0,49}$" required>
		</div>

		<div class="formGroup">
			<div class="hideStatus" id="attrTypeMsg"><p class="status error validateMsg"></p></div>
			<label for="attrType" >Attribute Type:</label>
			<select name="attrType" id="attrType">
				<option value="Text" selected>Text</option>
				<option value="Date">Date</option>
				<option value="Integer">Integer</option>
				<option value="Decimal">Decimal</option>
				<option value="Boolean">Boolean (True/False)</option>
				<option value="Dropdown">Dropdown</option>
			</select>
		</div>

		<div class="validation">
			<div id="minMaxDif" class="hideStatus"><p class="status error validateMsg">Maximum value must be greater to or equal to minimum value</p></div>
		</div>

		<div id="moreAttr">
		</div>

		<?php include (INCL_ROOT . "formControls.php"); ?>

	</form>
</div>

<?php include (INCL_ROOT . "footer.php"); ?>