function addImages()
{
	var exists = true;
	var img = 1;
	var addedImages = document.getElementById('addedImages');
	var maxWarn = document.getElementById('maxWarning');

	while (exists == true)
	{
		if (img > 5) {
			exists = false;
			console.log("Show Max. 5 images notification");
			maxWarn.className = "showStatus";
			setTimeout(function(){
				maxWarn.className = "hideStatus";
			}, 3000);
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
				validMsg.className = "status error validateMsg" 

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

function checkValidDifference()
{
	var min = parseFloat(document.getElementById("attrMin").value);
	var max = parseFloat(document.getElementById("attrMax").value);
	var container = document.getElementById("minMaxDif");

	if (min > max && !isNaN(min) && !isNaN(max))
	{
		container.className = "showStatus";
		document.getElementById("attrMin").style.border = "1px solid red";
		document.getElementById("attrMax").style.border = "1px solid red";
		return false;
	}
	else
	{
		container.className = "hideStatus";
		document.getElementById("attrMin").style.border = "";
		document.getElementById("attrMax").style.border = "";
		return true;
	}
}

function addDropOptions()
{
	var container = document.getElementById("dropOptions");
	var exists = true;
	var opt = 1;

	while (exists == true)
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
			titleLabel.innerText = "Name:";

			var titleInput = document.createElement("input");
			titleInput.type = "text";
			titleInput.id = "dropTitle" + opt;
			titleInput.name = "dropTitle" + opt;
			titleInput.className = "addAttrInput";

			var valueLabel = document.createElement("label");
			valueLabel.htmlFor = "dropValue" + opt;
			valueLabel.innerText = "Value:";

			var valueInput = document.createElement("input");
			valueInput.type = "text";
			valueInput.id = "dropValue" + opt;
			valueInput.name = "dropValue" + opt;
			valueInput.className = "addAttrInput";

			div1.appendChild(titleLabel);
			div1.appendChild(titleInput);
			div2.appendChild(valueLabel);
			div2.appendChild(valueInput);
			group.appendChild(div1);
			group.appendChild(div2);
			container.appendChild(group);
		}
		opt++;
	}
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
		catLabel.innerText = listNodeItem.name;

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
		case "text":
			console.log(selected);
			moreAttr.innerHTML = '<div class="hideStatus" id="attrLetMsg"><p class="status error validateMsg"></p></div>' +
								'<label for="attrLet">Letters Only:</label>';
			moreAttr.innerHTML += '<input type="checkbox" id="attrLet" name="attrLet" class="addAttrInput">';
			break;
		case "date":
			moreAttr.innerHTML = '';
			console.log(selected);
			break;
		case "int":
			moreAttr.innerHTML = '<div class="hideStatus" id="attrMaxMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMax">Maximum:</label>' +
								'<input type="number" id="attrMax" name="attrMax" class="addAttrInput" data-type="Integer" data-step="Integer" max="2147483647" min="-2147483648"></div>';
			moreAttr.innerHTML += '<div class="hideStatus" id="attrMinMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMin">Minimum:</label>' +
								'<input type="number" id="attrMin" name="attrMin" class="addAttrInput" data-type="Integer" data-step="Integer" max="2147483647" min="-2147483648"></div>';
			
			document.getElementById("attrMin").addEventListener("change", function(evt) { validateInput(evt.target); }, false);
			document.getElementById("attrMax").addEventListener("change", function(evt) { validateInput(evt.target); }, false);
			console.log(selected);
			break;
		case "dec":
			moreAttr.innerHTML = '<div class="hideStatus" id="attrMaxMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMax">Maximum:</label>' +
								'<input type="number" id="attrMax" name="attrMax" class="addAttrInput" data-type="Decimal" step="any"></div>';
			moreAttr.innerHTML += '<div class="hideStatus" id="attrMinMsg"><p class="status error validateMsg"></p></div>' +
								'<div class="formGroup"><label for="attrMin">Minimum:</label>' +
								'<input type="number" id="attrMin" name="attrMin" class="addAttrInput" data-type="Decimal" step="any"></div>';
			
			document.getElementById("attrMin").addEventListener("change", function(evt) { validateInput(evt.target); }, false);
			document.getElementById("attrMax").addEventListener("change", function(evt) { validateInput(evt.target); }, false);
			console.log(selected);
			break;
		case "bool":
			moreAttr.innerHTML = "";
			console.log(selected);
			break;
		case "drop":
			moreAttr.innerHTML = '<div class="dropOptions" id="dropOptions"><div class="formGroup dropGroup" id="optGroup1">' +
								'<div><div class="hideStatus" id="dropTitle1"><p class="status error validateMsg"></p></div>' +
								'<label for="dropTitle1">Name:</label><input type="text" id="dropTitle1" name="dropTitle1" class="addAttrInput"></div>' +
								'<div><div class="hideStatus" id="dropValue1"><p class="status error validateMsg"></p></div>' +
								'<label for="dropValue1">Value:</label><input type="text" id="dropValue1" name="dropValue1" class="addAttrInput"></div></div></div>' +
								'<button type="button" class="addDropOpt" id="addDropOpt">Add Dropdown Options</button>';
			document.getElementById("addDropOpt").addEventListener("click", addDropOptions, false);
			console.log(selected);
			break;
		default: break;
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
		createList(parent[obj], container);
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

function formSubmittedCallback(result)
{

}

function sendData(form)
{
	var i, fd = new FormData;
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

function validateForm(form)
{	
	var group, radioValid = true;
	if (group = document.getElementsByName("selectedCat"))
	{
		if (!validateRadioButtons(group)) { radioValid = false; }
		console.log(radioValid);
	}
	var inputs = Array.prototype.slice.call(form.getElementsByTagName("input")),
		textareas = Array.prototype.slice.call(form.getElementsByTagName("textarea")),
		selects = Array.prototype.slice.call(form.getElementsByTagName("select"));

	var elems = inputs.concat(textareas).concat(selects);
	var validArr = new Array();
	var i;

	for (i = 0; i < elems.length; i++)
	{
		var elem = elems[i];
		console.log(elem);
		validArr[i] = validateInput(elem);
	}

	for (i = 0; i < validArr.length; i++)
	{
		if (validArr[i] == false) { return false; }
	}

	return radioValid && true;
}

function validateRadioButtons(group)
{
	var valid = false;
	var i = 0;
	var warning = document.getElementById("selectedCatMsg");
	var msg = warning.getElementsByTagName("p")[0];
	var container = document.getElementById("parentCat");

	while (!valid && i < group.length)
	{
		if (group[i].checked) { valid = true; }
		i++;	
	}

	if (!valid)
	{
		container.style.border = "1px solid red";
		msg.innerHTML = "<strong>Category</strong> is a required field";
		warning.className = "showStatus";
	}
	else 
	{
		container.style.border = "";
		warning.className = "hideStatus";
	}
	return valid;
}

function associateLabels()
{
	var labels = document.getElementsByTagName("label");

	for (var i = 0; i < labels.length; i++)
	{
		var element = document.getElementById(labels[i].htmlFor);
		if (element) { element.label = labels[i]; }
	}
}

function validateInput(elem)
{
	associateLabels();

	if (elem.name === "exImgFile") { return true; }

	var tag = elem.tagName.toLowerCase();
	var warning = (elem.type != "radio" ? document.getElementById(elem.id + "Msg") : document.getElementById(elem.name + "Msg"));
	var warningMsg = warning.getElementsByTagName("p")[0];
	var startChar = elem.value.charAt(0);
	var endChar = elem.value.charAt(elem.value.length - 1);
	var valid = true;
	var fieldName;

	if ((tag === "input" || tag === "select" || tag === "textarea") && elem.type !== "radio" )
	{
		if (elem.type !== "radio"){ fieldName = elem.label.innerHTML.replace(":", ""); }
		if (elem.validity.typeMismatch)	{ warningMsg.innerHTML = "Please match the expected type"; }
		if (elem.validity.valueMissing)	{ warningMsg.innerHTML = "<strong>" + fieldName + "</strong> is a required field"; }
		if (tag === "input" && (startChar == "&" || startChar == '"')) 
		{
			warningMsg.innerHTML = "<strong>" + fieldName + "</strong> cannot start with <strong>" + startChar + "</strong>"; 
		} 
		else if (tag === "input" && endChar === "&")
		{
			warningMsg.innerHTML = "<strong>" + fieldName + "</strong> cannot end with <strong>" + endChar + "</strong>";
			valid = false;
		}
		else if (elem.validity.patternMismatch)
		{
			warningMsg.innerHTML = "Permitted Characters: <strong>" + elem.dataset.pat + "</strong>";
		}
		if (elem.validity.rangeUnderflow) { warningMsg.innerHTML = "Value must be at least <strong>" + elem.min + "</strong>"; }
		if (elem.validity.rangeOverflow) { warningMsg.innerHTML = "Value must not be more than <strong>" + elem.max + "</strong>"; }
		if (elem.validity.stepMismatch) { warningMsg.innerHTML = "You must enter an <strong>" + elem.dataset.step + "</strong>"; }
		if (elem.validity.badInput) { warningMsg.innerHTML = "The correct input type is: <strong>" + elem.dataset.type + "</strong>"; }

		if (elem.checkValidity() && valid) 
		{
			if ((elem.id === "attrMax" || elem.id === "attrMin") && !checkValidDifference())
			{
				warning.className = "hideStatus";
				console.log("Invalid Dif");
				return false;
			}
			else 
			{
				warning.className = "hideStatus";
				elem.style.border = "";
				return true;
			}
		}
		else
		{
			warning.className = "showStatus"; 
			elem.style.border = "1px solid red";
			return false;
		}
	}
}

function saveForm(parentForm)
{
	if (validateForm(parentForm)) { 
		document.getElementById("formSave").disabled = true;
		sendData(parentForm);
	}
}

function displayCatRows(result)
{
	console.log(result);
	var delImg = "<img class='delIcon' src='../../img/delete.svg' alt='Delete Row'>Delete";

	var catTable = document.getElementById("catTableBody");
	catTable.innerHTML = "";

	var topLevelIt = 0;

	if (JSON.stringify(result) === "{}") { catTable.innerHTML = "<p>No Results Found.</p>"; }
	else
	{
		for (var obj in result)
		{
			var row = document.createElement("tr");
			row.id = "catRow" + result[obj].id;

			var catName = document.createElement("td");
			catName.innerText = result[obj].name;
			catName.contentEditable = true;
			catName.className = "tableField catNameField";
			catName.id = "catName" + result[obj].id;

			var parentName = document.createElement("td");
			if (result[obj].parent == "")
			{
				parentName.innerHTML = "<em>--Top Level Parent--</em>";
				parentName.id = "parentNameTop" + topLevelIt;
				topLevelIt++;
			}
			else 
			{
				parentName.innerText = result[obj].parent;
				parentName.className = "parentCatField tableField";
				parentName.id = "parentName" + result[obj].parentId;
			}	

			var action = document.createElement("td");
			action.className = "deleteRow";
			action.id = "delCat" + result[obj].id;
			action.innerHTML = delImg;

			row.appendChild(catName);
			row.appendChild(parentName);
			row.appendChild(action);
			catTable.appendChild(row);
		}
	}
}

function confirmChange(result)
{
	console.log("updated");
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
			var order = (icons[i].className.indexOf("up") !== -1 ? "asc" : "desc");
			var field = icons[i].id.replace("HeadIcon", "");
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
		default:
			break;
	}

	var data = {};
	data["field"] = field;
	data["order"] = order;

	return data;
	
}

function rowDeleted(result)
{
	var table = document.getElementsByTagName('table')[0].id;
	var data = findOrdering();

	switch (table)
	{
		case "categoryTable":
			ajaxHandle(data, "allCategories", displayCatRows);
			break;
		default:
			break;
	}
}

function deleteTableRow(elem)
{
	var table = document.getElementsByTagName('table')[0];
	var del = confirm("This will delete the category and all of its sub categories");
	var data = {};
	if (del == true)
	{
		switch (table.id)
		{
			case "categoryTable":
				var id = elem.id.replace("delCat", "");
				data["table"] = "category";
				data["id"] = id;
				data["idName"] = "cat_id";
				break;
			default:
				break;
		}
		ajaxHandle("", "deleteRow", rowDeleted, data);
	}
	else 
	{
		alert("NOPE");
	}
}


function handleTableClicks(evt)
{
	var target = evt.target;
	var targetClass = target.className;

	if (targetClass.indexOf("parentCatField") !== -1)
	{
		console.log(target.innerText);
	}
	else if (targetClass.indexOf("deleteRow") !== -1)
	{
		deleteTableRow(target);
	}
	else if (targetClass == "orderByHead")
	{
		var order, direction;
		var icon = document.getElementById(target.id + "Icon");

		if (icon.className.indexOf("desc") !== -1) { order = "asc"; direction = "up"; }
		else if (icon.className.indexOf("asc") !== -1) { order = "desc"; direction = "down"; }
		else { order = "asc"; direction = "up"; }

		var data = {};
		switch (target.id)
		{
			case "catParentHead":
				data["field"] = "parent_name";
				break;
			case "catNameHead":
				data["field"] = "cat_name";
				break;
			default:
				break;
		}
		data["order"] = order;

		ajaxHandle(data, "allCategories", displayCatRows);
		icon.className = order + " orderIcon fa fa-caret-" + direction;
		changeOrderIconVis(icon);
	}
	else
	{
		console.log(target.className + "clicked");
	}
}

function handleFormChange(evt)
{
	var target = evt.target;
	var targetClass = target.className;

	if (targetClass.indexOf("catNameField") !== -1)
	{
		var json = {};
		json["id"] = target.id.replace("catName", "");

		var RE = new RegExp("^[A-Za-z0-9]{1}[A-Za-z0-9\x20\x26\x22\x27]{0,49}$");

		if (target.innerText.trim().match(RE))
		{
			console.log("Text: " + target.innerText);
			console.log("passed");
			target.style.border = "";
			document.getElementById("catTableStatus").className = "hideStatus";
			json["cat_name"] = target.innerText.trim();
			ajaxHandle("","updateCategory", confirmChange, json);
		}
		else 
		{
			console.log("failed");
			target.style.border = "2px solid red";
			target.style.borderRadius = "2px";
			document.getElementById("catTableMsg").innerHTML = "Fields with a red border contain invalid characters and have not updated";
			document.getElementById("catTableStatus").className = "showStatus";
		}
	}
}

function searchCategories()
{
	var searchTerm = document.getElementById("catSearch").value.trim();
	if (searchTerm === "") { searchTerm = "%"; }
	var data = findOrdering();
	data["searchTerm"] = searchTerm;

	ajaxHandle(data, "allCategories", displayCatRows);
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

	if (elem = document.getElementById("categoryTable"))
	{  
		var data = {};
		data["field"] = "cat_name";
		data["order"] = "asc";
		ajaxHandle(data, "allCategories", displayCatRows);
		document.querySelector("table").addEventListener("click", function(evt) { handleTableClicks(evt); }, false);
		document.querySelector("table").addEventListener("input", function(evt) { handleFormChange(evt); }, false)
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
			var targetTag = target.tagName;
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
		document.querySelector("body").addEventListener("keyup", function(evt) {
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
		document.getElementById("cmsSearchBtn").addEventListener("mouseover", function(evt) {
			document.getElementById("searchIcon").style.fill = "#ffffff";
		},false);

		document.getElementById("cmsSearchBtn").addEventListener("mouseleave", function(evt) {
			document.getElementById("searchIcon").style.fill = "#cccccc";
		},false);

		document.getElementById("cmsSearchBtn").addEventListener("click", function(evt) { searchCategories(evt); }, false);

	}
	catch (err) { console.log ("")}

	try {
		document.getElementById("catSearch").addEventListener("keypress", function(evt) 
		{
			if (evt.keyCode == 13) { searchCategories(evt); }
		}, false);
	}
	catch (err) {}


	try {
		document.getElementById("formSave").addEventListener("mouseover", function(evt) {
			document.getElementById("saveIcon").style.fill = "#ffffff";
		},false);

		document.getElementById("formSave").addEventListener("mouseleave", function(evt) {
			document.getElementById("saveIcon").style.fill = "#cccccc";
		},false);	

		document.getElementById("formCancel").addEventListener("mouseover", function(evt) {
			document.getElementById("cancelIcon").style.fill = "#ffffff";
		},false);

		document.getElementById("formCancel").addEventListener("mouseleave", function(evt) {
			document.getElementById("cancelIcon").style.fill = "#cccccc";
		},false);

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
					evt.preventDefault();
					if (targetElement.id == "formCancel")
					{
						var response = confirm("Any unsaved changes will be lost. Proceed?");
						if (response == true)
						{
							window.location.href = "/660273/cms/";
						}				
					}
					else if (targetElement.id == "formSave")
					{
						saveForm(parentForm);
					}
					break;
				default:
					break;
			}
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