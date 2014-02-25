function ajaxGet (id, queryType, callback) {
	switch (queryType) 
	{
		case "productDetail":
			var query = "db_query_product.php";
			var getArgument = "product";
			break;
		case "products":
			var container = document.getElementById("products");
			var query = "db_query_products.php";
			var getArgument = "category";
			break;
		case "categories":
			var query = "db_query_categories.php";
			var getArgument = "category";
			break;
		default:
			console.log("Functionality for this query is not built into the ajax query function");
			break;
	}

	var xhr = new XMLHttpRequest();
	
	xhr.addEventListener("progress", updateProgress, false);
	xhr.addEventListener("load", contentLoaded, false);
	xhr.addEventListener("error", contentFail, false);

	function contentLoaded(evt) {
		//console.log(xhr.responseText);
		var result = JSON.parse(xhr.responseText);
		callback(result);
	}

	function contentFail(evt) {
		console.log("Content load failed, please try again.");
	}
	
	function updateProgress(evt) {
		//console.log(queryType + ": " + evt.total);
		//console.log(queryType + ": " + evt.loaded);
		console.log(queryType + ": " + Math.round((evt.loaded / evt.total) * 100));
	}
	
	if (queryType === "products")
	{
		container.innerHTML = "<img id='loader' src='img/loader.gif' alt='Loading' width='auto';>";
	}

	var queryString = "db/" + query + "?" + getArgument + "=" + id;
	//console.log(queryString);
	xhr.open("GET", queryString, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send();
}

/**
function getProductsCMS(cat) {
	var products = document.getElementById("products");
	var xhr = new XMLHttpRequest();

	var changeListener = function() {
		console.log(xhr.responseText);
		if(xhr.readyState == 4 && xhr.status == 200) {
			var result = JSON.parse(xhr.responseText);
			products.innerHTML = "";
			var $i = 0;
			for(var obj in result){
				$i++;
				products.innerHTML += "<div class='productItem'>" +
				"<img src='img/products/" + result[obj].photo + "' alt='picture of product'>" +
				"<div class='itemName'>" + result[obj].name + "</div>" +
				"<div class='itemPrice'>Price: <strong>£" + result[obj].price + "</strong></div>" +
				"<div class='itemQuantity'><strong>" + result[obj].quantity + "</strong> in stock</div>" +
				"<a class='viewItem' href='product.php?product=" + result[obj].id + "' id='viewItem'>View Item</a>" +
				"<a class='addToBasket' href='#' onClick=addToBasket()>Add to Basket</a></div>" ;
			}
		}
	}
	
	products.innerHTML = "<img src='img/loader.gif' alt='Loading'>";

	xhr.open("POST", "incl/getProducts.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = changeListener;
	xhr.send("category="+cat);
}
*/