<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
 
 <html>
	<head>
		<meta name="description" content="SeaMar Lines, la compagna di trasporto marittimo">
		<meta name="author" lang="it" content="Daniele Battista">
		<meta name="keywords" lang="it" content="mare, nave, viaggio, trasporto marittimo, trasporto, caratteristiche">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>SeaMar Lines: Trasporti Marittimi</title>
		<link rel="stylesheet" href="../video.css" type="text/css">
		<script type="text/javascript" src="../execution.js"></script>
		<script type="text/javascript" src="../checks.js"></script>
	</head>
	<body onload="create_select(0)">
		<div id ="top">
			<h1>
				SeaMar Lines
			</h1>
		    <h2>
				Scelta Posto
			</h2>
		    <img id="logo" src="../images/logo.png" alt="logo" usemap="#logo">
			<map id="ilogo" name="logo">
			<area shape="circle" alt="Logo" coords="90,90,93" href="../index.html">
			</map>
			<div id="bar">
				<a href="../features.html#compagnia">Compagnia</a>
				<a href="../features.html#storia">Storia</a>
				<a href="../features.html#servizi">Servizi</a>
				<a href="../features.html#sistemazioni">Sistemazioni</a>
				<a href="../features.html#condizioni">Condizioni di Viaggio</a>
			</div>
		</div>
		<?php
			include '../php/lavoro.php';
			$nomehost = "localhost";
			$nomeutente = "root";
			$password = "";
			$nomedb = "sistema_marittimo";
			$link = mysql_connect($nomehost, $nomeutente, $password) or die('Connection refused:'.mysql_error());
			
			$database = mysql_select_db($nomedb, $link) or die('Database not opened:'.mysql_error());
			
			$query_2 = "SELECT * FROM viaggi";
			$result_2 = mysql_query($query_2);
			
			$def_choice_travel = $_POST["scelta"];
				
			$query_3 = "SELECT * FROM prenotazioni";
			$result_3 = mysql_query($query_3);
			$query_4 = "SELECT * FROM prenotazioni";
			$result_4 = mysql_query($query_4);
				
			$def_partenza = "";
			$def_arrivo = "";
			$def_data_part = "";
			$def_data_arr = "";
			$def_ora_part = "";
			$def_ora_arr = "";
			$def_costo_posto = "";
			$def_costo_letto = "";
			
			create_result_2($result_2, $def_partenza, $def_arrivo, $def_data_part, $def_data_arr, $def_ora_part, $def_ora_arr,
							$def_costo_posto, $def_costo_letto, $def_choice_travel);
				?>
		<form action="../php/booking.php" method="post">
			<div id="health">
				<div id="presentation">
						<h1>Procedi ora con la selezione del posto:</h1>
						<p>Nella nave in alto puoi scegliere posti a sedere sul ponte della nave, mentre nella successiva 
				   	  	   puoi scegliere un posto letto adibito nel piano inferiore, qualora tu voglia trascorrere in 
				       	   maniera pi&ugrave; piaceviole il viaggio. Fai attenzione alla scelta. Sono presenti posti letto
				       	   in camere quadruple e in camere doppie, come &egrave; possible notare dall'immagine.</p>
				</div>
				<div id="left_part">
					<div id="legenda">
						<h1>Legenda</h1>
					</div>
					<input type="hidden" name="place_number" value="0">
					<input type="hidden" name="bed_number" value="0">
					<input type="hidden" value="" name="list">
					<?php
							echo "<input type=\"hidden\" name=\"travel\" value=\"".$def_choice_travel."\"><br>
							 	  <input type=\"hidden\" value=\"".$def_costo_posto."\" id=\"costo_posto\"><br>
							  	  <input type=\"hidden\" value=\"".$def_costo_letto."\" id=\"costo_letto\"><br>";
							?>
				</div>
				<div id="piano1" class="pianta">
					<h1>Ponte Superiore</h1>
					<img src="../images/ship_def.png" alt="nave1" class="boat" id="boat1">
					<?php
						selected_places($result_3, $def_choice_travel);	
						?>
				</div>
				<div id="piano2" class="pianta">
					<h1>Piano Inferiore</h1>
					<img src="../images/222.png" alt="nave2" class="boat" id="boat2">
					<?php
						selected_places_2($result_4, $def_choice_travel);
						?>
				</div>
			</div>
			<div id="right">
				<div id="travel_selected">
					<?php
						
						echo "<h1>Info Viaggio</h1>
					  	  	  <p class=\"done\">Partenza:</p><p class=\"undone\">".$def_partenza."</p>
					  	 	  <p class=\"done\">Arrivo:</p><p class=\"undone\">".$def_arrivo."</p>
					  	      <p class=\"done\">Data Partenza:</p><p class=\"undone\">".substr($def_data_part,8,2)."/".substr($def_data_part,5,2)."/".substr($def_data_part,0,4)."</p>
					   	      <p class=\"done\">Data Arrivo:</p><p class=\"undone\">".substr($def_data_arr,8,2)."/".substr($def_data_arr,5,2)."/".substr($def_data_arr,0,4)."</p>
					  	      <p class=\"done\">Ora Partenza:</p><p class=\"undone\">".substr($def_ora_part, 0, 5)."</p>
					  	      <p class=\"done\">Ora Arrivo:</p><p class=\"undone\">".substr($def_ora_arr, 0, 5)."</p>";
						?>
			 	</div>
			 	<div id="option">
					<h1>Opzioni</h1>
					<p>Completa la tua prenotazione decidendo di condurre sulla nave un'automobile o un motoveicolo,
				  		 al prezzo di 20&euro; per l'automobile e 15&euro; per il motoveicolo:</p>
					<input type="checkbox" name="auto" onclick="add_auto()">Auto
					<input type="checkbox" name="moto" onclick="add_moto()">Moto<br>
				</div>
				<div id="price">
					<h1>Totale</h1>
					<input type="text" size="4" maxlength="4" value="0" id="cast_price" name="total" readonly="readonly"><br>
				</div>
			</div>
			<div id="prenotazione">
				<h1>Inserisci qui i tuoi dati per completare la prenotazione:</h1>
				<div class="pren"><p>Nome:</p><input type=text name="name" value="" maxlength="20" size="20"></div>
				<div class="pren"><p>Cognome:</p><input type="text" name="surname" value="" maxlength="20" size="20"></div>
				<div class="pren_1"><p>Cellulare:</p><input type="text" name="cell" value="" maxlength="30" size="30"></div>
				<div class="pren_1"><p>Comune di Nascita:</p><input type="text" name="birth_place" value="" maxlength="30" size="30"></div>
				<div class="pren_1"><p>Data di Nascita:</p>
					<select name="day" class="info">
					</select>
					<select name="month" class="info">
					</select>
					<select name="birth_year_date" class="info">
					</select>
				</div>
			</div>
			<div id="full">
					<button type="button" onClick="check_info()">Conferma la tua prenotazione ---></button>
			</div>
		</form>
	</body>
</html>