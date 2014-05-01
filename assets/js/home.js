function showPreviousPage()
{
	var state = window.history.state;
	if(state){
		ajaxHandle(state.catID, "categories", callbackCategories);
		ajaxHandle(state.catID, "products", callbackProducts);
		document.title = state.catName;
	} else {
		window.history.back();
	}
}

function showHomePage() {
	var url = window.location.href;
	var category;

	if (url.indexOf("?category=") !== -1)
	{
		category = url.split("?category=");
		category = category[1];
		if (isNaN(category)) {
			category = 0;
		}
	}

	//searchResize(80);
	window.removeEventListener("load", showHomePage, false);
	window.addEventListener('popstate', showPreviousPage, false);
	ajaxHandle(category, "categories", callbackCategories);
	ajaxHandle(category, "products", callbackProducts);
	var stateObj = {};
	stateObj.catID = category;
	stateObj.catName = "Home";
	history.pushState(stateObj,null,null);
}

function categoryNavigation(id, categoryName) {
	document.title = categoryName;
	ajaxHandle(id, "categories", callbackCategories);
	ajaxHandle(id, "products", callbackProducts);
	var url = "category/" + categoryName.replace(/[^a-zA-Z\s]/g,"").replace(/[\s]/g,"");
	var stateObj = {};
	stateObj.catID = id;
	stateObj.catName = categoryName;
	history.pushState(stateObj,null,null);
}

function callbackProducts(result) {
	displayProducts(result);
	searching(result);

}

function displayProducts(result) {

	console.log(result);
	var dynamicContent = document.getElementById("products");
	dynamicContent.innerHTML = "";
	var basketBtn = getIcon("cart");
	var viewBtn = getIcon("view");
	var compareBtn = getIcon("compare");

	if(JSON.stringify(result) == "[]") 
	{
		dynamicContent.innerHTML = "<div id='noProducts'><strong>No products</strong></div><a name='goBack' id='goBack'>Go Back</a>";
	} 
	else 
	{
		for(var obj in result) 
		{
			if (result.hasOwnProperty(obj))
			{
				/*var mainWrap = document.createElement("div");
				mainWrap.tabindex = 0
				mainWrap.className = "productItem";
				mainWrap.id = "productItem" + result[obj].id;
				mainWrap.draggable = true;

				var swipeWrapper = document.createElement("div");
				swipeWrapper.tabindex = 0;
			swipeWrapper.className = "swipeItem";*/

			var container = document.createElement("div");
			container.tabindex = 0
			container.className = "productItem";
			container.id = "productItem" + result[obj].id;
			container.draggable = true;

			var name = document.createElement("p");
			name.className = "itemName";
			name.innerText = result[obj].col2;

			var img = document.createElement("img");
			img.src = "img/products/" + result[obj].id + "/" + result[obj].col1;
			img.title = result[obj].col2;
			img.alt = "";
			img.className = "productImg";
			img.draggable = false;

			var category = document.createElement("p");
			category.className = "itemCat";
			category.innerText = "Category: ";

			var catLink = document.createElement("a");
			catLink.className = "itemCatLink";
			catLink.id = "itemCat" + result[obj].category;
			catLink.href = "/660273/?category=" + result[obj].category;
			catLink.innerText = result[obj].catName;
			catLink.draggable = false;

			if (!document.all)
			{
				category.textContent = "Category: ";
				catLink.textContent = result[obj].catName;
			}

			var price = document.createElement("p");
			price.className = "itemPrice";
			price.innerText = "Price: ";

			var priceText = document.createElement("strong");
			if (parseFloat(result[obj].col4) > 10000) { pText = "See Details" }
			else { pText = "£" + result[obj].col4; }
			priceText.innerText = pText;

			if (!document.all)
			{
				price.textContent = "Price: ";
					priceText.textContent = pText;
			}

			var qText;
			console.log(result[obj].id, parseInt(result[obj].col5) >= 100);
			if (parseInt(result[obj].col5) > 0 && parseInt(result[obj].col5) < 100)
			{
				qText = "<strong>" + result[obj].col5 + "</strong> In stock";
			}
			else if (parseInt(result[obj].col5) >= 100)
			{
				qText = "<strong>In Stock</strong>";
			}
			else 
			{
				qText = "<strong class='stockOut'>Out of stock</strong>";
			}
			var quantity = document.createElement("p");
			quantity.className = "itemQuantity";
			quantity.innerHTML = qText;

			var exDetail = document.createElement("div");
			exDetail.className = "extraDetail";
			exDetail.innerHTML = "<h1>Description:</h1>";

			var descript = document.createElement("p");
			descript.className = "descText";
			descript.innerText = result[obj].col3;
			descript.id = "productDesc" + result[obj].col2;

			exDetail.appendChild(descript);

				if(!document.all) 
				{
					name.textContent = result[obj].col2;
					descript.textContent = result[obj].col3;
				}

			var buttons = document.createElement("div");
			buttons.className = "productButtons";
			buttons.id = "prodButtons" + result[obj].id;

			var view = document.createElement("a");
			view.className = "viewItem productOptBtn";
			view.href = "product/?product=" + result[obj].id;
			view.draggable = false;
			view.innerHTML = viewBtn + "<span class='viewSpan'>View Item</span>";
			view.title = "View product detail";

			var compare = document.createElement("a");
			compare.className = "compareItem productOptBtn";
				compare.draggable = false;
				compare.id = "compare" + result[obj].id;
				compare.innerHTML = compareBtn;
			compare.title = "Add item to compare";

			var basket = document.createElement("a");
			basket.className = "addToBasket productOptBtn";
			basket.id = result[obj].id;
			basket.draggable = false;
			basket.innerHTML = basketBtn;
			basket.title = "Add item to cart";

			category.appendChild(catLink);

			price.appendChild(priceText);

			buttons.appendChild(view);
			buttons.appendChild(compare);
			buttons.appendChild(basket);

			container.appendChild(name);
			container.appendChild(img);
			container.appendChild(descript);
			container.appendChild(category);
			container.appendChild(price);
			container.appendChild(quantity);
			container.appendChild(buttons);

			dynamicContent.appendChild(container);
			}
		}
	}
}

function callbackCategories(result) {

	//console.log(result);
	var dynamicContent = document.getElementById("catNav");
	dynamicContent.innerHTML = "";
	var i = 0;

	for(var obj in result) 
	{
		if (result.hasOwnProperty(obj))
    {
      i++;
      if (i < 8) 
      {
  
        dynamicContent.innerHTML += "<div class='catDiv'><a class='catButton' id='cat" +
        result[obj].id + "' href='index.php?category=" + result[obj].id + "'>" +	result[obj].name + "</a></div>";
      }	
    }
	}

	dynamicContent.innerHTML += "<div class='catDiv'><a id='otherCats' href='#'>All Categories</a></div>";

}

function searching(products) 
{

	var search = document.getElementById("searchInput");

	search.addEventListener("keyup", function() {

		var searchStr = document.getElementById("searchInput").value.toLowerCase();

		//console.log("SEARCH:" + searchStr);

			for(var obj in products) {
				if (products.hasOwnProperty(obj))
        {
          var name = products[obj].col2.toLowerCase();
          var desc = products[obj].col3.toLowerCase();
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
	//searchResize(40);
	var id = select.options[select.selectedIndex].value;
	ajaxHandle(id, "categories", callbackCategories);
	ajaxHandle(id, "products", callbackProducts);

}

function addToCompare(target) {
	var pId = target.id.replace("compare", "");

	if(typeof(localStorage)!=="undefined")
	{
		if(localStorage.getItem("compare"))
		{
			var compareLs = JSON.parse(localStorage.getItem("compare"));
			var length = 0;

			for (var item in compareLs)
			{
				length++;
			}

			if (length < 4)
			{
				var index = length + 1;
				compareLs["item" + index] = pId;
				localStorage.setItem("compare", JSON.stringify(compareLs));
				addedConfirmation("Compare", pId, true);
			}
			else
			{
				alert("You already have 4 items in your compare list");
			}
		}
		else
		{
			localStorage.setItem("compare", '{"item1":"' + pId + '"}');
			console.log('{"item1":"' + pId + '"}');
			addedConfirmation("Compare", pId,true);
		}
	}
}

function addEventListeners()
{

	document.querySelector('body').addEventListener('click', function(evt) {
		console.log(evt.target);
		var tClassName = evt.target.className;
	    var tId = evt.target.id;
	    var target = evt.target;
	    var id;

	    if ((evt.target.tagName.toLowerCase() === 'a') && (tClassName != "nav")) 
	    {
		    //evt.preventDefault();

		    if (tClassName === 'catButton') {

				id = tId.replace("cat","");
				categoryNavigation(id, target.text);

			} else if (tId === 'otherCats') {

		   		document.getElementById("overlayCat").className = "overlay";

			} else if (tClassName === 'itemCatLink') {

				id = tId.replace("itemCat", "");
				categoryNavigation(id, target.text);

			} else if (tId === "goBack") {

				window.history.back();

			} else if (tClassName.indexOf('addToBasket') !== -1) {

				id = tId.replace("add","");
				ajaxHandle(id, "productDetail", addToBasket);
			}
			else if (tClassName.indexOf("compareItem") !== -1) {
				addToCompare(target);
			} 
			else if (tId == "closeBasket" || tId == "closeNav") {}
			else if (tId == "closeCatOverlay")
			{
				document.getElementById("overlayCat").className = "inactive";
			}
			else if (tClassName == "selectedCat")
			{
				document.getElementById("overlayCat").className = "inactive";
				id = tId.replace("parentCat", "");
				window.location.href = "/660273/?category=" + id;
			}
			else if (tClassName.indexOf("viewItem") !== -1)
			{
				id = target.parentNode.id.replace("prodButtons","");
				window.location.href = "product/?product=" + id;
			}
			else if (tId == "setupSuccessClose")
			{
				target.parentNode.style.transition = "all .5s";
				target.parentNode.style.opacity = "0";
				
				setTimeout(function(evt) {
					target.parentNode.style.height = "0";
					target.parentNode.style.margin = "0";
					target.parentNode.style.padding = "0";
				},500);
				
			}
			else {
				console.log("not implemented");
			}
	  	}
	  	else if (tClassName == "goHome")
	  	{
	  		window.location.href = "/660273/";
	  	}
	  	else if (tClassName == "productItem")
		{
			id = target.id.replace("productItem", "");
			window.location.href = "product/?product=" + id;
		}
	},false);
}

/*function touchListeners()
{
	var leftOff, startX, obj;
	var dist = 0;

	document.querySelector("body").addEventListener("touchstart", function(evt) {
		if (evt.target.className == "swipeItem")
		{
			obj = evt.changedTouches[0];
			//console.log(evt.target, evt.target.style.left);
			leftOff = 0;
			startX = parseInt(obj.clientX);
		}
	},false);

	document.querySelector("body").addEventListener("touchmove", function(evt) {
		if (evt.target.className == "swipeItem")
		{
			var target = evt.target;
			obj = evt.changedTouches[0];
			dist = parseInt(obj.clientX) - startX;
			console.log(dist);
			if (leftOff + dist > target.offsetwidth) { target.style.left = "50%";	}
			else 
			{
				if (leftOff + dist < 0) { target.style.left = 0; }
				else { target.style.left = (leftOff + dist) + "px"; }
			}
		}
	},false)
}*/

//window.addEventListener("load", touchListeners, false);
window.addEventListener("load", addEventListeners, false);
window.addEventListener("load", showHomePage, false);