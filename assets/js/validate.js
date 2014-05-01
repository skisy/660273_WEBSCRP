function checkJSON(string)
{
	try 
	{
		JSON.parse(string);
	}
	catch (err)
	{
		return false;
	}
	return true;
}

function checkValidDifference()
{
	var min = parseFloat(document.getElementById("attrMin").value);
	var max = parseFloat(document.getElementById("attrMax").value);
	var container = document.getElementById("minMaxDif");

	if (min > max && !isNaN(min) && !isNaN(max))
	{
		container.className = "showStatus";
		document.getElementById("attrMin").style.border = "1px solid red";
		document.getElementById("attrMax").style.border = "1px solid red";
		return false;
	}
	else
	{
		container.className = "hideStatus";
		document.getElementById("attrMin").style.border = "";
		document.getElementById("attrMax").style.border = "";
		return true;
	}
}

function validateForm(form)
{	
	var group, radioValid = true;
	try {
		if (group = document.getElementsByName("selectedCat"))
		{
			if (!validateRadioButtons(group)) { radioValid = false; }
			console.log(radioValid);
		}
	}
	catch (err) { console.log("No radio group"); }
  // Convert nodelists to arrays
	var inputs = Array.prototype.slice.call(form.getElementsByTagName("input")),
		textareas = Array.prototype.slice.call(form.getElementsByTagName("textarea")),
		selects = Array.prototype.slice.call(form.getElementsByTagName("select"));

	var elems = inputs.concat(textareas).concat(selects);
	var validArr =[];
	var i;

	for (i = 0; i < elems.length; i++)
	{
		var elem = elems[i];
		console.log(elem);
		validArr[i] = validateInput(elem, true);
	}

	for (i = 0; i < validArr.length; i++)
	{
		if (validArr[i] === false) { return false; }
	}

	return radioValid && true;
}

function validateRadioButtons(group)
{
	var valid = false;
	var i = 0;
	var warning = document.getElementById("selectedCatMsg");
	var msg = warning.getElementsByTagName("p")[0];
	var container = document.getElementById("parentCat");

	while (!valid && i < group.length)
	{
		if (group[i].checked) { valid = true; }
		i++;	
	}

	if (!valid)
	{
		container.style.border = "1px solid red";
		msg.innerHTML = "<strong>Category</strong> is a required field";
		warning.className = "showStatus";
	}
	else 
	{
		container.style.border = "";
		warning.className = "hideStatus";
	}
	return valid;
}

function associateLabels()
{
	var labels = document.getElementsByTagName("label");

	for (var i = 0; i < labels.length; i++)
	{
		var element = document.getElementById(labels[i].htmlFor);
		if (element) { element.label = labels[i]; }
	}
}

function validateTextarea(elem)
{
	var warning = document.getElementById(elem.name + "Msg");
	var warningMsg = warning.getElementsByTagName("p")[0];
	var fieldName = elem.label.innerHTML.replace(":","");
	var hasMsg, chars;
	var regEx = new RegExp("^[A-Za-z0-9]{1}[A-Za-z0-9\x20\x26\x22\x27\\.\\+\\-\\*\\/\\,\\(\\)]+$");

	if (elem.id == "addItemDesc") { hasMsg = true; }

	if (elem.value.trim() == "")
	{
		if (hasMsg) {
			warningMsg.innerHTML = "<strong>" + fieldName + "</strong> is a required field";
			warning.className = "showStatus"; 
			elem.style.border = "1px solid red";
		}
		return false;
	}
	else if (elem.value.length == 1)
	{

	}
	else if (!elem.value.match(regEx))
	{
		warningMsg.innerHTML = "Invalid characters present. Valid characters:";
		warning.className = "showStatus";
		elem.style.border = "1px solid red";
	}
	else
	{
		warning.className = "hideStatus";
		elem.style.border = "";
		return true;
	}
}

function validateInput(elem, formValidate)
{
	associateLabels();

	if (elem.name === "exImgFile" || elem.id == "metaPreset") { return true; }

	var tag = elem.tagName.toLowerCase();
	var warning = (elem.type != "radio" ? document.getElementById(elem.id + "Msg") : document.getElementById(elem.name + "Msg"));
	var warningMsg = warning.getElementsByTagName("p")[0];
	var startChar = elem.value.charAt(0);
	var endChar = elem.value.charAt(elem.value.length - 1);
	var valid = true;
	var fieldName;

	if ((tag === "input" || tag === "select") && elem.type !== "radio" )
	{
		if (elem.type !== "radio") { fieldName = elem.label.innerHTML.replace(":", ""); }

		if (elem.validity.typeMismatch)	{ console.log(elem, elem.dataset.exType); warningMsg.innerHTML = "<strong>" + elem.dataset.extype + "</strong> expected"; }

		if (elem.required === true && elem.value.trim() == "") 
		{
			warningMsg.innerHTML = "<strong>" + fieldName + "</strong> is a required field";
			valid = false;
		}
		if (elem.validity.valueMissing)	{ warningMsg.innerHTML = "<strong>" + fieldName + "</strong> is a required field"; }

		if (tag === "input" && (startChar == "&" || startChar == '"' || startChar == "(" || startChar == ")")) 
		{
			warningMsg.innerHTML = "<strong>" + fieldName + "</strong> cannot start with <strong>" + startChar + "</strong>"; 
		} 
		else if (elem.validity.patternMismatch)
		{
			warningMsg.innerHTML = "Permitted Characters: <strong>" + elem.dataset.pat + "</strong>";
		}
		else if (tag === "input" && endChar === "&")
		{
			warningMsg.innerHTML = "<strong>" + fieldName + "</strong> cannot end with <strong>" + endChar + "</strong>";
			valid = false;
		}

		if (elem.validity.rangeUnderflow) { warningMsg.innerHTML = "Value must be at least <strong>" + elem.min + "</strong>"; }
		if (elem.validity.rangeOverflow) { warningMsg.innerHTML = "Value must not be more than <strong>" + elem.max + "</strong>"; }
		if (elem.validity.stepMismatch) { warningMsg.innerHTML = "Accepted increments: <strong>" + elem.dataset.step + "</strong>"; }
		if (elem.validity.badInput) { warningMsg.innerHTML = "The correct input type is: <strong>" + elem.dataset.type + "</strong>"; }

		var val;
		if (!elem.validity.valueMissing && (elem.dataset.type == "Currency (Decimal)" || elem.dataset.type == "Integer"))
		{
			val = elem.value;
			if(isNaN(val))
			{
				//valid = false;
				warningMsg.innerHTML = "The correct input type is: <strong>" + elem.dataset.type + "</strong>";
			}
			else if (val < elem.min)
			{
				valid = false;
				warningMsg.innerHTML = "Value must be at least <strong>" + elem.min + "</strong>"
			}
		}

		if (elem.checkValidity() && valid) 
		{
			if ((elem.id === "attrMax" || elem.id === "attrMin") && !checkValidDifference())
			{
				warning.className = "hideStatus";
				console.log("Invalid Dif");
				return false;
			}
			else 
			{
				warning.className = "hideStatus";
				elem.style.border = "";
				return true;
			}
		}
		else
		{
			if ((warningMsg.innerHTML.indexOf(elem.dataset.extype) !== -1 && !formValidate))
			{
				warning.className = "hideStatus";
			}
			else
			{
				warning.className = "showStatus"; 
				elem.style.border = "1px solid red";
				return false;
			}
		}
	}
	else if (tag == "textarea")
	{
		return validateTextarea(elem);
	}
}

