function showSummary(summary)
{
	var container = document.getElementById("adminOverviewText");
	var income = (summary.income == null ? "0.00" : summary.income);

	container.innerHTML = "<div class='summaryDiv'><strong>Total Income:</strong><span class='boldgreen'> £" + income + "</span></div>"  
	container.innerHTML += "<strong>Orders</strong><ul><li>There are <strong>" + summary.awaitDis + "</strong> orders awaiting dispatch</li><li>There are <strong>" + summary.awaitDeli + "</strong> dispatched orders being delivered</li></ul>";
	container.innerHTML += "<strong>Stock Warnings</strong><ul><li><strong>" + summary.lowstock + "</strong> item(s) with low stock (>10)</li><li><strong>" + summary.nostock + "</strong> item(s) out of stock</li></ul>";
	container.innerHTML += "<strong>Popular Products</strong><ol id='popularProds'></ol>";

	var popCon = document.getElementById("popularProds");
	var popular = summary.popular;

	for (var item in popular)
	{
    if (popular.hasOwnProperty(item))
   {
          var li = document.createElement("li");
          li.innerHTML = popular[item].name + " (" + popular[item].quantity + " units sold)";
      
          popCon.appendChild(li);
  	}
	}
}

function showOrders(orders)
{
	var dispatchCon = document.getElementById("awaitingDispatchBody");
	var deliveryCon = document.getElementById("awaitingDeliveryBody");
	dispatchCon.innerHTML = "";
	deliveryCon.innerHTML = "";

	for (var line in orders)
	{
    if (orders.hasOwnProperty(line))
    {
		var tr = document.createElement("tr");
		tr.id = "order" + orders[line].id;

		var oId = document.createElement("td");
		oId.textContent = orders[line].id;
		oId.className = "disField";

		var income = document.createElement("td");
		income.textContent = "£" + orders[line].cost;
		income.className = "disField";

		var datePlaced = document.createElement("td");
		datePlaced.innerHTML = orders[line].date;
		datePlaced.className = "disField";

		tr.appendChild(oId);
		tr.appendChild(income);
		tr.appendChild(datePlaced);

		if (!(orders[line].dispatched == 1 && orders[line].delivered == 1))
		{
			if (orders[line].dispatched == 1)
			{
				var dateDis = document.createElement("td");
				dateDis.innerHTML = orders[line].disDate;
				tr.appendChild(dateDis);
				dateDis.className = "devField";

				var delivered = document.createElement("td");
				delivered.className = "deliveredLink tableLink";
				delivered.id = "delivered" + orders[line].id;
				delivered.innerHTML = "<a class='noLink'>Mark as delivered</a>";
				tr.appendChild(delivered);

				var view = document.createElement("td");
				view.className = "tableLink";
				view.id = "delivered" + orders[line].id;
				view.innerHTML = "<a class='viewLink' href='orderProducts?order=" + orders[line].id + "'>View</a>";
				tr.appendChild(view);

				deliveryCon.appendChild(tr);
			}
			else
			{
				var dispatch = document.createElement("td");
				dispatch.innerHTML = "<a class='noLink'>Mark as dispatched</a>";
				dispatch.className = "dispatchLink tableLink";
				dispatch.id = "dispatch" + orders[line].id;
				tr.appendChild(dispatch);
				dispatchCon.appendChild(tr);

				var view = document.createElement("td");
				view.className = "tableLink";
				view.id = "delivered" + orders[line].id;
				view.innerHTML = "<a class='viewLink' href='orderProducts?order=" + orders[line].id + "'>View</a>";
				tr.appendChild(view);
			}
		}
   }
	}
}

function updateTables()
{
	ajaxHandle("", "getOrders", showOrders);
}

function addEventListeners()
{
	document.querySelector("body").addEventListener("click", function(evt) {
			var target = evt.target;
		if (target.className.indexOf("dispatchLink") !== -1)
		{
			var id = target.id.replace("dispatch","");
			target.parentNode.style.transition = "all .5s";
			target.parentNode.style.opacity = "0";

			var json = JSON.parse('{"id":"' + id + '","o_dispatched":1}');

			ajaxHandle("", "updateOrder", updateTables, json);
		}

		if (target.className.indexOf("deliveredLink") !== -1)
		{
			var id = target.id.replace("delivered","");
			target.parentNode.style.transition = "all .5s";
			target.parentNode.style.opacity = "0";

			var json = JSON.parse('{"id":"' + id + '","o_delivered":1}');

			ajaxHandle("", "updateOrder", updateTables, json);
		}
	},false);
}

window.addEventListener("load", addEventListeners, false);
window.addEventListener("load", function(evt) {
	var elem;

	if (elem = document.getElementById("adminOverviewText"))
	{
		ajaxHandle("", "getSummary", showSummary);
	}

	if (elem = document.getElementById("awaitingDispatch"))
	{
		ajaxHandle("", "getOrders", showOrders);
	}

	document.querySelector("body").addEventListener("click", function(evt) {
		var target = evt.target;
		switch (target.id)
		{
			case "shopHomeLink":
				window.location.href = "/660273/";
				break;
			case "cmsHomeLink":
				window.location.href = "/660273/cms";
				break;
			case "adminHomeLink":
				window.location.href = "/660273/admin";
				break;
			case "orderManagementLink":
				window.location.href = "/660273/admin/orderManagement";
				break;
			case "siteSettingsLink":
				window.location.href = "/660273/admin/siteSettings";
				break;
			case "initialSetupLink":
				window.location.href = "/660273/admin/setup";
				break;
			default:
				break;
		}
	},false);
}, false);