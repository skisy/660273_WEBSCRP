function updateAJAX(json)
{

	document.write(JSON.stringify(json, null, 4));

	var string = '{"id":"219","cat_name":"Big Yachts"}';
	var jsonSend = JSON.parse(string);

	var xhr = new XMLHttpRequest();
	xhr.open("PATCH", "assets/db/db_update_category.php", true)
	xhr.send(JSON.stringify(jsonSend));
}