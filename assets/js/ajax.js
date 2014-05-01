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
				else { fd.append(elem.id, elem.value); console.log(elem.id, elem.value); }
		}
	}

	ajaxHandle("",queryType, formSubmittedCallback, fd);
}

function ajaxHandle (getData, queryType, callback, sendData) {
	var phpRes, getArgument, container,	reqMethod, fileString, getArgString, form, cms, formSubmit, updating, ordering, field, order, searchTerm;

	console.log(queryType);

	switch (queryType) 
	{
		case "productDetail":
			phpRes = "db_query_product.php";
			getArgument = "product";
			reqMethod = "GET";
			break;
		case "products":
			container = document.getElementById("products");
			phpRes = "db_query_products.php";
			getArgument = "category";
			reqMethod = "GET";
			break;
		case "cmsProducts":
			container = document.getElementById("products");
			phpRes = "db_query_products.php";
			getArgument = "category";
			reqMethod = "GET";
			field = getData.field;
			order = getData.order;
			searchTerm = (getData.hasOwnProperty("searchTerm") ? getData.searchTerm : "%");
			ordering = true;
			break;
		case "subCatTree":
		case "categories":
			phpRes = "db_query_categories.php";
			getArgument = "category";
			reqMethod = "GET";
			var id = getData;
			break;
		case "allCategories":
			phpRes = "db_query_all_categories.php";
			reqMethod = "GET";
			field = getData.field;
			order = getData.order;
			searchTerm = (getData.hasOwnProperty("searchTerm") ? getData.searchTerm : "%");
			ordering = true;
			break;
		case "addCategory":
			phpRes = "db_add_category.php";
			formSubmit = true;
			cms = true;
			document.getElementById("catNode0").className = "icon fa fa-folder";
			document.getElementById("subCatList0").innerHTML = "";
			break;
		case "allAttributes":
			phpRes = "db_query_all_attributes.php";
			reqMethod = "GET";
			field = getData.field;
			order = getData.order;
			searchTerm = (getData.hasOwnProperty("searchTerm") ? getData.searchTerm : "%");
			ordering = true;
			break;
		case "addAttribute":
			phpRes = "db_add_attribute.php";
			formSubmit = true;
			cms = true;
			break;
		case "addItem":
			phpRes = "db_add_product.php";
			formSubmit = true;
			cms = true;
			break;
		case "updateCategory":
			phpRes = "db_update_category.php";
			updating = true;
			break;
		case "updateProduct":
			phpRes = "db_update_product.php";
			updating = true;
			break;
		case "updateAttribute":
			phpRes = "db_update_attribute.php";
			updating = true;
			break;
		case "deleteRow":
			phpRes = "db_delete_row.php";
			reqMethod = "DELETE";
			break;
		case "addCustomerOrder":
			phpRes = "db_add_customer_order.php";
			formSubmit = "POST";
			break;
		case "order":
			phpRes = "db_query_order.php";
			getArgument = "order";
			reqMethod = "GET";
			break;
		case "productImages":
			phpRes = "db_query_image.php";
			getArgument = "id";
			reqMethod = "GET";
			break;
		case "getPresets":
			phpRes = "db_query_presets.php";
			getArgument = "id";
			reqMethod = "GET";
			break;
		case "getSummary":
			phpRes = "db_query_count.php";
			getArgument = "";
			reqMethod = "GET";
			break;
		case "getOrders":
			phpRes = "db_get_orders.php";
			getArgument = "";
			reqMethod = "GET";
			break;
		case "updateOrder":
			phpRes = "db_update_order.php";
			updating = true;
			break;
		case "orderProducts":
			phpRes = "db_query_order_products.php";
			reqMethod = "GET";
			getArgument = "order";
			break;
		case "updateProductCat":
			phpRes = "db_update_product_category.php";
			updating = true;
			console.log(sendData.cid, sendData.pid);
			break;
		default:
			console.log("Functionality for this query is not built into the ajax query function");
			break;
	}

	if (formSubmit) { reqMethod = "POST"; }
	else if (updating) { reqMethod = "PATCH"; }

	var xhr = new XMLHttpRequest();

	if (reqMethod == "GET")
	{
		xhr.addEventListener("progress", updateProgress, false);
	}
	else
	{
		xhr.upload.addEventListener("loadstart", loadStartHandle, false);
		xhr.upload.addEventListener("progress", uploadUpdateProgress, false);
	}
	
	xhr.addEventListener("load", contentLoaded, false);
	xhr.addEventListener("error", contentFail, false);

	function contentLoaded() {
		console.log(xhr.responseText);
		try {
			var result = xhr.responseText;
			var jsonResult = JSON.parse(result);

			if (queryType === "subCatTree")
			{
				var parent = '{"' + id + '":';
				jsonResult = JSON.parse(parent.concat(result) + "}");
			}
		}
		catch (err)
		{
			if (cms)
			{
				var progress = document.getElementById("submitProgress");
				progress.style.width = "100%";
				progress.style.background = "red";
				progress.innerHTML = "Something went wrong, please try again.";
				document.getElementById("formSave").disabled = false;
			}	
			jsonResult = JSON.parse('{"result":"failed"}');
		}
			
		callback(jsonResult);
	}

	function contentFail() {
		if (cms)
		{
			var progress = document.getElementById("submitProgress");
			progress.style.width = "100%";
			progress.style.background = "red";
			progress.innerHTML = "Something went wrong, please try again.";
			document.getElementById("formSave").disabled = false;
		}
	}

	function uploadUpdateProgress(evt)
	{
		console.log(queryType + ": " + Math.round((evt.loaded / evt.total) * 100));
		var progress = Math.round((evt.loaded / evt.total) * 100);

		if (cms)
		{
			var containerWidth = document.getElementById("submitResult").offsetWidth;
			var progWidth = (progress / containerWidth) * 100;
			console.log(progWidth);
			document.getElementById("submitProgress").style.width = progWidth + "px";
		}
	}

	function loadStartHandle()
	{
		try {
			loadStart();
		}
		catch (err)
		{
			console.log("loadStart function does not exist");
		}
	}
	
	function updateProgress(evt) {
		console.log(queryType + ": " + Math.round((evt.loaded / evt.total) * 100));
		var progress = Math.round((evt.loaded / evt.total) * 100);
    
    console.log(progress);
	}
	
	if (queryType === "products")
	{
		container.innerHTML = "<div><img class='centered' id='loader' src='/660273/img/loader.gif' alt='Loading'></div>";
	}

	if (reqMethod == "GET")	
	{
		if (ordering === true) { getArgString = "?field=" + field + "&order=" + order + "&search=" + searchTerm; }
		else { getArgString = "?" + getArgument + "=" + getData; }
		console.log(getArgString);

		fileString = "/660273/assets/db/" + phpRes + getArgString;

		console.log(fileString);
	}
	else
	{
		fileString = "/660273/assets/db/" + phpRes; 
	}

	console.log(fileString);
	//console.log(queryString);
	xhr.open(reqMethod, fileString, true);

	if (reqMethod != "GET") 
	{ 
		if (formSubmit) { xhr.send(sendData); }
		else { xhr.send(JSON.stringify(sendData)); }
	}
	else 
	{ 
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send();
	}
	
}
