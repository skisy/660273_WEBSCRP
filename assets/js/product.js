function showProductDetails(product)
{
	if (JSON.stringify(product) == "[]")
	{
		showLostPage();
	}
	else 
	{
		document.title += " " + product.name;

		var container = document.getElementById("productContainer");
		var descContainer = document.getElementById("productDescriptionContainer");
		var images = document.getElementById("additionalImagesDiv");
		var metaContainer = document.getElementById("productMeta");

		var mainInfo = document.createElement("div");
		mainInfo.className = "productMainInfo";

		var imgContain = document.createElement("div");
		imgContain.className = "prodImgContain";

		var prodImg = document.createElement("img");
		prodImg.className = "prodDetailImg";
		prodImg.id = "mainProdImg";
		prodImg.src = "/660273/img/products/" + product.id + "/" + product.photo;

		imgContain.appendChild(prodImg);
		mainInfo.appendChild(imgContain);

		var primaryImgContain = document.createElement("div");
		primaryImgContain.className = "addImgContainer";

		var primaryImg = document.createElement("img");
		primaryImg.src = "/660273/img/products/" + product.id + "/" + product.photo;
		primaryImg.className = "addImg";

		primaryImgContain.appendChild(primaryImg);
		images.appendChild(primaryImgContain);

		var prodDetail = document.createElement("div");
		prodDetail.className = "prodDetailDiv";

		var prodName = document.createElement("p");
		prodName.className = "prodDetailName";
		prodName.textContent = product.name;
		prodDetail.appendChild(prodName);

		var prodCat = document.createElement("p");
		prodCat.className = "prodDetailCat";
		prodCat.innerHTML = "<a href='/660273/?category=" + product.category + "'>" + product.catName + "</a>";
		prodDetail.appendChild(prodCat);

		var prodPrice = document.createElement("p");
		prodPrice.className = "prodDetailPrice";
		prodPrice.innerHTML = "Price: <strong>£" + product.price + "</strong>";
		prodDetail.appendChild(prodPrice);

		var prodQuantity = document.createElement("p");
		prodQuantity.className = "prodDetailQuantity";

		var qText = getQText(product.quantity);

		prodQuantity.innerHTML = qText;
		prodDetail.appendChild(prodQuantity);

		var prodDesc = document.createElement("p")
		prodDesc.className = "prodDetailDesc";
		prodDesc.textContent = product.description;

		var deschead = document.createElement("h1");
		deschead.id = "prodDetailDescHead";

		descContainer.appendChild(deschead);
		descContainer.appendChild(prodDesc);

		mainInfo.appendChild(prodDetail);

		container.appendChild(mainInfo);

		var addContainer = document.createElement("div");
		addContainer.className = "addContainer";
		addContainer.id = "prodButtons" + product.id;

		var quantityLabel = document.createElement("label");
		quantityLabel.className = "qLabel";
		quantityLabel.htmlFor = "quantityToAdd";
		quantityLabel.textContent = "Quantity: ";

		var quantity = document.createElement("select");
		quantity.className = "addQuantity";
		quantity.id = "quantityToAdd";

		if (product.quantity < 1) 
		{
			quantity.disabled = true;
		}

		for (var i = 1; i < product.quantity + 1; i++)
		{
			if (i > 50) { break; }
			var option = document.createElement("option")
			option.value = i;
			option.text = i;

			quantity.appendChild(option);
		}
		addContainer.appendChild(quantityLabel);
		addContainer.appendChild(quantity);

		var addButton = document.createElement("div");
		addButton.className = "formButton productAddBtn";
		addButton.id = "addToBasketBtn" + product.id;
		addButton.textContent = "Add to Basket";

		addContainer.appendChild(addButton);

		container.appendChild(addContainer);

		var attributes;

		if (checkJSON(product.meta) && product.meta !== "{\"\":\"\"}")
		{
			console.log(product.meta);
			metaContainer.innerHTML = "<h1 id='productMetaHead'>Product Specifications</h1>";
			attributes = JSON.parse(product.meta);

			var itemMeta = document.createElement("table");
			itemMeta.className = "compareItemMeta";

			for (var value in attributes)
			{
				if (attributes.hasOwnProperty(value) && attributes[value] !== "")
				{
					console.log(attributes[value]);
					var itemMetaRow = document.createElement("tr");
					itemMetaRow.className = "itemMetaRow";

					var metaName = document.createElement("td");
					metaName.className = "compareMetaName";
					metaName.textContent = value + ":";

					var metaValue = document.createElement("td");
					metaValue.className = "compareMetaValue";
					metaValue.textContent = attributes[value];

					itemMetaRow.appendChild(metaName);
					itemMetaRow.appendChild(metaValue);

					itemMeta.appendChild(itemMetaRow);
				}
			}
			metaContainer.appendChild(itemMeta);
		}
	}
}

function getQText(quantity)
{
	var qText;	
	if (quantity < 1)
	{
		qText = "<strong class='boldred'>Currently out of stock.</strong>";
	}
	else if (quantity < 10)
	{
		qText = "<em class='red'>Only <strong>" + quantity + "</strong> left in stock.</em>";
	}
	else 
	{
		qText = "<strong class='boldgreen'>In stock.</strong>";
	}

	return qText;
}

function showProductImages(images)
{
	if (JSON.stringify(images) !== "[]")
	{
		var container = document.getElementById("additionalImagesDiv");

		for (var image in images)
		{
			if (images.hasOwnProperty(image))
			{
				var imgContainer = document.createElement("div");
				imgContainer.className = "addImgContainer";

				var img = document.createElement("img");
				img.className = "addImg";
				img.src = "/660273/img/products/" + images[image].id + "/" + images[image].url;

				imgContainer.appendChild(img);
				container.appendChild(imgContainer); 
			}
		}
	}
}

function loadProductData()
{
	var url = window.location.href;
	var product;

	if (url.indexOf("?product=") !== -1)
	{
		product = url.split("?product=");
		product = product[1];
		if (isNaN(product)) {
			showLostPage();
		}
		else
		{
			ajaxHandle(product,"productDetail", showProductDetails);
			ajaxHandle(product,"productImages", showProductImages);
		}
	}
	else
	{
		showLostPage();
	}
}

function showLostPage()
{
	var container = document.getElementById("productContainer");
	var title = document.getElementById("productName");
	title.textContent = "Lost?"
	container.innerHTML = "<p>Seems you may have reached this page by mistake or the item you are looking for no longer exists.</p>";
	container.innerHTML += "<p>Why not <a href='../'>go back</a> to the main shop and search for it.</p>";

	document.title += " Lost?";
}

function addEventListeners()
{
	document.getElementById("goShopping").addEventListener("click", function(evt) {
		window.location.href = "/660273/";
	}, false);

	document.querySelector("#additionalImagesDiv").addEventListener("mouseover", function(evt) {
		var target = evt.target;
		if (target.className == "addImg")
		{
			var mainImg = document.getElementById("mainProdImg");

			mainImg.src = target.src;
		}
	}, false);

	document.querySelector("body").addEventListener("click", function(evt) { 
		var target = evt.target;
		var id, quantity, elem;
		if (target.className.indexOf("productAddBtn") !== -1)
		{
			id = target.id.replace("addToBasketBtn","");
			elem = document.getElementById("quantityToAdd");
			if (elem.disabled == true)
			{
				alert("This product is currently out of stock");
			}
			else
			{
				quantity = elem.options[elem.selectedIndex].value;
				for (var i = 0; i < quantity; i++)
				{
					ajaxHandle(id, "productDetail", addToBasket);
				}
			}
		}
	}, false)
}

window.addEventListener("load", loadProductData, false);
window.addEventListener("load", addEventListeners, false);