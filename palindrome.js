//Send function
function sendData() {
	var xml = new XMLHttpRequest();
	var inputVal = encodeURIComponent(document.querySelector("#inp_Pal").value);
	var answerDiv = document.querySelector("#answer");
	var url = "palindrome.php?input=" + inputVal;
	xml.open("GET", url, true);

	xml.onreadystatechange = function() {
		if(xml.readyState == 4 && xml.status == 200) {
			var returned_data = xml.responseText;
			if(returned_data) {
				answerDiv.innerHTML = returned_data;
			} 
			
		}
	}

	xml.send();
	document.querySelector('#answer').innerHTML = "Нужно ввести 3 символа";
}