function pokaziMatricu() {	
	var radio = document.querySelector('input[name="operacija"]:checked').value;

	var container = document.getElementById("matrica");
	var pocetna = document.getElementById("PocetnaMatrica");
	pocetna.style.visibility = "visible" ;

	while (container.hasChildNodes()) {
		container.removeChild(container.lastChild);
    }

	for (x = 0; x < radio; x++)
	{
		for(y = 0; y < radio; y++){
				
			var input = document.createElement("input");
			input.type = "text";
			input.name = "a" + x + y;
			input.size = "2";
			input.style = "margin: 2px;";
			input.maxLength = "3";
			container.appendChild(input);						
		}
		container.appendChild(document.createElement("br"));
	}
}
function provjeriRadio(){
	var radios = document.getElementsByTagName('input');
	var oznaceno = false;
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].type === 'radio' && radios[i].checked) {	        
	       oznaceno = true;
	    }
	}
	if(oznaceno)
		pokaziMatricu();
	else
		alert("Označite veličinu početne matrice!");
}

function provjeriInput(){
	var matrica = document.getElementsByTagName('input');
	var nul = false;

    for (i = 0; i < matrica.length; i++) {
    	if(matrica[i].type == "text")
        	if(matrica[i].value == 0)
        		nul = true;
    }
    if(nul){
    	alert("Matrica nije popunjena!");
    	return false;
    }	
    else return true;
}