function navResize()
{
	var nameWidth = parseInt(document.getElementById('shop-name').offsetWidth);
	var nav = document.getElementById("top-search");
	if (window.innerWidth > 1288) {	
		var navWidth = 1288 - nameWidth - 100;
		nav.style.width = navWidth + "px";
	} else {
		nav.style.width = "";
	}
}

function searchResize(offset)
{
	var currentCat = document.getElementById("currentCat");
	var search = document.getElementById("searchInput");
	if (window.innerWidth > 1288) {	
		offset -= 30;
		search.style.width = 900 - offset - currentCat.offsetWidth + "px";
	} else {
		var searchWidth = window.innerWidth - offset - currentCat.offsetWidth + "px";
		search.style.width = searchWidth;
	}
}

function showPreviousPage()
{
	var state = window.history.state;
	if(state){
		ajaxGet(state.catID, "categories", callbackCategories);
		ajaxGet(state.catID, "products", callbackProducts);
		document.title = state.catName;
	} else {
		window.history.back();
	}
}

function showHomePage() {
	navResize();
	searchResize(76);
	window.removeEventListener("load", showHomePage, false);
	window.addEventListener('popstate', showPreviousPage, false);
	ajaxGet(0, "categories", callbackCategories);
	ajaxGet(0, "products", callbackProducts);
	var stateObj = {}
	stateObj.catID = 0;
	stateObj.catName = "Home";
	history.pushState(stateObj,null,null);
}

function categoryNavigation(id, categoryName) {
	document.title = categoryName;
	ajaxGet(id, "categories", callbackCategories);
	ajaxGet(id, "products", callbackProducts);
	var url = "category/" + categoryName.replace(/[^a-zA-Z\s]/g,"").replace(/[\s]/g,"");;
	var stateObj = {}
	stateObj.catID = id;
	stateObj.catName = categoryName;
	history.pushState(stateObj,null,null);
}

function callbackProducts(result) {
	displayProducts(result);
	searching(result);
	document.getElementById("currentCat").innerHTML = "Current";
}

function addToBasket(result) {

//	console.log(result);
	
	var productDetail = JSON.stringify(result);
//	console.log(productDetail);
	
	var appendedQuantity = productDetail.slice(0, productDetail.length-1) + ',"basketQuantity":1}';
//	console.log(appendedQuantity);
	
	result = JSON.parse(appendedQuantity);
//	console.log(result);
	
//	console.log(result);

	var productId = "product" + result.id;
	var productString = '"' + productId + '":' + JSON.stringify(result) + '}';
	if(typeof(Storage)!=="undefined")
  	{
		if(localStorage.getItem("basket")) {
			var basket = localStorage.getItem("basket");
			
			var basketObj = JSON.parse(basket);
			
			//console.log(basketObj[productId]);
			//console.log(JSON.parse(basket));
			
			if (basketObj[productId]) {
			
				basketObj[productId].basketQuantity = basketObj[productId].basketQuantity + 1;
				var newBasket = JSON.stringify(basketObj);
				//console.log(newBasket);
				
			} else {
			
				var newBasket = basket.slice(0, basket.length-1) + ',' + productString;
				
			}
			
			localStorage.setItem("basket", newBasket);
			//console.log(JSON.parse(localStorage.getItem("basket")));
			
		} else {
		
			localStorage.setItem("basket", '{' + productString);
			//console.log(JSON.parse(localStorage.getItem("basket")));
			
		}
  	} else {
  		alert("No support for web storage");
  	}
}

function itemsInBasket() {
	var basket = getBasket();
	//console.log(basket);
	console.log(basket);
		var itemCount = 0;
		for(var item in basket) {
			itemCount++
			if(basket[item].basketQuantity >= 0) {
				itemCount = itemCount + basket[item].basketQuantity - 1;
			}
		}
	
	//console.log("ITEMS IN BASKET: " + itemCount);
	return itemCount;
}

function getBasket() {
	if(typeof(Storage)!=="undefined")
  	{
		if(localStorage.getItem("basket")) {
			var basket = JSON.parse(localStorage.getItem("basket"));
			return basket;
		} else {
			return 0;
		}
  	} else {
  		alert("No support for web storage");
  	}
}

function displayProducts(result) {
	console.log(result);
	var dynamicContent = document.getElementById("products");
	dynamicContent.innerHTML = "";
	if(JSON.stringify(result) == "{}") {
		dynamicContent.innerHTML = "<div id='noProducts'><strong>There are no products available from this category</strong></div><a name='goBack' id='goBack'>Go Back</a>";
	} else {
		for(var obj in result) {
			dynamicContent.innerHTML += "<div class='productItem' id='productItem" + result[obj].id + "' draggable='true' ondragstart=dragStartHandle(); ondragend=dragEndHandle();>" +
			"<img src='img/products/" + result[obj].photo + "' alt='picture of product' class='productImg' draggable='false'>" +
			"<p class='itemName'>" + result[obj].name + "</p>" +
			"<p class='itemCat'>Category: <a class='itemCatLink' id='itemCat" + result[obj].category + "' href='#' draggable='false'>" + result[obj].catName + "</a></p>" + 
			"<p class='itemPrice'>Price: <strong>£" + result[obj].price + "</strong></p>" +
			"<p class='itemQuantity'><strong>" + result[obj].quantity + "</strong> in stock</p>" +
			"<a class='viewItem' href='product.php?product=" + result[obj].id + "' class='viewItem' draggable='false'>View Item</a>" +
			"<a class='addToBasket' id='" + result[obj].id + "' href='#' draggable='false' onclick=return false();>Add to Basket</a></div>";
		}
	}
}

function callbackCategories(result) {
	//console.log(result);
	var dynamicContent = document.getElementById("catNav");
	dynamicContent.innerHTML = "";
	var i = 0;
	for(var obj in result) {
		i++;
		if (i < 8) {
			dynamicContent.innerHTML += "<div class='catDiv'><a class='catButton' id='cat" +
									 result[obj].id + "' href='index.php?category=" 
									 + result[obj].id + "'>" +	result[obj].name + "</a></div>";
		}	
	}
	dynamicContent.innerHTML += "<div class='catDiv'><a id='otherCats' href='#'>All Categories</a></div>";
}

function populateDropdown(result) {
	var dropdown = document.getElementById("catSelect");
	dropdown.innerHTML = "<option>All</option><option selected='selected'>Current</option>";
	for(var obj in result) {
			dropdown.innerHTML += "<option value='" + result[obj].id + "''>" + result[obj].name + "</option>";
		}
}

function searching(products) {
	search = document.getElementById("searchInput");
	search.addEventListener("keyup", function() {
		var searchStr = document.getElementById("searchInput").value.toLowerCase();
		var selectedCat = document.getElementById("currentCat").innerHTML;
		//console.log("SEARCH:" + searchStr);
		if (selectedCat == "Current") {
			for(var obj in products) {
				var name = products[obj].name.toLowerCase();
				var desc = products[obj].description.toLowerCase();
				var catName = products[obj].catName.toLowerCase();
				if (name.indexOf(searchStr) >= 0 || desc.indexOf(searchStr) >= 0 || catName.indexOf(searchStr) >= 0) {
					document.getElementById("productItem" + products[obj].id).className = "productItem";
				} else {
					document.getElementById("productItem" + products[obj].id).className = "notDisplayed";

				}
			}
		}
		//console.log("SEARCH RESULTS: " + products);
		//displayProducts(result);
		//filterResults(result, products);
	},false);
}

function updateSelectedCat()
{
	var currentCat = document.getElementById("currentCat");
	var select = document.getElementById("catSelect");
	currentCat.innerHTML = select.options[select.selectedIndex].text;
	navResize();
	searchResize(45);
}

function updateBasketQuantity() {
	var basketQuantity = document.getElementById("basketQuantity");
    
    while( basketQuantity.firstChild ) {
        basketQuantity.removeChild( basketQuantity.firstChild );
    }
    basketQuantity.appendChild( document.createTextNode(itemsInBasket()) );	
}

function dragStartHandle() {
	var product = event.target;
	event.target.className = "draggedProduct";
	document.getElementById("dragHereBasket").className = "basketTipDisplay";
}

function dragEndHandle() {
	event.target.className = "productItem";
	document.getElementById("dragHereBasket").className = "notDisplayed";
	document.getElementById("releaseHereBasket").className = "notDisplayed";
}

function dragOverHandle() {
	
}

function dragLeaveHandle() {
	document.getElementById("dragHereBasket").className = "basketTipDisplay";
	document.getElementById("releaseHereBasket").className = "notDisplayed";
	console.log("left");
}

function dragEnterHandle() {
	console.log("entered");
	document.getElementById("dragHereBasket").className = "notDisplayed";
	document.getElementById("releaseHereBasket").className = "basketTipDisplay";
}

function addEventListeners()
{
	window.addEventListener("resize", navResize, false);
	window.addEventListener("resize", function(){
		searchResize(45)}, false);
	document.querySelector('body').addEventListener('click', function(evt) {
	  if (evt.target.tagName.toLowerCase() === 'a') {
		evt.preventDefault();
		var tClassName = evt.target.className;
		var tId = evt.target.id;
		var targetElement = document.getElementById(tId);
		if (tClassName === 'catButton') {
			var id = tId.replace("cat","");
			categoryNavigation(id, targetElement.text);
		} else if (tId === 'otherCats') {
			alert("IT DOESN'T WORK YET!")
		} else if (tClassName === 'itemCatLink') {
			var id = tId.replace("itemCat", "");
			categoryNavigation(id, targetElement.text);
		} else if (tId === "goBack") {
			window.history.back();
		} else if (tClassName == 'addToBasket') {
			var id = tId.replace("add","");
			ajaxGet(id, "productDetail", addToBasket);
			var quantityDisplay = document.getElementById("basketQuantity");
			var basketQuantity = parseInt(quantityDisplay.innerHTML);
			quantityDisplay.innerHTML = basketQuantity + 1;
			
		} else {
			//alert("Do something else");
		}
	  }
	},false);
	
	updateBasketQuantity();
	
	window.addEventListener("storage", updateBasketQuantity);


  /*
		dragstart - fires when element detects drag - target = target being dragged,
		dragend - fires when element being dragged is released - target = target being dragged,
		dragover - fires when dragable element is being dragged over valid drop target - target = target under dragable element,
		dragenter - fires when dragged element enters valid drop target,
		dragleave - fires when dragged element leaves valid drop target
  */

	document.getElementById("basketLink").addEventListener("click", function(evt){
		evt.preventDefault();
		alert("Load quick basket");
	}, false);

	document.getElementById("catSelect").addEventListener("change", updateSelectedCat, false);
}

window.addEventListener("load", addEventListeners, false);
window.addEventListener("load", showHomePage, false);
window.addEventListener("load", function() {
	ajaxGet(0, "categories", populateDropdown)},false);