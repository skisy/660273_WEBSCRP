function orderConfirm(result)
{
	console.log("order received");

		document.getElementById("orderPlaced").id = "placeOrder";

	var basket = JSON.parse(localStorage.getItem("basket"));
	var checkBasket = JSON.parse(localStorage.getItem("checkoutBasket"));

	var baskQ, checkQ, finalQ, itemId, boughtId;

	for (var boughtItem in checkBasket)
	{
		boughtId = checkBasket[boughtItem].id;
		for (var item in basket)
		{
			itemId = basket[item].id;
			if (basket[item].id === checkBasket[boughtItem].id)
			{
				console.log(basket[item], checkBasket[boughtItem]);
				baskQ = basket[item].basketQuantity;
					checkQ = checkBasket[boughtItem].basketQuantity;
					finalQ = baskQ - checkQ;
					console.log(baskQ, checkQ, finalQ);
					if (finalQ < 1) { delete basket[item]; }
					else { basket[item].basketQuantity = finalQ; }
				}
		}
	}

	console.log(basket);

	localStorage.setItem("checkoutBasket", "{}");
	localStorage.setItem("basket", JSON.stringify(basket));
	updateBasketQuantity();

	var ref = result["ref"];
	showConfirmationPage(ref);
}

function showConfirmationPage(ref)
{
	var container = document.getElementById("checkoutContainer");
	container.innerHTML = "<h1>Order Confirmation</h1><p>Thank you for your order.</p> <p>Your order reference number is shown below, it can be used to <a href='../track'>track</a> the progerss of your order, so make a note of it.</p>" + 
	"<p><strong>Order Reference:</strong> " + ref + "</p>";

	var button = document.createElement("div");
	button.id = "goShopping" 
	button.className = "formButton basketControls goShoppingBtn bottomBasketControls"
	button.innerHTML = getIcon("shopping") + " Back to Shop";
	
	container.appendChild(button);

	document.getElementById("goShopping").addEventListener("click", function(evt) {
		window.location.href = "../";
	},false);
}

function showReviewPage()
{
	var fd = new FormData();

	var fn = document.getElementById("custFName").value,
	sn = document.getElementById("custLName").value,
	a1 = document.getElementById("custAdd1").value,
	a2 = document.getElementById("custAdd2").value,
	a3 = document.getElementById("custAdd3").value,
	a4 = document.getElementById("custAdd4").value,
	cn = document.getElementById("custCountry").value,
	pc = document.getElementById("custPostcode").value,
	em = document.getElementById("custEmail").value;

	fd.append("fn", fn);
	fd.append("sn", sn);
	fd.append("a1", a1);
	fd.append("a2", a2);
	fd.append("a3", a3);
	fd.append("a4", a4);
	fd.append("cn", cn);
	fd.append("pc", pc);
	fd.append("em", em);

	var container = document.getElementsByClassName("right-content")[0];

	var custDetails = document.createElement("div");
	custDetails.className = "checkoutDiv detailsDiv";

	var addContainer = document.createElement("div");
	addContainer.className = "addressContent";
	addContainer.id = "finalDevContent";
	addContainer.innerHTML = "<strong>Delivery address</strong> <a href='.'>Change</a>";

	var deliveryLs = document.createElement("ul");

	var deliveryName = document.createElement("li");
	deliveryName.textContent = fn + " " + sn;
	deliveryLs.appendChild(deliveryName);

	var devLine1 = document.createElement("li");
	devLine1.textContent = a1;
	deliveryLs.appendChild(devLine1);

	if (a2.trim() !== "")
	{
		var devLine2 = document.createElement("li");
		devLine2.textContent = a2;
		deliveryLs.appendChild(devLine2);
	}

	if (a3.trim() !== "")
	{
		var devLine3 = document.createElement("li");
		devLine3.textContent = a3;
		deliveryLs.appendChild(devLine3);
	}

	if (a4.trim() !== "")
	{
		var devLine4 = document.createElement("li");
		devLine4.textContent = a4;
		deliveryLs.appendChild(devLine4);
	}

	var devCountry = document.createElement("li");
	devCountry.textContent = cn;
	deliveryLs.appendChild(devCountry);

	var devPostcode = document.createElement("li");
	devPostcode.textContent = pc;
	deliveryLs.appendChild(devPostcode);

	var contact = document.createElement("div");
	contact.className = "contactContent";
	contact.innerHTML = "<strong>Contact email</strong>"

	var email = document.createElement("p");
	email.textContent = em;

	contact.appendChild(email);

	addContainer.appendChild(deliveryLs);

	custDetails.appendChild(addContainer);
	custDetails.appendChild(contact);

	container.innerHTML = "<h1>Review Your Order</h1>";

	container.appendChild(custDetails);

	var basketPreview = document.createElement("div");
	basketPreview.className = "checkoutDiv checkoutBasket";
	basketPreview.id = "checkoutBasket";
	basketPreview.innerHTML = "<div class='checkoutBasketTitle'><strong>Basket</strong> <a href='../basket'>Edit Basket</a><div>";

	var payDiv = document.createElement("div");
	payDiv.className = "payDiv checkoutDiv";

	var placeOrder = document.createElement("div");
	placeOrder.className = "formButton basketControls payButton";
	placeOrder.id = "placeOrder";
	placeOrder.textContent = "Place Your Order";

	var total = document.createElement("div");
	total.class = "totalContainer";
	total.innerHTML = "Total: <span id='basketTotal'></span>";

	payDiv.appendChild(placeOrder);
	payDiv.appendChild(total);

	container.appendChild(basketPreview);
	container.appendChild(payDiv);

	showBasketContents();

	window.scrollTo(0,0);

	document.getElementById("placeOrder").addEventListener("click", function(evt) {
		document.getElementById("placeOrder").id = "orderPlaced";
		fd.append("oc", calculateTotal("checkoutBasket"));
		fd.append("is", localStorage.getItem("checkoutBasket"));
		ajaxHandle("", "addCustomerOrder", orderConfirm, fd);
	}, false);
}

function displayBasketItem(product)
{
	var basket = document.getElementById("checkoutBasket");

	var row = document.createElement("div");
	row.className = "checkoutItemRow";
	row.id = "row" + product.id;

	var rowName = document.createElement("div");
	rowName.className = "checkoutItemName";
	rowName.innerHTML = "<strong>" + product.name + "</strong>";

	var rowPrice = document.createElement("div");
	rowPrice.className = "checkoutItemPrice";
	rowPrice.innerHTML = "£" + product.price;

	var rowQuantity = document.createElement("div");
	rowQuantity.className = "checkoutItemQuantity";
	rowQuantity.innerHTML = "<strong>Quantity:</strong> " + product.basketQuantity;

	row.appendChild(rowName);
	row.appendChild(rowPrice);
	row.appendChild(rowQuantity);

	basket.appendChild(row);

	var display = document.getElementById("basketTotal");
	display.textContent = "£" + calculateTotal("checkoutBasket");
}

function showBasketContents()
{
	var basket = JSON.parse(localStorage.getItem("checkoutBasket"));

	for (var item in basket)
	{
		if (basket.hasOwnProperty(item))
		{
			displayBasketItem(basket[item]);
		}
	}
}

function autoFill()
{
	var fn = document.getElementById("custFName"),
	sn = document.getElementById("custLName"),
	a1 = document.getElementById("custAdd1"),
	a2 = document.getElementById("custAdd2"),
	a3 = document.getElementById("custAdd3"),
	a4 = document.getElementById("custAdd4"),
	cn = document.getElementById("custCountry"),

	pc = document.getElementById("custPostcode"),
	em = document.getElementById("custEmail");


	if(typeof(Storage)!=="undefined")
	{
		if (localStorage.getItem("customer"))
		{
			try 
			{
				var customer = JSON.parse(localStorage.getItem("customer"));
				fn.value = (typeof(customer["fn"]) !== "undefined" ? customer["fn"] : "");
				sn.value = (typeof(customer["sn"]) !== "undefined" ? customer["sn"] : "");
				a1.value = (typeof(customer["a1"]) !== "undefined" ? customer["a1"] : "");
				a2.value = (typeof(customer["a2"]) !== "undefined" ? customer["a2"] : "");
				a3.value = (typeof(customer["a3"]) !== "undefined" ? customer["a3"] : "");
				a4.value = (typeof(customer["a4"]) !== "undefined" ? customer["a4"] : "");
				cn.value = (typeof(customer["cn"]) !== "undefined" ? customer["cn"] : "");
				pc.value = (typeof(customer["pc"]) !== "undefined" ? customer["pc"] : "");
				em.value = (typeof(customer["em"]) !== "undefined" ? customer["em"] : "");
			}
			catch (err) 
			{
				localStorage.setItem("customer","{}");
			}
		}		
	} 
	else { alert("No support for web storage, please upgrade your browser"); }
}

function saveAddressLocal()
{
	var fn = document.getElementById("custFName"),
	sn = document.getElementById("custLName"),
	a1 = document.getElementById("custAdd1"),
	a2 = document.getElementById("custAdd2"),
	a3 = document.getElementById("custAdd3"),
	a4 = document.getElementById("custAdd4"),
	cn = document.getElementById("custCountry"),
	pc = document.getElementById("custPostcode"),
	em = document.getElementById("custEmail"),
	customer = {};

	if(typeof(Storage)!=="undefined")
	{
		try 
		{
			 customer["fn"] = fn.value;
			 customer["sn"] = sn.value;
			 customer["a1"] = a1.value;
			 customer["a2"] = a2.value;
			 customer["a3"] = a3.value;
			 customer["a4"] = a4.value;
			 customer["cn"] = cn.value;
			 customer["pc"] = pc.value;
			 customer["em"] = em.value;
			 localStorage.setItem("customer", JSON.stringify(customer));
			 console.log("should be saved.");
		}
		catch (err) 
		{
			console.log("an error occurred");
			localStorage.setItem("customer","{}");
		}	
	} 
	else { alert("No support for web storage, please upgrade your browser"); }
}

function addEventListeners()
{

	document.querySelector("body").addEventListener("input", function(evt) {
		if (evt.target.className == "custDetails")
		{
			validateInput(evt.target);
		}
	}, false);

	document.getElementById("toReview").addEventListener("click", function(evt) {
		var form = document.getElementsByTagName("form")[0];
		if(validateForm(form))
		{
			var save = document.getElementById("saveDetails").checked;
			if (save) { saveAddressLocal(); }
			showReviewPage();
		}
	}, false);
}

/*if (!(document.referrer == "http://localhost/660273/basket/" || document.referrer == "http://localhost/660273/checkout/"))
{
	window.location.href = "../basket";
}*/

window.addEventListener("load", addEventListeners, false);
window.addEventListener("load", autoFill, false);

