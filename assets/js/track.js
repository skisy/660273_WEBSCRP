function showOrderStatus(result)
{
	var container = document.getElementById("orderStatus");

	if(JSON.stringify(result) == "[]")
	{
		container.innerHTML = "No order found.";
	}
	else
	{
		container.innerHTML = "<strong>Order Status:</strong> ";
		if (!result["dispatched"] && !result["delivered"])
		{
			container.innerHTML += "<span class='orderStatusResult'>Processing</span>";
		}
		else if (result["delivered"])
		{
			container.innerHTML += "<span class='orderStatusResult'>Delivered</span> on " + result["deliverDate"];
		}
		else if (result["dispatched"])
		{
			container.innerHTML += "<span class='orderStatusResult'>Dispatched</span> on " + result["dispatchDate"];
		}
	}
}

function addEventListeners()
{
	document.getElementById("trackBtn").addEventListener("click", function(evt) {
		var elem = document.getElementById("refNum");
		var id = elem.value;
		if (validateInput(elem))
		{
			document.getElementById("orderStatus").innerHTML = "<img class='centered' src='../img/loader.gif'>";
			ajaxHandle(id, "order", showOrderStatus);
			ajaxHandle(id, "orderProducts", createOrderTable);
		}
	}, false);

	document.getElementById("refNum").addEventListener("input", function(evt) {
		validateInput(evt.target);
	}, false);

	document.getElementById("goShopping").addEventListener("click", function(evt) {
		window.location.href = "/660273";
	},false);
}

window.addEventListener("load", addEventListeners, false);