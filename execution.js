/*change_color e change_color_2: funzioni utilizzate per analizzare i posti e cambiare colore, settare la form in basso nella pagina place.php
  create_select: funzione utilizzata per creare i valori della select relativa alla data in 2 pagine
  create_legend: funzione utilizzata per creare la legenda dei posti
  add_auto e add_moto: funzioni utilizzate per aggiungere o togliere il prezzo di auto e moto al totale*/

var contatore = 0;
var CONTATORE = 0;
var prezzo = 0;

function change_color(id){
	var rep = id.replace("p","D");
	var work = document.getElementById(rep);
	var img = document.getElementById(id);
	var color = img.getAttribute("name");
	var price = document.getElementById("costo_posto").value;
	if(color == "verde"){
		document.getElementById("prenotazione").style.display = "inline";
		document.getElementById("full").style.display = "inline";
		img.src = "../images/bullet_selezionato.png";
		img.name = "arancione";
		var input = document.createElement("INPUT");
		input.type = "hidden";
		input.name = ("arancione_"+contatore);
		input.value = id.substr(1,(id.length-1));
		contatore++;
		work.appendChild(input);
		document.getElementsByName("place_number")[0].value++;
		prezzo+=parseInt(price);
		}
	else{
		img.src = "../images/bullet_disponibile.png";
		img.name = "verde";
		work.removeChild(work.childNodes[1]);
		contatore--;
		document.getElementsByName("place_number")[0].value--;
		if((document.getElementsByName("place_number")[0].value == 0) && (document.getElementsByName("bed_number")[0].value == 0))
			{
				document.getElementById("prenotazione").style.display = "none";
				document.getElementById("full").style.display = "none";
			}
		prezzo-=parseInt(price);
		}
	document.getElementById("cast_price").value = prezzo;
	}

function change_color_2(id){
	var rep = id.replace("l","V");
	var work = document.getElementById(rep);
	var img = document.getElementById(id);
	var color = img.getAttribute("name");
	var price = document.getElementById("costo_letto").value;
	if(color == "VERDE"){
		document.getElementById("prenotazione").style.display = "inline";
		document.getElementById("full").style.display = "inline";
		img.src = "../images/poltrona_selezionata.png";
		img.name = "ARANCIONE";
		var input = document.createElement("INPUT");
		input.type = "hidden";
		input.name = ("ARANCIONE_"+CONTATORE);
		input.value = id.substr(1,(id.length-1));
		CONTATORE++;
		work.appendChild(input);
		document.getElementsByName("bed_number")[0].value++;
		prezzo+=parseInt(price);
		}
	else{
		img.src = "../images/poltrona_disponibile.png";
		img.name = "VERDE";
		work.removeChild(work.childNodes[1]);
		CONTATORE--;
		document.getElementsByName("bed_number")[0].value--;
		if((document.getElementsByName("place_number")[0].value == 0) && (document.getElementsByName("bed_number")[0].value == 0))
			{
				document.getElementById("prenotazione").style.display = "none";
				document.getElementById("full").style.display = "none";
			}
		prezzo-=parseInt(price);
		}
	document.getElementById("cast_price").value = prezzo;
	}

function create_select(n){
	var find = document.getElementsByTagName("select");
	var i;
	var months = new Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
	if(n == 2) var year = 2013;
	else var year = 1920;
	for(i = 0; i <32; i++){
		var opt = document.createElement("OPTION");
		if(i == 0) var text = document.createTextNode("");
		else{
			if(i < 10) var text = document.createTextNode("0"+ i);
			else var text = document.createTextNode(i);
			}
		opt.appendChild(text);
		find[n].appendChild(opt);
		}
	for(i = 0; i < 13; i++){
		var opt_2 = document.createElement("OPTION");
		if(i == 0) var text_2 = document.createTextNode("");
		else var text_2 = document.createTextNode(months[i-1]);
		opt_2.appendChild(text_2);
		find[(n+1)].appendChild(opt_2);
		}
	if(n == 2) var length = 5;
	else var length = 95;
	for(i = 0; i < length; i++){
		var opt_3 = document.createElement("OPTION");
		if(i == 0) var text_3 = document.createTextNode("");
		else var text_3 = document.createTextNode(parseInt(year)+parseInt(i-1));
		opt_3.appendChild(text_3);
		find[(n+2)].appendChild(opt_3);
		}	
	if (n == 0) create_legend();
	}
	
function create_legend(){
	var legend = document.getElementById("legenda");
	var source = new Array("../images/bullet_disponibile.png","../images/bullet_occupato.png",
						   "../images/bullet_non_disponibile.png","../images/bullet_selezionato.png",
						   "../images/poltrona_disponibile.png","../images/poltrona_occupata.png",
						   "../images/poltrona_non_disponibile.png","../images/poltrona_selezionata.png");
	var alt = new Array("posto_libero","posto_occupato","posto_non_disponibile","posto_selezionato",
						 "letto_libero","letto_occupato","letto_non_disponibile","letto_selezionato");
	var elems = new Array("Posto disponibile","Posto occupato","Posto non disponibile","Posto selezionato",
						   "Letto disponibile", "Letto occupato", "Letto non disponibile", "Letto selezionato");
	var tab = document.createElement("table");
	tab.id = "tab_leg";
	legend.appendChild(tab);
	for( var i = 0; i < 8; i++){
		var row = document.createElement("tr");
		var data = document.createElement("td");
		var text = document.createElement("td");
		var image = document.createElement("img");
		var what = document.createTextNode(elems[i]); 
		image.src = source[i];
		image.alt = alt[i];
		text.appendChild(what);
		data.appendChild(image);
		row.appendChild(data);
		row.appendChild(text);
		tab.appendChild(row);
		}
	}

	
function add_auto(){
	if(document.getElementsByName("auto")[0].checked) prezzo+=parseInt("20");
	else prezzo-=parseInt("20");
	document.getElementById("cast_price").value = prezzo;
	}

function add_moto(){
	if(document.getElementsByName("moto")[0].checked) prezzo+=parseInt("15");
	else prezzo-=parseInt("15");
	document.getElementById("cast_price").value = prezzo;
	}
