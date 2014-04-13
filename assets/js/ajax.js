function ajaxHandle (getData, queryType, callback, sendData) {
	var phpRes,
	 	getArgument, 
	 	container,	
	 	reqMethod, 
	 	fileString, 
	 	form, 
	 	formSubmit,
	 	updating;

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
		case "subCatTree":
		case "categories":
			phpRes = "db_query_categories.php";
			getArgument = "category";
			reqMethod = "GET";
			var id = getData;
			break;
		case "allCategories":
			phpRes = "db_query_all_categories.php";
			getArgument = "category";
			reqMethod = "GET";
			var field = getData["field"];
			var order = getData["order"];
			var searchTerm = (getData.hasOwnProperty("searchTerm") ? getData["searchTerm"] : "%");
			break;
		case "addCategory":
			phpRes = "db_add_category.php";
			formSubmit = true;
			document.getElementById("catNode0").className = "icon fa fa-folder";
			document.getElementById("subCatList0").innerHTML = "";
			break;
		case "addAttribute":
			phpRes = "db_add_attribute.php";
			formSubmit = true;
			break;
		case "addItem":
			phpRes = "db_add_product.php";
			formSubmit = true;
			break;
		case "updateCategory":
			phpRes = "db_update_category.php";
			updating = true;
			break;
		case "deleteRow":
			phpRes = "db_delete_row.php";
			reqMethod = "DELETE";
			break;
		default:
			console.log("Functionality for this query is not built into the ajax query function");
			break;
	}

	if (formSubmit)
	{
		reqMethod = "POST";
		form = document.getElementsByTagName("form")[0];
		container = document.getElementById("submitResult");
	}
	else if (updating)
	{
		reqMethod = "PATCH";
	}

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

	function contentLoaded(evt) {
		console.log(xhr.responseText);
		var result = xhr.responseText;
		var jsonResult = JSON.parse(result);

		if (queryType === "subCatTree")
		{
			var parent = '{"' + id + '":';
			jsonResult = JSON.parse(parent.concat(result) + "}");
		}
		else if (formSubmit)
		{
			var progress = document.getElementById("submitProgress");
			var msg = document.getElementById("completeMsg");
			progress.style.width = "100%";
			progress.style.background = "green";
			setTimeout(function(evt) { 
				msg.innerHTML = "Record successfully saved."; 
				msg.className = "completeMsg"; 
			}, 1500);
			setTimeout(function(evt) { container.className = "hideStatus"; },4000);
			setTimeout(function(evt) {
				progress.style.width = "";
				progress.style.background = "";
				msg.className = "hideStatus";
				document.getElementById("saveIcon").style.fill = "#cccccc";
				document.getElementById("formSave").disabled = false;
			}, 4500);
			
			form.reset();

			if (queryType === "addAttribute") { addMoreAttr(); }
			else if (queryType === "addItem") { /*Remove Image Elements*/ }
		}
		
		callback(jsonResult);
	}

	function contentFail(evt) {
		if (formSubmit)
		{
			var progress = document.getElementById("submitProgress");
			progress.style.width = "100%";
			progress.style.background = "red";
			progress.innerHTML = "Something went wrong, please try again.";
			document.getElementById("saveIcon").style.fill = "#cccccc";
			document.getElementById("formSave").disabled = false;
		}
	}

	function uploadUpdateProgress(evt)
	{
		console.log(queryType + ": " + Math.round((evt.loaded / evt.total) * 100));
		var progress = Math.round((evt.loaded / evt.total) * 100);

		if (formSubmit)
		{
			var containerWidth = document.getElementById("submitResult").offsetWidth;
			var progWidth = (progress / containerWidth) * 100;
			console.log(progWidth);
			document.getElementById("submitProgress").style.width = progWidth + "px";
		}
	}

	function loadStartHandle(evt)
	{
		if (formSubmit)
		{
			container.className = "showStatus";
		}	
	}
	
	function updateProgress(evt) {
		console.log(queryType + ": " + Math.round((evt.loaded / evt.total) * 100));
		var progress = Math.round((evt.loaded / evt.total) * 100);
	}
	
	if (queryType === "products")
	{
		container.innerHTML = "<img id='loader' src='/660273/img/loader.gif' alt='Loading';>";
	}

	if (reqMethod == "GET")	
	{
		fileString = "/660273/assets/db/" + phpRes;
		if (queryType == "allCategories") { fileString += "?field=" + field + "&order=" + order + "&search=" + searchTerm; }
		else { fileString += "?" + getArgument + "=" + getData; }
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