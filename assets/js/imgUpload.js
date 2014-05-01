function imageUpload(id) 
{
	var input = document.getElementById(id);
	var image = input.files[0];
	var data = new FormData();
	data.append("imgFile", image);

	var xhr = new XMLHttpRequest();

	xhr.open('POST', '/660273/assets/php/upload.php', true);

	xhr.addEventListener("load", contentLoaded, false);
	xhr.upload.addEventListener("loadstart", loadStartHandle, false);
	xhr.upload.addEventListener("progress", updateProgress, false);
	xhr.addEventListener("error", uploadFail, false);

	/*var failedUpDiv = document.getElementById("upFail");
	console.log(failedUpDiv != null);*/

	var imgContainer = document.createElement("div");
	var upImgDiv = document.createElement("div");
	var upImg = document.createElement("img");
	var statusDiv = document.createElement("div");
	var uploadedImage = "";
	var progressBar = "";
	var progressWrapper = "";
	var statusText = document.createElement("p");
	var loadObj = document.createElement("object");

	if (id == "imgFile")
	{
		console.log(id);
		uploadedImage = document.getElementById("mainImage");
		progressBar = document.getElementById("progressBar");
		progressWrapper = document.getElementById("progressWrapper");
	}
	else
	{
		var num = id.replace("exImgFile", "");
		uploadedImage = document.getElementById("exImg" + num);
		progressBar = document.getElementById("exProgressBar" + num);
		progressWrapper = document.getElementById("exProgressWrap" + num);
	}

	function loadStartHandle() 
	{
		document.getElementById("formSave").disabled = true;
		document.getElementById(id).disabled = true;

		upImg.className = "upImg";

		loadObj.data = "/660273/img/img-loader.svg.php";
		loadObj.type = "image/svg+xml";
		loadObj.className = "svgLoader";

		upImgDiv.appendChild(loadObj);
		upImgDiv.className = "upImgDiv";

		statusDiv.className = "hideStatus";
		statusDiv.appendChild(statusText);

		imgContainer.className = "imgContainer";
		imgContainer.id = "upFail";
		imgContainer.appendChild(statusDiv);
		imgContainer.appendChild(upImgDiv);

	/*	if (failedUpDiv == null) {
			uploadedImages.appendChild(imgContainer);
		}
		else
		{
			failedUpDiv.parentNode.replaceChild(imgContainer, failedUpDiv);
		}*/
		
		uploadedImage.innerHTML = "";					// For single image normally would just write HTML as string with relevant attributes
		uploadedImage.appendChild(imgContainer);		// This enables previous code to remain same in case multiple image upload enabled

		progressWrapper.className = "showProgress";
		progressBar.className = "progressBar";
		progressBar.value = 0;
		progressBar.textContent = progressBar.value;

		statusText.innerHTML = "";
	}

	function contentLoaded() 
	{
		if (this.status == 200) {

			var tempResult = xhr.response;
			
			switch (tempResult) {
				case "nofile":
					statusText.innerHTML = "You didn't select a file! Click 'Choose File' and select a file to upload";
					upResult(false);
					break;
				case "sizelimit":
					statusText.innerHTML = "The file is too big! You must upload a file less than 2MB";
					upResult(false);
					break;
				case "unknown":
					statusText.innerHTML = "Something went wrong. Try again.";
					upResult(false);
					break;
				case "format":
					statusText.innerHTML = "The file must be an accepted image type (jpg, gif, png)";
					upResult(false);
					break;
				case "move":
					statusText.innerHTML = "Couldn't save file. Try again!";
					upResult(false);
					break;
				default:
				//console.log(tempResult);
					if (fileExists(input) === false)
					{
						var result = JSON.parse(xhr.response);
						upImg.src = result.dataUrl;
						upImg.alt = "Uploaded Picture";
						imgContainer.id = "upSuccess";
						statusText.innerHTML = "Successfully Uploaded!";
						upResult(true);
					}
					else
					{
						statusText.innerHTML = "You can't upload two files with the same filename!";
						upResult(false);
					}
					
					break;
			}	

			upImgDiv.replaceChild(upImg, loadObj);

			document.getElementById("formSave").disabled = false;

		}
	}

	function fileExists(fileInput)
	{
		var fileElements = document.getElementsByClassName("upFile");
		var exists = false;
		var i = 0;

		while (exists === false && i < fileElements.length)
		{
			if (fileElements[i].id !== fileInput.id)
			{
				exists = (fileElements[i].value == fileInput.value);
			}

			i++;

		}

		return exists;	
	}

	function upResult(isSuccessful) {

		if (isSuccessful)
		{
			progressBar.className = "progress-success";
			statusText.className = "status success";
		}
		else
		{
			progressBar.className = "progress-fail";

			statusText.className = "status error";	
			upImg.src = "/660273/img/no_picture.gif";
			upImg.alt = "No Picture Uploaded";

			var oldIn = input;
			var newIn = document.createElement("INPUT");

			newIn.type = "file";
			newIn.id = oldIn.id;
			newIn.name = oldIn.name;
			newIn.className = oldIn.className;
			newIn.accept = oldIn.accept;
			newIn.required = oldIn.required;

			oldIn.parentNode.replaceChild(newIn, oldIn);

			newIn.focus();
		}

		statusDiv.addEventListener("mouseover", function() 
		{
			clearTimeout(timeout);
		}, false);

		statusDiv.addEventListener("mouseout", function()
		{
			setTimeout(hideStatusNotif, 2000);
		},false);


		statusDiv.className = "showStatus";
		var timeout = setTimeout(hideStatusNotif, 3500);

		function hideStatusNotif()
		{
			document.getElementById(id).disabled = false;
			statusDiv.className = "hideStatus";
			progressWrapper.className = "hideProgress";
		}
	}

	function uploadFail() {
		console.log("Content load failed, please try again.");
	}
	
	function updateProgress(evt) {
		if (evt.lengthComputable) 
		{
			progressBar.value = (evt.loaded / evt.total) * 100;
			progressBar.textContent = progressBar.value;
			console.log(progressBar.value);
		}
	}
	
	xhr.send(data);
}