function isEmpty(key)
{
	if(typeof(Storage)!=="undefined")
	{
		if (localStorage.getItem(key))
		{
			try 
			{
				var object = JSON.parse(localStorage.getItem(key));
				var length = 0;
				for (var item in object)
				{	
					length++;
					//console.log(length);
				}

				console.log(length);

				if (length <= 0) { return true; }
				else { return false; }
			}
			catch (err) 
			{
				localStorage.setItem(key,"{}");
				return true;
			}
		}
		else {
			return true;
		}		
	} 
	else 
	{ 
		alert("No support for web storage"); 
		return true;
	}
}

function localUsable()
{
	if(typeof(Storage)!=="undefined")
	{
		return true;
	}
	else
	{
		alert("No support for web storage, please upgrade your browser");
		return false;
	}
}

function emptyLocalStorage()
{
	if (localUsable())
	{
		localStorage.setItem("basket", "");
		localStorage.setItem("checkoutBasket", "");
		localStorage.setItem("customer", "");
	}
}