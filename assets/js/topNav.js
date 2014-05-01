function createList(listNodeItem, container)
{
	var listItem = document.createElement("li");
	listItem.id = "treeCat" + listNodeItem.id;

	var catLink = document.createElement("a");
	catLink.className = "selectedCat";
	catLink.id = "parentCat" + listNodeItem.id;
	catLink.innerHTML = listNodeItem.name;

	var icon = document.createElement("i");
	icon.className = "icon fa fa-plus";
	icon.id = "catNode" + listNodeItem.id;

	var subCatList = document.createElement("ul");
	subCatList.id = "subCatList" + listNodeItem.id;

	listItem.appendChild(icon);
	listItem.appendChild(catLink);
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

	if (targetClass.indexOf("minus") != -1)
	{
		target.className = targetClass.replace("fa-minus", "fa-plus");
		console.log("closing node");
		container.className = "hideList";
	}
	else if (targetClass.indexOf("plus") != -1)
	{
		target.className = targetClass.replace("fa-plus", "fa-minus");
		console.log("opening node");
		ajaxHandle(catId, "subCatTree", displaySubCats);
		container.className = "showList";
	}
}

function addedConfirmation(objAdd, pId, success)
{
	var container = document.getElementById("prodButtons" + pId);
	var conHtml = container.innerHTML;
	if (!document.getElementById("quantityToAdd"))
	{
		if (success){
			container.innerHTML = "<p class='basketConfirmation success'>Added to " + objAdd + "!</p>";
		}
		else
		{
			container.innerHTML = "<p class='basketConfirmation error'>Insufficient stock</p>";
		}

		setTimeout(function() {
			container.innerHTML = conHtml;
		},1000);
	}
	else
	{
		if (!success){
			document.getElementById("quantityMsg").className = "showStatus";
		}
		document.getElementById("quantityToAdd").selectedIndex = 0;
	}
}

function addToBasket(result) {

	var pId = result.id;
	var stock = result.quantity;
	console.log(stock);
	var basketObj;

	data = {};
	data.id = pId;
	data.name = result["name"];
	data.price = result["price"];
	data.basketQuantity = 1;

		if(typeof(Storage)!=="undefined")
	  	{
			if(localStorage.getItem("basket")) {
				var basketObj = JSON.parse(localStorage.getItem("basket"));
							
				if (basketObj["product" + pId]) {
					basketObj["product" + pId].basketQuantity = basketObj["product" + pId].basketQuantity + 1;
				} else {
					basketObj["product" + pId] = data;		
				}			
			} else {
				basketObj = {};
				basketObj["product" + pId] = data;
			}

			if (basketObj["product" + pId].basketQuantity <= stock)
			{
				localStorage.setItem("basket", JSON.stringify(basketObj));
				var quantityDisplay = document.getElementById("basketQuantity");
				var basketQuantity = parseInt(quantityDisplay.textContent);
				quantityDisplay.textContent = basketQuantity + 1;
				addedConfirmation("Basket", pId, true);

				loadQuickBasket();
			}
			else 
			{
				addedConfirmation("Basket", pId, false);
			}
	  } 
	  else { alert("No support for web storage"); }
}

function calculateTotal(basketType)
{
	var subtotal;
	if(typeof(Storage)!=="undefined")
	{	
		try {
			var basket = JSON.parse(localStorage.getItem(basketType));
			subtotal = 0;
			var price, quantity;

			for (var item in basket)
			{
				if(basket.hasOwnProperty(item))
				{
					price = parseFloat(basket[item].price);
					quantity = parseInt(basket[item].basketQuantity);
					if (!isNaN(price) && !isNaN(quantity)) { subtotal += (price * quantity); }
				}
			}
			subtotal = subtotal.toFixed(2);
			return subtotal;
		}
		catch (err)
		{
			subtotal = 0.00;
			return subtotal.toFixed(2);
		}
	} 
	else { alert("No support for web storage, please upgrade your browser"); }
}

function menuDisplay()
{
	document.querySelector("body").addEventListener("click", function(evt) {
		var target = evt.target;
		var elem;

		switch (target.id)
		{
			case "basketButton":
				document.getElementById("menuNav").style.visibility = "hidden";
				var menu = document.getElementById("quickBasket");

				if (menu.style.visibility == "visible")
				{
					menu.style.visibility = "hidden";
				}
				else
				{
					menu.style.visibility = "visible";
					loadQuickBasket();
				}
				break;
			case "closeBasket":
				document.getElementById("quickBasket").style.visibility = "hidden";
				break;
			case "quickToBasket":
				window.location.href = "/660273/basket";
				break;
			case "menuButton":
				if (elem = document.getElementById("quickBasket")) {
					elem.style.visibility = "hidden";
				}
				var menu = document.getElementById("menuNav");

				if (menu.style.visibility == "visible")
				{
					menu.style.visibility = "hidden";
				}
				else
				{
					menu.style.visibility = "visible";
				}
				break;
			case "closeNav":
				document.getElementById("menuNav").style.visibility = "hidden";
				break;
			case "trackOrderLink":
				window.location.href = "/660273/track";
				break;
			case "compareItemsLink":
				window.location.href = "/660273/compare";
				break;
			case "browseCatLink":
				document.getElementById("overlayCat").className = "overlay";
				document.getElementById("menuNav").style.visibility = "hidden";
				break;
			case "navHomeLink":
				window.location.href = "/660273/";
				break;
			default:
				document.getElementById("menuNav").style.visibility = "hidden";
				if (elem = document.getElementById("quickBasket")) {
					elem.style.visibility = "hidden";
				}
				break;
		}		
	}, false);
}

function browseCats()
{
	document.querySelector("#browseCats").addEventListener("click", function(evt) {
		var target = evt.target;
		if (target.className.indexOf("icon") !== -1)
		{
			iconClickHandle(target.id);
		}
		else if (target.className == "selectedCat")
		{
			document.getElementById("overlayCat").className = "inactive";
			id = target.id.replace("parentCat", "");
			window.location.href = "/660273/?category=" + id;
		}	
	}, false);
}

function updateQuickBasket() 
{
	loadQuickBasket();
	updateBasketQuantity();
}

function updateBasketQuantity() 
{

	var basketQuantity = document.getElementById("basketQuantity");
    
    while( basketQuantity.firstChild ) {

        basketQuantity.removeChild( basketQuantity.firstChild );

    }

    basketQuantity.appendChild( document.createTextNode(itemsInBasket()));	
}

function itemsInBasket() 
{
	var basket = getBasket();
	//console.log(basket);
	console.log(basket);
	var itemCount = 0;
		for(var item in basket) {
			if (basket.hasOwnProperty(item))
			{
				//itemCount++;
				if (basket[item].basketQuantity > 0) 
				{
					itemCount = itemCount + basket[item].basketQuantity;
				}
			}
		}
	
	//console.log("ITEMS IN BASKET: " + itemCount);
	return itemCount;
}

function getBasket() 
{
	if(typeof(Storage)!=="undefined")
  {
		if(localStorage.getItem("basket")) {
			try {
				var basket = JSON.parse(localStorage.getItem("basket"));
				return basket;
			}
			catch (err)
			{
				return 0;
			}
		}
    else
    {
			return 0;
		}
  } else {
    alert("No support for web storage, please upgrade your browser.");
  }
}

function getQuantity(id)
{
	var basket = getBasket();

	for (var item in basket)
	{
		if (basket.hasOwnProperty(item) && basket[item].id == id)
		{
			return basket[item].basketQuantity;
		}
	}

	return 0;
}

function showQuickBasketItem(product)
{
	var container = document.getElementById("quickBasketContent");
	var quantity = getQuantity(product.id);

	var row = document.createElement("div");
	row.className = "quickBasketRow";
	row.id = "row" + product.id;

	var rowImg = document.createElement("div");
	rowImg.className = "quickRowImg";
	rowImg.id = "rowImg" + product.id;

	var prodImg = document.createElement("img");
	prodImg.className = "quickRowItemImg";
	prodImg.id = "itemImg" + product.id;
	prodImg.src = "/660273/img/products/" + product.id + "/" + product.photo;
	prodImg.title = "Picture of " + product.name;

	var rowDetail = document.createElement("div");
	rowDetail.className = "quickRowDetail";
	rowDetail.id = "rowDetail" + product.id;

	var prodName = document.createElement("a");
	prodName.className = "quickProdNameLink";
	prodName.id = "prodNameLink" + product.id;
	prodName.href = "/660273/product?product=" + product.id;
	prodName.innerHTML = product.name;

	var prodCat = document.createElement("a");
	prodCat.className = "quickProdCatLink";
	prodCat.id = "prodCatLink" + product.id;
	prodCat.href = "/660273/category/" + product.category;
	prodCat.textContent = product.catName;

	var rowPrice = document.createElement("p");
	rowPrice.className = "quickRowPrice";
	rowPrice.id = "rowPrice" + product.id;
	rowPrice.textContent = "£" + product.price;

	var rowQuantity = document.createElement("p");
	rowQuantity.className = "quickRowQuantity";
	rowQuantity.id = "prodQuantity" + product.id;
	rowQuantity.innerHTML = "<strong>Quantity:</strong> " + quantity;

	rowImg.appendChild(prodImg);
	rowDetail.appendChild(prodName);
	rowDetail.appendChild(prodCat);
	rowDetail.appendChild(rowPrice);
	rowDetail.appendChild(rowQuantity);

	row.appendChild(rowImg);
	row.appendChild(rowDetail);

	container.appendChild(row);
}

function loadQuickBasket()
{
	var container = document.getElementById("quickBasketContent");
	container.innerHTML = "";

	if (isEmpty("basket")) 
	{
		container.innerHTML = "<p>Your basket is empty.</p>";
	}
	else
	{
		var basket = JSON.parse(localStorage.getItem("basket"));
		var length = itemsInBasket();
		for (var item in basket)
		{
			length = length - basket[item].basketQuantity;
			ajaxHandle(basket[item].id, "productDetail", showQuickBasketItem);
		}
	}
	document.getElementById("quickTotal").innerHTML = "<strong>Subtotal:</strong> £" + calculateTotal("basket");
}
if (window.location.href.indexOf("cms") == -1 && window.location.href.indexOf("admin") == -1)
{
	window.addEventListener("storage", updateQuickBasket, false);
	window.addEventListener("load", updateBasketQuantity, false);
	window.addEventListener("load", browseCats, false);
}

function resizeTitle()
{
	var title = document.getElementById("shop-name");
	var newSize, newMargin;

	while (title.scrollHeight > title.offsetHeight)
	{
		newSize = parseInt(window.getComputedStyle(title, null).getPropertyValue('font-size').slice(0, -2)) - 1 + "px";
		newMargin = parseInt(window.getComputedStyle(title, null).getPropertyValue('margin-top').slice(0, -2)) + 1 + "px";
		title.style.fontSize = newSize;
		title.style.marginTop = newMargin;
	}
}

window.addEventListener("load", resizeTitle, false);
window.addEventListener("load", menuDisplay, false);