function createOrderTable(products)
{
	var container = document.getElementById("orderProductsBody");

	if (JSON.stringify(products) == "[]")
	{
		container.parentNode.style.visibility = "hidden";
	}
	else
	{
		for (var prod in products)
		{
			if (products.hasOwnProperty(prod))
			{
				var tr = document.createElement("tr");
				tr.id = "orderProduct" + products[prod].id;

				var name = document.createElement("td");
				name.innerHTML = "<a class='viewLink' href='/660273/product?product=" + products[prod].id + "'>" + products[prod].name + "</a>";
				name.className = "orderProductField";

				var price = document.createElement("td");
				price.textContent = "£" + products[prod].price;
				price.className = "orderProductField";

				var quantity = document.createElement("td");
				quantity.textContent = products[prod].quantity;
				quantity.className = "orderProductField";

				tr.appendChild(name);
				tr.appendChild(price);
				tr.appendChild(quantity);
				container.appendChild(tr);
			}
		}
		container.parentNode.style.visibility = "visible";
	}
}