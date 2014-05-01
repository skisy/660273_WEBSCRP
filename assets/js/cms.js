function addImages()
{
	var exists = true;
	var img = 1;
	var addedImages = document.getElementById('addedImages');
	var maxWarn = document.getElementById('maxWarning');

  function showWarning() 
  {
      maxWarn.className = "hideStatus";  
  }
  
	while (exists === true)
	{
		if (img > 5) {
			exists = false;
			maxWarn.className = "showStatus";
			setTimeout(showWarning, 3000);
		}
		else
		{
			if (!document.getElementById('exImgFile' + img))
			{
				exists = false;

				var wrapper = document.createElement("div");
				wrapper.className = "uploading";

				var newInput = document.createElement("input");
				newInput.className = "upFile";
				newInput.type = "file";
				newInput.name ="exImgFile";
				newInput.id = "exImgFile" + img;
				newInput.accept = "image/*";

				var newUpImg = document.createElement("div");
				newUpImg.className = "uploadedImages";
				newUpImg.id = "exImg" + img;

				var newImgProg = document.createElement("progress");
				newImgProg.className = "progressBar";
				newImgProg.id = "exProgressBar" + img;
				newImgProg.max = "100";
				newImgProg.value = "0";

				var newProgWrapper = document.createElement("div");
				newProgWrapper.id = "exProgressWrap" + img;
				newProgWrapper.className = "hideProgress";

				var validate = document.createElement("div");
				validate.id = "exImgFile" + img + "Msg";
				validate.className = "hideStatus";

				var validMsg = document.createElement("p");
				validMsg.className = "status error validateMsg"; 

				validate.appendChild(validMsg);

				newProgWrapper.appendChild(newImgProg);

				wrapper.appendChild(newInput);
				wrapper.appendChild(newUpImg);
				wrapper.appendChild(newProgWrapper);

				addedImages.appendChild(validate);
				addedImages.appendChild(wrapper);
			}
		}
		
		img++;

	}
}

function addDropOptions()
{
	var container = document.getElementById("dropOptions");
	var exists = true;
	var opt = 1;

	while (exists === true)
	{
		if (!document.getElementById('optGroup' + opt))
		{
			exists = false;

			var div1 = document.createElement("div");
			var div2 = document.createElement("div");

			var group = document.createElement("div");
			group.className = "formGroup dropGroup";
			group.id = "optGroup" + opt;

			var titleLabel = document.createElement("label");
			titleLabel.htmlFor = "dropTitle" + opt;
			titleLabel.textContent = "Name:";

			var titleMsg = document.createElement("div");
			titleMsg.className = "hideStatus";
			titleMsg.id = "dropTitle" + opt +  "Msg";
			titleMsg.innerHTML = "<p class='status error validateMsg'></p>";

			var titleInput = document.createElement("input");
			titleInput.type = "text";
			titleInput.id = "dropTitle" + opt;
			titleInput.name = "dropTitle" + opt;
			titleInput.className = "addAttrInput";
			titleInput.pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$";
			titleInput.dataset.pat = "Letters, numbers, parentheses, quotes";

			var valueLabel = document.createElement("label");
			valueLabel.htmlFor = "dropValue" + opt;
			valueLabel.textContent = "Value:";

			var valueMsg = document.createElement("div");
			valueMsg.className = "hideStatus";
			valueMsg.id = "dropValue" + opt +  "Msg";
			valueMsg.innerHTML = "<p class='status error validateMsg'></p>";

			var valueInput = document.createElement("input");
			valueInput.type = "text";
			valueInput.id = "dropValue" + opt;
			valueInput.name = "dropValue" + opt;
			valueInput.className = "addAttrInput";
			valueInput.pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$";
			valueInput.dataset.pat = "Letters, numbers, parentheses, quotes";

			div1.appendChild(titleMsg);
			div1.appendChild(titleLabel);
			div1.appendChild(titleInput);
			div2.appendChild(valueMsg);
			div2.appendChild(valueLabel);
			div2.appendChild(valueInput);
			group.appendChild(div1);
			group.appendChild(div2);
			container.appendChild(group);
		}
		opt++;
	}
}

/*function displayCategoryRoot(result) {
	console.log(result);
	var container = document.getElementById("subCatList0");

	for (var obj in result)
	{
		createList(result[obj], container);
	}
}*/


function addMoreAttr() {
	document.getElementById("minMaxDif").className = "hideStatus";
	var selected = document.getElementById("attrType").value;
	var moreAttr = document.getElementById("moreAttr");

	switch (selected) {
		case "Text":
			console.log(selected);
			moreAttr.innerHTML = '<div class="hideStatus" id="attrLetMsg"><p class="status error validateMsg"></p></div>' +
								'<label for="attrLet">Letters Only:</label>';
			moreAttr.innerHTML += '<input type="checkbox" id="attrLet" name="attrLet" class="addAttrInput">';
			break;
		case "Date":
			moreAttr.innerHTML = '';
			console.log(selected);
			break;
		case "Integer":
			moreAttr.innerHTML = '<div class="hideStatus" id="attrMaxMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMax">Maximum:</label>' +
								'<input type="number" id="attrMax" name="attrMax" class="addAttrInput" data-type="Integer" data-step="Integer" max="2147483647" min="-2147483648"></div>';
			moreAttr.innerHTML += '<div class="hideStatus" id="attrMinMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMin">Minimum:</label>' +
								'<input type="number" id="attrMin" name="attrMin" class="addAttrInput" data-type="Integer" data-step="Integer" max="2147483647" min="-2147483648"></div>';
			
			console.log(selected);
			break;
		case "Decimal":
			moreAttr.innerHTML = '<div class="hideStatus" id="attrMaxMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMax">Maximum:</label>' +
								'<input type="number" id="attrMax" name="attrMax" class="addAttrInput" data-type="Decimal" step="any"></div>';
			moreAttr.innerHTML += '<div class="hideStatus" id="attrMinMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMin">Minimum:</label>' +
								'<input type="number" id="attrMin" name="attrMin" class="addAttrInput" data-type="Decimal" step="any"></div>';
			console.log(selected);
			break;
		case "Boolean":
			moreAttr.innerHTML = "";
			console.log(selected);
			break;
		case "Dropdown":
			moreAttr.innerHTML = '<small class="info">The name field is what will display when select product fields in the backend.</small><small class="info">The value is what will display to customers.</small>' +
								'<div class="dropOptions" id="dropOptions"><div class="formGroup dropGroup" id="optGroup1">' +
								'<div><div class="hideStatus" id="dropTitle1Msg"><p class="status error validateMsg"></p></div>' +
								'<label for="dropTitle1">Name:</label><input type="text" id="dropTitle1" name="dropTitle1" class="addAttrInput" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$" data-pat="Letters, numbers, parentheses, quotes" required></div>' +
								'<div><div class="hideStatus" id="dropValue1Msg"><p class="status error validateMsg"></p></div>' +
								'<label for="dropValue1">Value:</label><input type="text" id="dropValue1" name="dropValue1" class="addAttrInput" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$" data-pat="Letters, numbers, parentheses, quotes" required></div></div></div>' +
								'<button type="button" class="addDropOpt" id="addDropOpt">Add Dropdown Options</button>';
			document.getElementById("dropTitle1").pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$";
			document.getElementById("dropTitle1").dataset.pat = "Letters, numbers, parentheses, quotes";
			document.getElementById("dropValue1").pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$";
			document.getElementById("dropValue1").dataset.pat = "Letters, numbers, parentheses, quotes";

			document.getElementById("addDropOpt").addEventListener("click", addDropOptions, false);
			console.log(selected);
			break;
		default: 
			break;
	}
}

function displaySubCats(result)
{
	var parent, 
		key, 
		container;

	for (var id in result)
	{
		if (result.hasOwnProperty(id)) {
			parent = result[id];
			key = id;
			break;
		}
	}
	
	container = document.getElementById("subCatList" + key);
	container.innerHTML = "";

	for (var obj in parent)
	{
    if (parent.hasOwnProperty(obj))
    {
        createList(parent[obj], container);    
    }
	}
}

function loadStart()
{
	document.getElementById("submitResult").className = "showStatus";
}

function iconClickHandle(targetId) 
{
	var target = document.getElementById(targetId);
	var targetClass = target.className;
	var catId = targetId.replace("catNode", "");
	var container = document.getElementById("subCatList" + catId);

	if (targetClass.indexOf("open") != -1)
	{
		target.className = targetClass.replace("folder-open", "folder");
		console.log("closing node");
		container.className = "hideList";
	}
	else if (targetClass.indexOf("folder") != -1)
	{
		target.className = targetClass.replace("folder", "folder-open");
		console.log("opening node");
		ajaxHandle(catId, "subCatTree", displaySubCats);
		container.className = "showList";
	}
}

function formSubmittedCallback(resultObj)
{
	var form = document.getElementsByTagName("form")[0];
	var container = document.getElementById("submitResult");
	var result;
	var progress = document.getElementById("submitProgress");
	var msg = document.getElementById("completeMsg");
	
	for (var res in resultObj)
	{
		result = resultObj[res];
		console.log(resultObj[res]);
	}

	if (result == "success")
	{
		progress.style.width = "100%";
		progress.style.background = "green";
		setTimeout(function() { 
			msg.innerHTML = "Record successfully saved."; 
			msg.className = "completeMsg"; 
		}, 1500);	
		form.reset();
	}
	else
	{
		alert("Check your input and try again");
	}

	setTimeout(function() { container.className = "hideStatus"; },4000);
	setTimeout(function() {
		progress.style.width = "";
		progress.style.background = "";
		msg.className = "hideStatus";
		document.getElementById("formSave").disabled = false;
	}, 4500);

	if (form.id == "addAttribute") { addMoreAttr(); }
	else if (form.id == "addItem")
	{
		var images = Array.prototype.slice.call(document.getElementsByClassName("uploadedImages"));
		var attributes = Array.prototype.slice.call(document.getElementsByClassName("keyValueGroup"));

		for (var i = 0; i < images.length; i++)
		{
			images[i].innerHTML = "";
		}

		for (var i = 0; i < attributes.length; i++)
		{
			attributes[i].parentNode.removeChild(attributes[i]);
		}
	}
}

function sendData(form)
{
	var i, fd = new FormData();
	var queryType = form.id;

	var inputs = Array.prototype.slice.call(form.getElementsByTagName("input")),
	textareas = Array.prototype.slice.call(form.getElementsByTagName("textarea")),
	selects = Array.prototype.slice.call(form.getElementsByTagName("select"));

	var elems = inputs.concat(textareas).concat(selects);

	for (i = 0; i < elems.length; i++)
	{
		var elem = elems[i];
		var elemType = elem.type.toLowerCase();

		switch (elemType)
		{
			case "radio":
				if (elem.checked) { fd.append(elem.name, elem.value); }
				break;
			case "checkbox":
				var boolVal = (elem.checked ? 1 : 0);
				fd.append(elem.id, boolVal);
				break;
			case "file":
				var image = elem.files[0];
				console.log(image);
				fd.append(elem.id, image);
				break;
			default:
				if (elem.dataset.type === "Decimal") { fd.append(elem.id, parseFloat(elem.value)); }
				else { fd.append(elem.id, elem.value); }
		}
	}

	/*if (elem = document.getElementById("addCatName")) { fd.append("catName", elem.value); }

	if (elem = document.getElementsByName("selectedCat"))
	{
		for (var i = 0; i < elem.length; i++)
		{
			var radBtn = elem[i];
			if (radBtn.checked) {
				fd.append("parentCat", radBtn.value);
			}
		}
	}

	if (elem = document.getElementsByName("attrName")) { fd.append("attrName", elem.value); }
	if (elem = document.getElementsByName("attrType")) { fd.append("attrType", elem.value); }*/

	ajaxHandle("",queryType, formSubmittedCallback, fd);
}

function saveForm(parentForm)
{
	if (validateForm(parentForm)) {
		window.scrollTo(0,0);
		document.getElementById("formSave").disabled = true;
		sendData(parentForm);
	}
}

function displayRows(result)
{
	var elem = document.getElementsByTagName("table")[0];
	var body, c1, c2, c3, c4, c5, c6, rowName, classGroup, type;
	switch (elem.id)
	{
		case "categoryTable":
			body = "catTableBody";
			rowName = "catRow";
			c1 = "catName";
			c2 = "parentName";
			classGroup = "catField";
			type = "category";
			break;
		case "attributesTable":
			body = "attrTableBody";
			rowName = "attrRow";
			c1 = "attrName";
			c2 = "attrType";
			classGroup = "attrField";
			type = "attribute";
			break;
		case "productTable":
			type = "product";
			body = "prodTableBody";
			rowName = "prodRow";
			c1 = "prodImg";
			c2 = "prodName";
			c3 = "prodDesc";
			c4 = "prodPrice";
			c5 = "prodQuant";
			c6 = "prodCat";
			classGroup = "prodField";
			//console.log(rowName);
			break;
		default:
			break;
	}
	//console.log(result);

	var table = document.getElementById(body);
	table.innerHTML = "";

	var topLevelIt = 0;
	var name;
	var resultString = JSON.stringify(result);

	if (resultString == "{}" || resultString == "[]") { table.innerHTML = "<p>No Results Found.</p>"; }
	else
	{ 
		for (var obj in result)
		{
      if (result.hasOwnProperty(obj)) 
      {
        var row = document.createElement("tr");
        row.id = rowName + result[obj].id;
  
        var first = document.createElement("td");
  
        if (rowName === "prodRow") 
        { 
          name = result[obj].col2;
  
          first.innerHTML = "<img class='tableImg' title='" + name + "' alt='' src='/660273/img/products/" + result[obj].id + "/" + result[obj].col1 + "''>"; 
          first.className = "tableField clickableField " + classGroup;
  
        }
        else if (rowName == "catRow") 
        { 
          name = result[obj].col1;
          first.textContent = name; 
          first.contentEditable = true;
          first.className = "tableField editableField catNameField " + classGroup;
        }
        else if (rowName == "attrRow") 
        {
          name = result[obj].col1;
          first.textContent = name; 
          first.contentEditable = true;
          first.className = "tableField editableField attrNameField " + classGroup;
        }
        
        first.id = c1 + result[obj].id;
  
        var second = document.createElement("td");
        if (result[obj].col2 === null && rowName === "catRow")
        {
          second.innerHTML = "<em>--Top Level Parent--</em>";
          second.id = "parentNameTop" + topLevelIt;
          second.className = "clickableField parentNameTop tableField " + classGroup;
          topLevelIt++;
        }
        else if (rowName === "prodRow")
        {
          second.innerHTML = name;
          second.className = "tableField editableField prodNameField " + classGroup;
          second.contentEditable = true;
        }
        else 
        {
          second.textContent = result[obj].col2;
          second.className = "clickableField tableField " + classGroup;
          if (rowName === "catRow") { second.id = c2 + result[obj].parentId; }
          else if (rowName == "attrRow") { second.id = c2 + result[obj].id; }
        }	
  
        row.appendChild(first);
        row.appendChild(second);
  
  
        if (rowName === "prodRow")
        {
          var third = document.createElement("td");
          third.textContent = result[obj].col3;
          third.id = c3 + result[obj].id;
          third.className = "tableField editableField prodDescField " + classGroup;
          third.contentEditable = true;
  
          var fourth = document.createElement("td");
          fourth.textContent = result[obj].col4;
          fourth.id = c4 + result[obj].id;
          fourth.className = "tableField editableField prodPriceField " + classGroup;
          fourth.contentEditable = true;
  
          var fifth = document.createElement("td");
          fifth.textContent = result[obj].col5;
          fifth.id = c5 + result[obj].id;
          fifth.className = "tableField editableField prodQtyField " + classGroup;
          fifth.contentEditable = true;
  
          var sixth = document.createElement("td");
          sixth.textContent = result[obj].catName;
          sixth.id = c6 + result[obj].id;
          sixth.className = "tableField prodCatField clickableField " + classGroup;
  
          row.appendChild(third);
          row.appendChild(fourth);
          row.appendChild(fifth);
          row.appendChild(sixth);
        }
  
        var action = document.createElement("td");
        action.className = "actionRow " + classGroup;
        action.id = "actRow" + result[obj].id;
        
        var del = document.createElement("div");
        del.className = "actionDiv deleteRow";
        del.innerHTML = "<img class='actIcon' src='../../img/svg/delete.svg' title='Delete " + type + "' alt='Delete " + type + ": " + name + "'><span class='actText'>Delete</span>";
  
        action.appendChild(del);
  
        row.appendChild(action);
        table.appendChild(row);
      }
    }
	}
}

function confirmChange(result)
{
	console.log(result);
}

function changeOrderIconVis(elem)
{
	var icons = document.getElementsByTagName("i");
	for (var i = 0; i < icons.length; i++)
	{
		if (icons[i].className.indexOf("orderIcon") !== -1 && icons[i].id !== elem.id)
		{
			icons[i].className = "orderIconHidden fa fa-caret-up";
		}
	}
}


function findOrdering() 
{
	var icons = document.getElementsByTagName("i");
	var field, order;

	for (var i = 0; i < icons.length; i++)
	{
		if (icons[i].className.indexOf("Hidden") == -1)
		{
			order = (icons[i].className.indexOf("up") !== -1 ? "asc" : "desc");
			console.log(icons[i].id);
			field = icons[i].id.replace("HeadIcon", "");
			break;
		}
	}

	switch (field)
	{
		case "catName":
			field = "cat_name";
			break;
		case "catParent":
			field = "parent_name";
			break;
		case "attrName":
			field = "cf_name";
			break;
		case "attrType":
			field = "cf_type";
			break;
		case "prodName":
			field = "p_name";
			break;
		case "prodDesc":
			field = "p_long_desc";
			break;
		case "prodPrice":
			field = "p_price";
			break;
		case "prodQuant":
			field = "p_stock_quantity";
			break;
		case "prodCat":
			field = "cat_name";
			break;
		default:
			break;
	}

	var data = {};
	data.field = field;
	data.order = order;
	
	var searchTerm = document.getElementById("manageSearch").value.trim();
	if (searchTerm === "") { searchTerm = "%"; }

	return data;
	
}

function rowDeleted(resultObj)
{
 	var result;
	var table = document.getElementsByTagName('table')[0].id;
	var data = findOrdering();

	for (var res in resultObj)
	{
		result = resultObj[res];
	}

	if (result == "failed")
	{
		alert("Cannot delete item as an open order contains related products");
	}

	switch (table)
	{
		case "categoryTable":
			ajaxHandle(data, "allCategories", displayRows);
			break;
		case "attributesTable":
			ajaxHandle(data, "allAttributes", displayRows);
			break;
		case "productTable":
			ajaxHandle(data, "cmsProducts", displayRows);
			break;
		default:
			break;
	}
}

function deleteTableRow(elem)
{
	var table = document.getElementsByTagName('table')[0];
	var parent = elem.parentNode;
	var id = parent.id.replace("actRow", "");
	var msg;
	var row = elem.parentNode.parentNode;

	switch (table.id)
	{
		case "categoryTable":
			msg = "Doing this will delete the category and all its sub-categories and will orphan the products inside";
			break;
		case "attributesTable":
			msg = "Doing this will delete the custom field preset";
			break;
		case "productTable":
			msg = "Doing this will delete the product; for security reasons please remove related resources (i.e. images) manually";
      break;
		default:
			break;
	}

	var del = confirm(msg);

	var data = {};
	data.id = id;

	if (del === true)
	{
		row.style.transition = "all 1s";
		row.style.opacity = "0";
		
		switch (table.id)
		{
			case "categoryTable":
				data.table = "category";
				data.idName = "cat_id";
				break;
			case "attributesTable":
				data.table = "custom_field";
				data.idName = "id";
				break;
			case "productTable":
				data.table = "product";
				data.idName = "p_id";
        		break;
			default:
				break;
		}
		ajaxHandle("", "deleteRow", rowDeleted, data);
	}
}

function orderRows(target)
{
	var order, direction, type;
	var icon = document.getElementById(target.id + "Icon");

	if (icon.className.indexOf("desc") !== -1) { order = "asc"; direction = "up"; }
	else if (icon.className.indexOf("asc") !== -1) { order = "desc"; direction = "down"; }
	else { order = "asc"; direction = "up"; }

	var data = {};
	switch (target.id)
	{
		case "catParentHead":
			data.field = "parent_name";
			type = "allCategories";
			break;
		case "catNameHead":
			data.field = "cat_name";
			type = "allCategories";
			break;
		case "attrNameHead":
			data.field = "cf_name";
			type = "allAttributes";
			break;
		case "attrTypeHead":
			data.field = "cf_type";
			type = "allAttributes";
			break;
		case "prodNameHead":
			data.field = "p_name";
			type = "cmsProducts";
			break;
		case "prodDescHead":
			data.field = "p_long_desc";
			type = "cmsProducts";
			break;
		case "prodPriceHead":
			data.field = "p_price";
			type = "cmsProducts";
			break;
		case "prodQuantHead":
			data.field = "p_stock_quantity";
			type = "cmsProducts";
			break;
		case "prodCatHead":
			data.field = "cat_name";
			type = "cmsProducts";
			break;
		default:
			break;
	}
	data.order = order;

	var searchTerm = document.getElementById("manageSearch").value.trim();
	if (searchTerm === "") { searchTerm = "%"; }

	data.searchTerm = searchTerm;

	ajaxHandle(data, type, displayRows);
	icon.className = order + " orderIcon fa fa-caret-" + direction;
	changeOrderIconVis(icon);
}

function handleTableClicks(evt)
{
	var target = evt.target;
	var targetClass = target.className;
	var td,text,input;

	if (targetClass.indexOf("parentCatField") !== -1)
	{
		console.log(target.textContent);
	}
	else if (targetClass.indexOf("deleteRow") !== -1)
	{
		deleteTableRow(target);
	}
	else if (targetClass == "orderByHead")
	{
		orderRows(target);
	}
	else if (targetClass.indexOf("prodCatField") !== -1)
	{
		selectProductCategory(target);
	}
	else
	{
		console.log(target.className + "clicked");
	}
}

function selectProductCategory(elem)
{
	elem.innerHTML = "<select id='catDropSelect'></select>";
	var json = {};
	json.field = "cat_name";
	json.order = "asc";
	ajaxHandle(json,"allCategories", populateCatDown);
}

function populateCatDown(categories)
{
	var container = document.getElementById("catDropSelect");
	for (var cat in categories)
	{
		if (categories.hasOwnProperty(cat))
		{
			var opt = document.createElement("option");
			opt.id = "cat" + categories[cat].id;
			opt.value = categories[cat].id;
			opt.textContent = categories[cat].col1;

			container.appendChild(opt);
		}
	}

	document.getElementById("catDropSelect").addEventListener("change", function(evt)
	{
		var json = {};
		json.cid = parseInt(container.options[container.selectedIndex].value);
		json.pid = parseInt(evt.target.parentNode.id.replace("prodCat",""));
		ajaxHandle("","updateProductCat", confirmChange, json);
		container.parentNode.innerHTML = container.options[container.selectedIndex].textContent;
	}, false);
}

function handleFormChange(evt)
{
	var target = evt.target;
	var targetClass = target.className;

	if (targetClass.indexOf("editableField") !== -1)
	{
		var json = {};
		var id = target.id;
		var regEx, updateTable;

		if (targetClass.indexOf("prodNameField") !== -1)
		{
			regEx = new RegExp("^[A-Za-z0-9]{1}[A-Za-z0-9\x20\x26\x22\x27\\.\\+\\-\\*\\/\\,\\(\\)]{0,99}$");
			json.p_name = target.textContent.trim();
		}
		else if (targetClass.indexOf("prodDescField") !== -1)
		{
			regEx = new RegExp("^[A-Za-z0-9]{1}[A-Za-z0-9\x20\x26\x22\x27\\.\\+\\-\\*\\/\\,\\(\\)]+$");
			json.p_long_desc = target.textContent.trim();
		}
		else if (targetClass.indexOf("prodPriceField") !== -1)
		{
			regEx = new RegExp("^[0-9]{1,20}[.]{0,1}[0-9]{0,2}$");
			json.p_price = parseFloat(target.textContent.trim());
		}
		else if (targetClass.indexOf("prodQtyField") !== -1)
		{
			regEx = new RegExp("^[0-9]{1,11}$");
			json.p_stock_quantity = parseInt(target.textContent.trim());
		}
		else if (targetClass.indexOf("catNameField") !== -1)
		{
			regEx = new RegExp("^[A-Za-z0-9]{1}[A-Za-z0-9\x26\x20\x22]{0,49}$");
			json.cat_name = target.textContent.trim();
		}
		else if (targetClass.indexOf("attrNameField") !== -1)
		{
			regEx = new RegExp("^[A-Za-z0-9]{1}[A-Za-z0-9\x20\x28\x29]{0,49}");
			json.cf_name = target.textContent.trim();
		}

		if (target.parentNode.id.indexOf("prodRow") !== -1)
		{
			updateTable = "updateProduct";
			json.id = target.parentNode.id.replace("prodRow", "");
		}
		else if (target.parentNode.id.indexOf("catRow") !== -1)
		{
			updateTable = "updateCategory";
			json.id = target.parentNode.id.replace("catRow", "");
		}
		else if (target.parentNode.id.indexOf("attrRow") !== -1)
		{
			updateTable = "updateAttribute";
			json.id = target.parentNode.id.replace("attrRow", "");
		}

		if (target.textContent.trim().match(regEx))
		{
			console.log("Text: " + target.textContent);
			console.log("passed");
			target.style.border = "";
			document.getElementById("tableStatus").className = "hideStatus";
			ajaxHandle("",updateTable, confirmChange, json);
		}
		else 
		{
			console.log("failed");
			target.style.border = "2px solid red";
			target.style.borderRadius = "2px";
			document.getElementById("tableMsg").innerHTML = "Fields with a red border contain invalid characters and have not updated";
			document.getElementById("tableStatus").className = "showStatus";
		}
	}
}

function manageSearch()
{
	var searchTerm = document.getElementById("manageSearch").value.trim();
	if (searchTerm === "") { searchTerm = "%"; }
	
	var data = findOrdering();
	data.searchTerm = searchTerm;

	var table = document.getElementsByTagName("table")[0].id;
	var query;

	switch (table)
	{
		case "attributesTable":
			query = "allAttributes";
			break;
		case "categoryTable":
			query = "allCategories";
			break;
		case "productTable":
			query = "cmsProducts";
			break;
		default:
			break;
	}

	ajaxHandle(data, query, displayRows);
}

function createList(listNodeItem, container)
{
	var listItem = document.createElement("li");
		listItem.id = "treeCat" + listNodeItem.id;

		var catRadio = document.createElement("input");
		catRadio.type = "radio";
		catRadio.name = "selectedCat";
		catRadio.id = "parentCat" + listNodeItem.id;
		catRadio.value = listNodeItem.id;

		var catLabel = document.createElement("label");
		catLabel.htmlFor = "parentCat" + listNodeItem.id;
		catLabel.textContent = listNodeItem.name;

		var icon = document.createElement("i");
		icon.className = "icon fa fa-folder";
		icon.id = "catNode" + listNodeItem.id;

		var subCatList = document.createElement("ul");
		subCatList.id = "subCatList" + listNodeItem.id;

		listItem.appendChild(icon);
		listItem.appendChild(catRadio);
		listItem.appendChild(catLabel);
		listItem.appendChild(subCatList);
		container.appendChild(listItem);
}

function displaySubCats(result)
{
	var parent, 
		key, 
		container;

	for (var id in result)
	{
		if (result.hasOwnProperty(id)) {
			parent = result[id];
			key = id;
			break;
		}
	}
	
	container = document.getElementById("subCatList" + key);
	container.innerHTML = "";

	for (var obj in parent)
	{
    if (parent.hasOwnProperty(obj))
    {
        createList(parent[obj], container);    
    }
	}
}

function iconClickHandle(targetId) 
{

	var target = document.getElementById(targetId);
	var targetClass = target.className;
	var catId = targetId.replace("catNode", "");
	var container = document.getElementById("subCatList" + catId);

	if (targetClass.indexOf("open") != -1)
	{
		target.className = targetClass.replace("folder-open", "folder");
		console.log("closing node");
		container.className = "hideList";
	}
	else if (targetClass.indexOf("folder") != -1)
	{
		target.className = targetClass.replace("folder", "folder-open");
		console.log("opening node");
		ajaxHandle(catId, "subCatTree", displaySubCats);
		container.className = "showList";
	}
}

function populateCustomDropdown(options)
{
	var elems = Array.prototype.slice.call(document.getElementsByClassName("selectOpt"));
	var container;

	for (var i = 0; i < elems.length; i++)
	{
		console.log(elems[i]);
		if (elems[i].className.indexOf("option") !== -1)
		{
			container = elems[i];
			break;
		}
	}

	for (var opt in options)
	{
		var option = document.createElement("option");
		option.value = options[opt].value;
		option.text = options[opt].name;

		container.appendChild(option);
	}
}

function addDataFields(fieldType)
{
	var container = document.getElementById("metaContainer");
	var exists = true;
	var field = 1;
	var preset = document.getElementById("metaPreset");
	var type = preset.options[preset.selectedIndex].dataset.type;
  
	while (exists === true)
	{
		if (!document.getElementById('name' + field))
		{
			exists = false;

			var keyVal = document.createElement("div");
			keyVal.className = "keyValueGroup";

			var fg1 = document.createElement("div");
			fg1.className = "formGroup";

			var msg1 = document.createElement("div");
			msg1.className = "hideStatus";
			msg1.id = "name" + field + "Msg";
			msg1.innerHTML = "<p class='status error validateMsg'></p>";

			var label1 = document.createElement("label");
			label1.htmlFor = "name" + field;
			label1.textContent = "Name:";

			var input1 = document.createElement("input");
			input1.type = "text";
			input1.id = "name" + field;
			input1.className = "metaName";
			input1.pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9\(\)\x20\x22]{0,99}$";
			input1.dataset.pat = "Letters, numbers, parentheses, quotes";
			if (fieldType !== "normal") { 
				var name = preset.options[preset.selectedIndex].text;
				input1.value = name; 
			}

			fg1.appendChild(msg1);
			fg1.appendChild(label1);
			fg1.appendChild(input1);

			var fg2 = document.createElement("div");
			fg2.className = "formGroup";

			var msg2 = document.createElement("div");
			msg2.className = "hideStatus";
			msg2.id = "value" + field + "Msg";
			msg2.innerHTML = "<p class='status error validateMsg'></p>";

			var label2 = document.createElement("label");
			label2.htmlFor = "value" + field;
			label2.textContent = "Value:"

			var input2;
			console.log(type);

			if (type == "Dropdown")
			{
				input2 = document.createElement("select");
				input2.className = "metaValue " + "selectOpt " + "option" + preset.options[preset.selectedIndex].value;
				preset.options[preset.selectedIndex].disabled = true;
				ajaxHandle(preset.options[preset.selectedIndex].value, "getPresets", populateCustomDropdown);
				preset.selectedIndex = 0;
			}
			else
			{

				input2 = document.createElement("input");
				if (fieldType == "normal") { 
					input2.type = "text"; 
					input2.pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9.\(\)\x20\x22]{0,99}$";
					input2.dataset.pat = "Letters, numbers, parentheses, quotes";
				}
				else 
				{
					var min = preset.options[preset.selectedIndex].dataset.minnum;
					var max = preset.options[preset.selectedIndex].dataset.maxnum;
					var letters = preset.options[preset.selectedIndex].dataset.letters;

					switch (type)
					{
						case "Decimal":
							input2.type = "number";
							input2.min = min;
							input2.max = max;
							input2.step = "any";
							input2.dataset.type = "Decimal";
							break;
						case "Integer":
							input2.type = "number";
							input2.min = min;
							input2.max = max;
							input2.dataset.type = "Integer";
							break;
						case "Date":
							input2.type = "date";
							break;
						case "Boolean":
							input2.type = "checkbox";
							break;
						default:
							input2.type = "text";
							if (letters == "1")
							{
								input2.pattern = "[a-zA-Z]{1,500}";
								input2.dataset.pat = "Letters only";
							}
							else
							{
								input2.pattern = "^[A-Za-z0-9]{1}[A-Za-z0-9.\(\)\x20\x22]{0,99}$";
								input2.dataset.pat = "Letters, numbers, parentheses, quotes";
							}
							break;
					}
				}

				input2.className = "metaValue";
			}

			input2.id = "value" + field;

			fg2.appendChild(msg2);
			fg2.appendChild(label2);
			fg2.appendChild(input2);

			keyVal.appendChild(fg1);
			keyVal.appendChild(fg2);

			container.appendChild(keyVal);
		}
	
	field++;

	}
}

function populatePresets(presets) 
{
	var dropdown = document.getElementById("metaPreset");

	for (var preset in presets)
	{
		var opt = document.createElement("option");
		opt.value = presets[preset].id;
		opt.text = presets[preset].name;
		opt.dataset.type = presets[preset].cfType;
		opt.dataset.minnum = presets[preset].min;
		opt.dataset.maxnum = presets[preset].max;
		opt.dataset.letters = presets[preset].letters;

		dropdown.appendChild(opt);
	}
}

function showSummary(summary)
{
	var container = document.getElementById("cmsOverviewText");

	container.innerHTML = "<strong>Products</strong><ul><li><strong>" + summary["products"] + "</strong> item(s) in catalogue</li><li><strong>" + summary["lowstock"] + "</strong> item(s) with low stock (>10)</li><li><strong>" + summary["nostock"] + "</strong> item(s) out of stock</li></ul>";
	container.innerHTML += "<strong>Categories</strong><ul><li>Your shop has <strong>" + summary["parents"] + "</strong> departments (top level categories)</li><li>Your shop has <strong>" + (summary["cats"] - summary["parents"]) + "</strong> sub-categories</li></ul>";
}

function initialiseCMS() 
{
	associateLabels();
	var elem = null;

	document.querySelector("body").addEventListener("keydown", function(evt)
	{
		if (evt.keyCode == 13) 
		{        
			console.log("Enter hit");
			evt.cancelBubble = true;
			return false;
        }
	}, false);

	//if (elem = document.getElementById("itemCategory") || document.getElementById("parentCat"))
	//{
	//	ajaxGet(0, "categories", displayCategoryRoot);
	//}

	if (elem = document.getElementById("cmsOverviewText"))
	{
		ajaxHandle("", "getSummary", showSummary)
	}

	if (elem = document.getElementsByTagName("table")[0])
	{  
		var type;

		document.querySelector("table").addEventListener("click", function(evt) { handleTableClicks(evt); }, false);
		document.querySelector("table").addEventListener("input", function(evt) { handleFormChange(evt); }, false);
		
		var data = {};
		var searchTerm = document.getElementById("manageSearch").value.trim();
		if (searchTerm === "") { searchTerm = "%"; }
		data.order = "asc";

		switch (elem.id)
		{
			case "categoryTable":
				data.field = "cat_name";
				type = "allCategories";
				break;
			case "attributesTable":
				data.field = "cf_name";
				type = "allAttributes";
				break;
			case "productTable":
				data.field = "p_name";
				type = "cmsProducts";
				break;
			default:
				break;
		}
		
		ajaxHandle(data, type, displayRows);
	}

	if (elem = document.getElementById("metaContainer")) 
	{
		document.getElementById("addMeta").addEventListener("click", function(evt) { addDataFields("normal"); }, false);
		document.getElementById("addPreset").addEventListener("click", function(evt) { addDataFields("preset"); }, false);

		ajaxHandle("","getPresets", populatePresets);
	}	

	if (elem = document.getElementById("attrType"))
	{
		addMoreAttr();
		elem.addEventListener("change", addMoreAttr, false);
	}

	if (elem = document.getElementById("addExImages"))
	{
		elem.addEventListener("click", addImages, false);
	}

	if (elem = document.getElementById("addItem"))
	{
		document.querySelector('form').addEventListener('change', function(evt) {
			//sendData(evt);
			var target = evt.target;
			var targetClass = target.className;
			targetClass = targetClass.split(" ")[0];
			var targetId = target.id;
			var targetName = target.name;

			switch (targetClass) 
			{
				case "upFile":
					validateInput(target);
					imageUpload(targetId);
					break;
				default:
					if (targetName === "selectedCat") { validateRadioButtons(document.getElementsByName(targetName)); }
					console.log("Handle other changes to form...");
					break;
			}
		}, false);
	}

	if (elem = document.getElementsByTagName("form")[0])
	{
		document.querySelector("body").addEventListener("input", function(evt) {
			var target = evt.target;
			var targetTag = target.tagName.toLowerCase();

			switch (targetTag)
			{
				case "input":
				case "textarea":
					validateInput(target);
					break;
				default:
					break;
			}	
		}, false);
	}

	try {

		document.getElementById("manageSearch").addEventListener("input", function(evt) { manageSearch(evt); }, false);

	}
	catch (err) { console.log (""); }

	try {
		document.querySelector("body").addEventListener("click", function(evt) {
			
			var targetId = evt.target.id;
			var targetElement = evt.target;
			var targetClass = evt.target.className;
			var parentForm = targetElement.parentNode.parentNode;
			targetClass = targetClass.split(" ")[0];

			switch (targetClass)
			{
				case "icon":
					iconClickHandle(targetId);
					break;
				case "formButton":
					if (targetElement.id == "formCancel")
					{
						evt.preventDefault();
						var response = confirm("Any unsaved changes will be lost. Proceed?");
						if (response === true)
						{
							window.location.href = "/660273/cms/";
						}				
					}
					else if (targetElement.id == "formSave")
					{
						evt.preventDefault();
						saveForm(parentForm);
					}
					break;
				default:
					break;
			}
			switch (targetId)
			{
				case "shopHomeLink":
					window.location.href = "/660273/";
					break;
				case "cmsHomeLink":
					window.location.href = "/660273/cms";
					break;
				case "addCategoryLink":
					window.location.href = "/660273/cms/addcategory";
					break;
				case "addProductLink":
					window.location.href = "/660273/cms/addproduct";
					break;
				case "addAttributeLink":
					window.location.href = "/660273/cms/addattribute";
					break;
				case "manageCategoriesLink":
					window.location.href = "/660273/cms/managecategories";
					break;
				case "manageProductsLink":
					window.location.href = "/660273/cms/manageproducts";
					break;
				case "manageAttributesLink":
					window.location.href = "/660273/cms/manageattributes";
					break;
				default:
					break;
			}
			console.log(targetId);

		}, false);
	}
	catch (err)	{ console.log ("Not a form"); }
}

function disableEnter(evt)
{
     var elem = evt.target;
     if ((evt.keyCode == 13) && (elem.type == "text"))
     {
       return false; 
     }
}

document.onkeypress = disableEnter;

window.addEventListener("load", initialiseCMS, false);