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
	<body>
		<div id ="top">
			<h1>
				SeaMar Lines
			</h1>
		    <h2>
				Prenotazione
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
		<div>
			<?php
				
				include '../php/lavoro.php';
				include '../php/controls.php';
				$nomehost = "localhost";
				$nomeutente = "root";
				$password = "";
				$nomedb = "sistema_marittimo";
				$link = mysql_connect($nomehost, $nomeutente, $password) or die('Connection refused:'.mysql_error());
			
				$database = mysql_select_db($nomedb, $link) or die('Database not opened:'.mysql_error());
				
				$travel = $_POST['travel'];
				$nome = $_POST['name'];
				$cognome = $_POST['surname'];
				$cell = $_POST['cell'];
				$comune = $_POST['birth_place'];
				$year = $_POST['birth_year_date'];
				$month = $_POST['month'];
				$day = $_POST['day'];
				$posti = $_POST['place_number'];
				$letti = $_POST['bed_number'];
				$list = $_POST['list'];
				$total = $_POST['total'];
				
				if(!check_simultaneous_booking($posti, $letti, $travel, $list)){}
				else{
					if (isset($_POST['auto'])) $auto = 1; else $auto = 0;
					if (isset($_POST['moto'])) $moto = 1; else $moto = 0;
				
					$continue = true;
					if($auto == 1 || $moto == 1) $continue = check_vehicle($auto, $moto, $travel);
					if(!$continue){}
					else{
						set_month($month);
				
						$date = "".$year."-".$month."-".$day."";
						
						$query_yes = "SELECT * FROM viaggi WHERE ID='$travel'";
						$result_yes = mysql_query($query_yes) or die("Query Fallita");
					
						$row_yes = mysql_fetch_assoc($result_yes);
						
						echo "<div id=\"booked\">";	
						echo "<h1>Prenotazione effettuata con successo</h1>";
						echo "<div id=\"message\">
							  	<p class=\"error\">Non dimentichi di conservare ogni password relativa alla prenotazione di ogni singolo posto necessaria 
							  	 per visualizzare la prenotazione dello stesso e, eventualmente, cancellarla.
							  
							  	 Enjoy your Trip!</p>
							  </div>";
						echo "<div id=\"voyage\">
								<h2>DETTAGLI VIAGGIO</h2>
								<p class=\"done_2\">Partenza:</p><p class=\"undone_2\">".$row_yes['Partenza']."</p>
					  	  		<p class=\"done_2\">Arrivo:</p><p class=\"undone_2\">".$row_yes['Arrivo']."</p>
					  	  		<p class=\"done_2\">Data Partenza:</p><p class=\"undone_2\">".substr($row_yes['Data_part'],8,2)."/".substr($row_yes['Data_part'],5,2)."/".substr($row_yes['Data_part'],0,4)."</p>
					   	  		<p class=\"done_2\">Data Arrivo:</p><p class=\"undone_2\">".substr($row_yes['Data_arr'],8,2)."/".substr($row_yes['Data_arr'],5,2)."/".substr($row_yes['Data_arr'],0,4)."</p>
					  	  		<p class=\"done_2\">Ora Partenza:</p><p class=\"undone_2\">".substr($row_yes['Ora_part'], 0, 5)."</p>
					  	  		<p class=\"done_2\">Ora Arrivo:</p><p class=\"undone_2\">".substr($row_yes['Ora_arr'], 0, 5)."</p>
					  	  	  </div>
					  	  	  <div id=\"person\">
					  	  	  	<h2>DETTAGLI VIAGGIATORE</h2>
					  	  	  	<p class=\"done_2\">Nome:</p><p class=\"undone_2\">".$nome."</p>
					  	  		<p class=\"done_2\">Cognome:</p><p class=\"undone_2\">".$cognome."</p>
					  	  		<p class=\"done_2\">Cellulare:</p><p class=\"undone_2\">".$cell."</p>
					   	  		<p class=\"done_2\">Comune di nascita:</p><p class=\"undone_2\">".$comune."</p>
					  	  		<p class=\"done_2\">Data di Nascita:</p><p class=\"undone_2\">".substr($date,8,2)."/".substr($date,5,2)."/".substr($date,0,4)."</p>
					  	  	  </div>
					  	  	  <div id=\"bookings\">
					  	  	  	<h2>DETTAGLI PRENOTAZIONE</h2>";
								
							if($auto == 1) echo "<p class=\"done_2\">Auto a Bordo:</p><p class=\"undone_2\">Si</p>";
							else echo "<p class=\"done_2\">Auto a Bordo:</p><p class=\"undone_2\">No</p>";
							
							if($moto == 1) echo "<p class=\"done_2\">Moto a Bordo:</p><p class=\"undone_2\">Si</p>";
							else echo "<p class=\"done_2\">Moto a Bordo:</p><p class=\"undone_2\">No</p>";
							
							echo "<p class=\"done_2\">Totale:</p><p class=\"undone_2\">".$total." &euro;</p>";
					
						for ($i = 0; $i < $posti; $i++) {
							$place = "arancione_".$i;
							$posto = $_POST[$place];
							$pwd = rand_string(5);
							$query_3 = "INSERT INTO `sistema_marittimo`.`prenotazioni` (`ID_PR`, `ID_NAVE`, `Nome`, `Cognome`,
				 			`Comune_Nascita`, `Data_Nascita`, `Cellulare`, `Auto`, `Moto`, `PWD`) VALUES ('$posto','$travel','$nome','$cognome',
				  			'$comune','$date','$cell','$auto','$moto','$pwd')";
				  			$result_3 = mysql_query($query_3) or die("Query Fallita1");
							echo "<p class=\"done_2\">Posto: P".$posto."</p><p class=\"undone_2\">Passwd: ".$pwd."</p>";
							}
				
						for ($i = 0; $i < $letti; $i++) {
							$place = "ARANCIONE_".$i; 
							$posto = $_POST[$place];
							$pwd = rand_string(5);
							$query_3 = "INSERT INTO `sistema_marittimo`.`prenotazioni` (`ID_PR`, `ID_NAVE`, `Nome`, `Cognome`,
				 			`Comune_Nascita`, `Data_Nascita`, `Cellulare`, `Auto`, `Moto`, `PWD`) VALUES ('$posto','$travel','$nome','$cognome',
				  			'$comune','$date','$cell','$auto','$moto','$pwd')";
				  			$result_3 = mysql_query($query_3) or die("Query Fallita2");
							echo "<p class=\"done_2\">Letto: L".$posto."</p><p class=\"undone_2\">Passwd: ".$pwd."</p>";
							}
						echo "</div></div>";
						}
					}
				?>
		</div>
	</body>
</html>