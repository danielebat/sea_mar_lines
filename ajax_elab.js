/*ajax_delete(): funzione utilizzata per cancellare la prenotazione selezionata con password*/

function ajax_delete(){
	var xmlHttp;
	var pwd = document.getElementsByName("pwd_delete")[0].value;
	var id = document.getElementsByName("id_delete")[0].value;
	try {xmlHttp= new XMLHttpRequest();}
	catch(e)
	{
		try {xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
		catch(e)
		{
			try {xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
			catch(e)
			{
				window.alert("Il tuo browser non supporta AJAX");
				return false;
				}
			}
		}
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4){
			if(xmlHttp.responseText == "Query Fallita"){
				alert("Operazione non eseguita");
				window.close();
				}
			else{
				alert("Operazione eseguita");
				window.close();
				}
			}
		}
	xmlHttp.open("GET","../php/do_annulment.php?pwd_delete="+pwd+"&id_delete="+id,true);
	xmlHttp.send(null);
	}
	
	