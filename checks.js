/*checkplaces: funzione utilizzata per controllare dati immessi nella form iniziale
  onechoice: funzione utilizzata per controllare de l'utente ha scelto un viaggio o no
  check_info: funzione utilizzata per controllare i campi utilizzati nella form di invio
  prenotazione e creare dati utili nella pagina successiva
  check_bissestile: funzione utilizzata per controllare se un anno è bisestile o no
  set_month: funzione utilizzata per trasformare il mese da stringa a numero*/


function checkplaces(){
	var exec = document.getElementById("first");
	var work = document.getElementById("departure");
	var partenza = work.options[work.selectedIndex].value;
	work = document.getElementById("destination");
	var arrivo = work.options[work.selectedIndex].value;
	if (partenza == arrivo){
		window.alert("Citt\xE0 di Partenza e Citt\xE0 di Arrivo coincidono. Impossibile continuare.");
		work.focus();
		}
	else {
		var day = new Date();
		var day_selected = document.getElementsByName("day")[0].options[document.getElementsByName("day")[0].selectedIndex].value;
		var month_selected = document.getElementsByName("month")[0].options[document.getElementsByName("month")[0].selectedIndex].value;
		var year_selected = document.getElementsByName("year")[0].options[document.getElementsByName("year")[0].selectedIndex].value;
		month_selected = set_month(month_selected);
		if(day_selected == "" || month_selected == "" || year_selected == "" ){
			window.alert("Non \u00E8 stato specificata interamente la data. Non \u00E8 possibile proseguire");
			return false;
			}	
		else{
			var control = 0;
			var cr_day = day.getDate();
			var cr_month = day.getMonth();
			var cr_year = day.getFullYear();
			if(year_selected > cr_year){control++;}
			if(year_selected == cr_year && ((month_selected-1) > cr_month)){control++;}
			if(year_selected == cr_year && (month_selected-1) == cr_month && day_selected >= cr_day){control++;}
			if(control ==0){
				window.alert("La data inserita non \u00E8 valida. Riprovare.");
				return false;
				}		
			if(day_selected == 29 && month_selected == 2 && !check_bissestile(year_selected)){
				window.alert("Hai specificato la data del 29 Febbraio per un anno non bisestile. Non puoi proseguire.")
				return false;
				}			
			else exec.submit();
			}
		}
	}

function one_choice(){
	var result = document.getElementsByName("scelta");
	var form = document.getElementById("second");
	var just = 0, i;
	for(i = 0; i < result.length; i++){
		if(result[i].checked) just = result[i].value;
		}
	if (just == 0) window.alert("Non hai selezionato nessun viaggio!");
	else form.submit();
	}
	
function check_info(){
		var name = document.getElementsByName("name")[0];
		var surname = document.getElementsByName("surname")[0];
		var cell = document.getElementsByName("cell")[0];
		var comune = document.getElementsByName("birth_place")[0];

		var name_ex = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]{2,}\s?)+$/;
		if(!name_ex.test(name.value) || name.value == "" || name.value == "undefined" ){
			window.alert("Non hai inserito correttamente il Nome.");
			name.focus();
			name.select();
			return false;
				}
				
		if(!name_ex.test(surname.value) || surname.value == "" || surname.value == "undefined" ){
			window.alert("Non hai inserito correttamente il Cognome.");
			surname.focus();
			surname.select();
			return false;
				}
		
		var cell_ex = /^[+\d]{6,}$/;
		if(!cell_ex.test(cell.value) || cell.value == "" || cell.value == "undefined" ){
			window.alert("Non hai inserito correttamente il tuo numero di cellulare.");
			cell.focus();
			cell.select();
			return false;
			}

		if(!name_ex.test(comune.value) || comune.value == "" || comune.value == "undefined" ){
			window.alert("Non hai inserito correttamente il Comune di Nascita.");
			comune.focus();
			comune.select();
			return false;
				}

		var year = document.getElementsByName("birth_year_date")[0].options[document.getElementsByName("birth_year_date")[0].selectedIndex];
		var check = year.value;
		var bix = check_bissestile(check);
		if(!bix && (document.getElementsByName("day")[0].options[document.getElementsByName("day")[0].selectedIndex].value == 29) 
		   && (document.getElementsByName("month")[0].options[document.getElementsByName("month")[0].selectedIndex].value == "Febbraio")){
				window.alert("Hai selezionato il giorno 29 Febbraio di un anno non bisestile.");
				year.focus();
				year.select();
				return false;
				}
				
	if ((document.getElementsByName("ARANCIONE").length == 0) && (document.getElementsByName("arancione").length == 0)) {
		alert("Non hai selezionato nessun posto. Per proseguire, devi selezionarne necessariamente uno.");
		return false;
		}
		
	var decision = document.getElementsByName("list")[0].value;
	var length_1 = document.getElementsByName("place_number")[0].value;
	var length_2 = document.getElementsByName("bed_number")[0].value;
	for(var i = 0; i < length_1; i++){
		var elem = document.getElementsByName("arancione_"+i)[0].value;
		if(elem.length == 1) decision += ("00" + elem);
		if(elem.length == 2) decision += ("0" + elem);
		if(elem.length == 3) decision += (elem);
		
		decision += "_";
		}
		
	for(var i = 0; i < length_2; i++){
		var elem = document.getElementsByName("ARANCIONE_"+i)[0].value;
		decision += (elem);
		decision += "_";
		}
	document.getElementsByName("list")[0].value = decision;
	document.forms[0].submit();
	}

function check_bissestile(year){
	if(year % 4 == 0 && (year % 100 != 0 || year % 400 == 0)) return true;
	return false;
	}

function set_month(month){
	var months = new Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno",
						   "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre");
	var i;
	for( i = 0; i < 12; i++){
		if(month == months[i]) month = (i+1);
		}
	return month;
	}
