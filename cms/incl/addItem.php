<!DOCTYPE html>
<html>
<head>
	<style>
	label {
		float:left;
		text-align:right;
		margin-right: 15px;
		width: 100px;
	}
	
	div {
		margin: 5px 0;
	}
	
	textarea, input, select {
		border-radius: 5px;
	}
	
	textarea:focus, input:focus, select:focus {
		outline: none;
		border: 2px solid rgb(81,51,171);
	}
	</style>
</head>
<div class="reformed-form">
	<form method="post" name="addItem" id="addItem" action="#" enctype="multipart/form-data">
			<div>
			<label for="itemName">Item Name:</label>
			<input type="text" id="itemName" class="itemName" name="itemName" pattern="[a-zA-Z0-9\s]+" maxlength=100 required/>
			</div>
			<div>
			<label for="itemDesc">Description:</label>			
			<textarea id="itemDesc" class="required" name="itemDesc" rows="5" cols="30" maxlength=500>Write more detailed information about the item here</textarea>
			</div>
			<div>
			<label for="itemPrice">Price:</label>
			<input type="text" id="itemPrice" class="itemPrice" name="itemPrice" pattern="^\d+([.,]\d\d)" />
			</div>
			<label for="itemQuantity">Stock Quantity:</label>
			<input type="number" id="itemQuantity" class="itemQuantity" name="itemQuantity" min="0"/>
			<div>
			<label for="itemCategory">Category:</label>
			<select size="1" name="itemCategory" id="itemCategory" class="required">
				<option value="TestCategory">Test Category</option>
			</select>
			</div>
			<div>
			<label for="itemSubCategory">Sub-Category:</label>
			<select size="1" name="itemSubCategory" id="itemSubCategory">
				<option value="0">No Sub-Category</option>
			</select>
			</div>
			<div>
			<label for="itemPhoto">Photo:</label>
			<input type="file" id="itemPhoto" name="itemPhoto" accept="gif,jpg,png" />
			</div>
		<div id="submit_buttons">
			<button type="reset">Reset</button>
			<button type="submit">Submit</button>
		</div>
		</form>
</div>
</body>
</html>
