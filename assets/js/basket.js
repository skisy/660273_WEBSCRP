function displayBasketRow(product)
{
	var container = document.getElementById("basketContent");
	var quantityCheck = JSON.parse(checkQuantity(product.id, product.quantity));
	var totalDisplay = document.getElementById("basketTotal");
	var quantity = quantityCheck["quantity"];
	var qFlag = quantityCheck["flag"];

	var priceCheck = JSON.parse(checkPrice(product.id, product.price));
	var price = priceCheck["price"];
	var pFlag = priceCheck["flag"];

	console.log(qFlag);

	if (pFlag == " priceChange")
	{
		var msg = document.getElementById("basketMsgPrice");
		msg.className = "showStatus";
		msg.getElementsByTagName("p")[0].innerHTML = "The price of some items in your basket has changed. <a class='closeNotif' href=''>Close</a>";
	}

	if (qFlag == " insufStock")
	{
		var msg = document.getElementById("basketMsg");
		msg.className = "showStatus";
		msg.getElementsByTagName("p")[0].innerHTML = "The quantity of some your items has been updated to match available stock. <a class='closeNotif' href=''>Close</a>";
	}

	if (qFlag == "nostock")
	{
		var container = document.getElementById("noStockContainer");

		var stockMsg = document.createElement("div");
		stockMsg.className = "hideStatus";

		var msgContent = document.createElement("p");
		msgContent.className = "status notification basketMsg";
		msgContent.innerHTML = "The following item is out of stock and has been removed from your basket: <strong>" + product.name + "</strong> <a class='clostNotif' href=''>Close</a>";

		stockMsg.appendChild(msgContent);
		container.appendChild(stockMsg);

		stockMsg.className = "showStatus";
	}
	else {
		var row = document.createElement("div");
		row.className = "basketRow";
		row.id = "row" + product.id;

		var rowImg = document.createElement("div");
		rowImg.className = "rowImg";
		rowImg.id = "rowImg" + product.id;

		var prodImg = document.createElement("img");
		prodImg.className = "rowItemImg";
		prodImg.id = "itemImg" + product.id;
		prodImg.src = "../img/products/" + product.id + "/" + product.photo;
		prodImg.title = "Picture of " + product.name;

		var rowDetail = document.createElement("div");
		rowDetail.className = "rowDetail";
		rowDetail.id = "rowDetail" + product.id;

		var prodName = document.createElement("a");
		prodName.className = "prodNameLink";
		prodName.id = "prodNameLink" + product.id;
		prodName.href = "../product/?product=" + product.id;
		prodName.innerHTML = product.name;

		var prodCat = document.createElement("a");
		prodCat.className = "prodCatLink";
		prodCat.id = "prodCatLink" + product.id;
		prodCat.href = "../?category=" + product.category;
		prodCat.textContent = product.catName;

		var prodDelete = document.createElement("div");
		prodDelete.className = "prodDelete";
		prodDelete.id = "prodDelete" + product.id;
		prodDelete.title = "Remove " + product.name + " from your basket";
		prodDelete.innerHTML = "Remove";

		var rowPrice = document.createElement("div");
		rowPrice.className = "rowPrice" + pFlag;
		rowPrice.id = "rowPrice" + product.id;
		rowPrice.textContent = "£" + product.price;

		var rowQuantity = document.createElement("div");
		rowQuantity.className = "rowQuantity";
		rowQuantity.id = "prodQuantity" + product.id;

		var prodQuantity = document.createElement("input");
		prodQuantity.className = "itemBasketQuantity" + qFlag;
		prodQuantity.id = "itemQuantity" + product.id;
		prodQuantity.type = "number";
		prodQuantity.min = "0";
		prodQuantity.max = product.quantity;
		prodQuantity.value = quantity;
		prodQuantity.required = true;

		rowImg.appendChild(prodImg);
		rowDetail.appendChild(prodName);
		rowDetail.appendChild(prodCat);
		rowDetail.appendChild(prodDelete);
		rowQuantity.appendChild(prodQuantity);

		row.appendChild(rowImg);
		row.appendChild(rowDetail);
		row.appendChild(rowPrice);
		row.appendChild(rowQuantity);

		container.appendChild(row);
	}

	totalDisplay.textContent = "£" + calculateTotal("basket");

}

function checkQuantity(id, stock)
{
	var basket = JSON.parse(localStorage.getItem("basket"));
	var result = {};
	var itemQuantity;

	for (var item in basket)
	{
		if (basket.hasOwnProperty(item) && basket[item].id == id)
		{
			itemQuantity = basket[item].basketQuantity;
			if (stock == 0)
			{
				delete basket[item];
				localStorage.setItem("basket", JSON.stringify(basket));
				result["quantity"] = 0;
				result["flag"] = "nostock";
			}
			else if (itemQuantity > stock) 
			{ 
				basket[item].basketQuantity = stock;
				localStorage.setItem("basket", JSON.stringify(basket));
				result["quantity"] = stock; 
				result["flag"] = " insufStock";
			}
			else
			{
				result["quantity"] = itemQuantity;
				result["flag"] = "";
			}
			break;
		}
	}

	return JSON.stringify(result);
}

function checkPrice(id, currentPrice)
{
	var basket = JSON.parse(localStorage.getItem("basket"));
	var result = {};
	var itemPrice;

	for (var item in basket)
	{
		if (basket.hasOwnProperty(item) && basket[item].id == id)
		{
			itemPrice = basket[item].price;

			if (itemPrice !== currentPrice) 
			{ 
				basket[item].price = currentPrice;
				localStorage.setItem("basket", JSON.stringify(basket));
				result["price"] = currentPrice; 
				result["flag"] = " priceChange";
			}
			else
			{
				result["price"] = itemPrice;
				result["flag"] = "";
			}
			break;
		}
	}

	return JSON.stringify(result);
}

function showBasket()
{
	var container = document.getElementById("basketContent");
	container.innerHTML = "";

	if (isEmpty("basket")) 
	{
		container.innerHTML = "<p>Your basket is empty.</p>";
	}
	else
	{
		var basket = JSON.parse(localStorage.getItem("basket"));
		for (var item in basket)
		{
			ajaxHandle(basket[item].id, "productDetail", displayBasketRow);
		}
	}
}

function updateBasket(elem, updateType)
{
	var id = elem.id.replace("itemQuantity", "").replace("prodDelete", "");
	var basket = JSON.parse(localStorage.getItem("basket"));
	var container = document.getElementById("basketContent");
	var totalDisplay = document.getElementById("basketTotal");
	var basketDisplay = document.getElementById("basketQuantity");

	for (var item in basket)
	{
		if (basket.hasOwnProperty(item) && id == basket[item].id)
		{
			if (updateType == "quantity") {	basket[item].basketQuantity = parseInt(elem.value); }
			else if (updateType == "remove") { delete basket[item]; }

			localStorage.setItem("basket", JSON.stringify(basket));
			totalDisplay.textContent = "£" + calculateTotal("basket");
			loadQuickBasket();
			break;
		}
	}	

	if (isEmpty("basket"))
	{
		container.innerHTML = "<p>Your basket is empty</p>";
	}

	updateBasketQuantity();
}

function addEventListeners()
{
	document.querySelector("body").addEventListener("click", function(evt) {
		var target = evt.target;
		var i;

		if (target.id.indexOf("toCheckout") !== -1)
		{
			var form = document.getElementById("basketContent");
			if (!isEmpty("basket"))
			{
				localStorage.setItem("checkoutBasket", localStorage.getItem("basket"));
				window.location.href = "../checkout";
			}
			else
			{
				alert("There's nothing in your basket to purchase");
			}
		}
		else if (target.id.indexOf("goShopping") !== -1)
		{
			window.location.href = "../";
		}
		else if (target.className == "closeNotif")
		{
			evt.preventDefault();
			target.parentNode.parentNode.className = "hideStatus";
		}
		else if (target.className == "prodDelete")
		{
			var row = target.parentNode.parentNode;
			row.style.transition = "all .5s";
			row.style.opacity = "0";

			updateBasket(target, "remove");

			setTimeout(function(evt) { row.style.height = "0"; },500);
		}
		else if (target.className == "emptyBasket")
		{
			localStorage.setItem("basket", "{}");
			updateBasketQuantity();
			var container = document.getElementById("basketContent");
			showBasket(container);
			document.getElementById("basketTotal").textContent = "£0.00";
		}
	}, false);

	document.querySelector("body").addEventListener("input", function(evt) {
		var elem = evt.target;
		var value = parseInt(elem.value);
		var msg = document.getElementById("basketMsg")
		console.log(value);
		if (elem.className.indexOf("itemBasketQuantity") !== -1)
		{
			if (elem.validity.badInput || isNaN(elem.value)) 
			{
				msg.getElementsByTagName("p")[0].innerHTML = "Please check your input is a valid number between <strong>0</strong> and <strong>" + evt.target.max + "</strong>";
				elem.value = 1;
				msg.className = "showStatus";
				elem.className = "itemBasketQuantity insufStock"
			}

			if (elem.validity.rangeOverflow || parseInt(elem.value) > parseInt(elem.max))
			{
				msg.getElementsByTagName("p")[0].innerHTML = "Sorry, there's only <strong>" + evt.target.max + "</strong> of that item available right now.";
				elem.value = evt.target.max;
				msg.className = "showStatus";
				elem.className = "itemBasketQuantity insufStock"
			}

			if (elem.validity.rangeUnderflow || parseInt(elem.value) < 1)
			{
				msg.getElementsByTagName("p")[0].textContent = "Please click remove on the item if you wish to remove it from your basket";
				elem.value = 1;
				msg.className = "showStatus";
				elem.className = "itemBasketQuantity insufStock"
			}

			if (elem.validity.stepMismatch)
			{
				msg.getElementsByTagName("p")[0].innerHTML = "Please check your input is a valid integer between <strong>0</strong> and <strong>" + evt.target.max + "</strong>";
				elem.value = 1;
				msg.className = "showStatus";
				elem.className = "itemBasketQuantity insufStock"
			}

			if (elem.validity.valueMissing)
			{
				msg.getElementsByTagName("p")[0].innerHTML = "Please check your input is a valid number between <strong>1</strong> and <strong>" + evt.target.max + "</strong>";
				msg.className = "showStatus";
				elem.className = "itemBasketQuantity insufStock"
			}

			if (!isNaN(parseInt(elem.value)))
			{
				elem.value = parseInt(elem.value);
			}

			updateBasket(evt.target, "quantity");

			setTimeout(function() {
				msg.className = "hideStatus";
				evt.target.className = "itemBasketQuantity";
			},5000)
		}
	}, false);
}

window.addEventListener("load", addEventListeners, false);
window.addEventListener("load", function(evt) {
	var container = document.getElementById("basketContent");
	showBasket(container);
}, false);
window.addEventListener("storage", showBasket, false);