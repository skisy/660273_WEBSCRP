function showCompareItem(product)
{
	var meta;
	var container = document.getElementById("compareItemsContent");
	var basketBtn = getIcon("cart");

	var itemDiv = document.createElement("div");
	itemDiv.className = "itemCompareDiv";
	itemDiv.id = "compareItem" + product.id;

	var buttons = document.createElement("div");
	buttons.className = "compareButtons";
	buttons.id = "prodButtons" + product.id;

	var remove = document.createElement("a");
	remove.className = "removeCompareItem compareButton";
	remove.href = "";
	remove.draggable = false;
	remove.innerHTML = getIcon("delete");
	remove.title = "Remove from compare";

	var basket = document.createElement("a");
	basket.className = "addCompareItemBasket compareButton";
	basket.id = product.id;
	basket.draggable = false;
	basket.innerHTML = basketBtn;
	basket.title = "Add item to cart";

	buttons.appendChild(basket);
	buttons.appendChild(remove);

	itemDiv.appendChild(buttons);

	var itemImgDiv = document.createElement("div");
	itemImgDiv.className = "compareImgDiv"

	var itemImg = document.createElement("img");
	itemImg.className = "compareImg";
	itemImg.draggable = false;
	itemImg.src = "/660273/img/products/" + product.id + "/" + product.photo;
	itemImg.alt = "Picture of " + product.name;

	itemImgDiv.appendChild(itemImg);

	var itemDetails = document.createElement("div")
	itemDetails.className = "compareItemDetails";

	var itemName = document.createElement("p");
	itemName.className = "compareItemName";
	itemName.innerHTML = "<strong>" + product.name + "</strong>";

	var itemCat = document.createElement("p");
	itemCat.className = "compareItemCat";
	itemCat.innerHTML = "<strong>Category:</strong> " + product.catName;

	var itemPrice = document.createElement("p");
	itemPrice.className = "compareItemPrice";
	itemPrice.innerHTML = "<strong>Price:</strong> £" + product.price;

	var itemDesc = document.createElement("p");
	itemDesc.className = "compareItemDesc";
	itemDesc.innerText = product.description;

	itemDetails.appendChild(itemName);
	itemDetails.appendChild(itemCat);
	itemDetails.appendChild(itemPrice);
	itemDetails.appendChild(itemDesc);

	itemDiv.appendChild(itemImgDiv);
	itemDiv.appendChild(itemDetails);

	if (checkJSON(product.meta) && product.meta !== "{}")
	{
		attributes = JSON.parse(product.meta);

		var itemMetaDiv = document.createElement("div");
		itemMetaDiv.className = "itemMetaDiv";
		itemMetaDiv.innerHTML = "<strong>Specification:</strong>";

		var itemMeta = document.createElement("table");
		itemMeta.className = "compareItemMeta";

		for (var value in attributes)
		{
			if (attributes.hasOwnProperty(value))
			{
				var itemMetaRow = document.createElement("tr");
				itemMetaRow.className = "itemMetaRow";

				var metaName = document.createElement("td");
				metaName.className = "compareMetaName";
				metaName.innerText = value + ":";

				var metaValue = document.createElement("td");
				metaValue.className = "compareMetaValue";
				metaValue.innerText = attributes[value];

				itemMetaRow.appendChild(metaName);
				itemMetaRow.appendChild(metaValue);

				itemMeta.appendChild(itemMetaRow);
			}
		}
		itemMetaDiv.appendChild(itemMeta);
		itemDiv.appendChild(itemMetaDiv);
	}

	container.appendChild(itemDiv);
}

function showCompareItems()
{
	var container = document.getElementById("compareItemsContent");
	container.innerHTML = "";

	if (isEmpty("compare")) 
	{
		container.innerHTML = "<p>You haven't added any items to compare.</p>";
	}
	else
	{
		var items = JSON.parse(localStorage.getItem("compare"));
		for (var item in items)
		{
			ajaxHandle(items[item], "productDetail", showCompareItem);
		}
	}
}

function deleteFromCompare(id)
{
	var items = JSON.parse(localStorage.getItem("compare"));
	var container = document.getElementById("compareItemsContent");

	for (var item in items)
	{
		if (items.hasOwnProperty(item) && id == items[item])
		{
			delete items[item];
		}
	}

	localStorage.setItem("compare", JSON.stringify(items));	

	if (isEmpty("compare"))
	{
		container.innerHTML = "<p>Nothing to compare.</p>";
	}
}

function addEventListeners()
{
	document.querySelector("body").addEventListener("click", function(evt) {
		var elem = evt.target;
		var id, container;
		if (elem.id == "goShopping")
		{
			window.location.href = "/660273";
		}
		else if (elem.className.indexOf("removeCompareItem") !== -1)
		{
			evt.preventDefault();
			container = elem.parentNode.parentNode;
			id = container.id.replace("compareItem","");

			container.style.transition = "all .5s";
			container.style.opacity = "0";

			deleteFromCompare(id);

			setTimeout(function(evt) { 
				container.style.width = "0";
				container.style.minWidth = "0";
				container.style.margin = "0";
				container.style.padding = "0";
				container.style.border = "none";
			}, 500);
		}
		else if (elem.className.indexOf("addCompareItemBasket") !== -1)
		{
			evt.preventDefault();
			container = elem.parentNode.parentNode;
			id = container.id.replace("compareItem","");

			ajaxHandle(id, "productDetail", addToBasket);
		}
	}, false);
}

window.addEventListener("storage", showCompareItems, false);
window.addEventListener("load", addEventListeners, false);
window.addEventListener("load", showCompareItems, false);