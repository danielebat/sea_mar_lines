<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
 
 <html>
	<head>
		<meta name="description" content="SeaMar Lines, la compagna di trasporto marittimo">
		<meta name="author" lang="it" content="Daniele Battista">
		<meta name="keywords" lang="it" content="mare, nave, viaggio, trasporto marittimo, trasporto">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>SeaMar Lines: Trasporti Marittimi</title>
		<link rel="stylesheet" href="../video.css" type="text/css">
		<script type="text/javascript" src="../execution.js"></script>
		<script type="text/javascript" src="../checks.js"></script>
		<script type="text/javascript" src="../ajax_elab.js"></script>
		</head>
	<body id="delete">
		<div id="ship_delete">
			<h1>
				Cancellazione
			</h1>
			<?php
				
				$nomehost = "localhost";
				$nomeutente = "root";
				$password = "";
				$nomedb = "sistema_marittimo";
				$link = mysql_connect($nomehost, $nomeutente, $password) or die('Connection refused:'.mysql_error());
			
				$database = mysql_select_db($nomedb, $link) or die('Database not opened:'.mysql_error());
				
				$current_pwd = $_POST['pwd'];
				
				
				$query_5 = "SELECT * FROM prenotazioni WHERE PWD='$current_pwd'";
				$result_5 = mysql_query($query_5) or die("Query Fallita");
				
				$row_5 = mysql_fetch_assoc($result_5);
				
				$pwd_ex = "/^([a-zA-Z0-9]\s?)+$/";
				$check = preg_match($pwd_ex, $current_pwd);
				
				if($row_5['PWD'] != $current_pwd || $current_pwd == "" || ($check == 0 || !$check)){
					echo "<p class=\"error\">Risultato non trovato</p>";
					echo "<script type=\"text/javascript\">
							setTimeout(\"window.history.back()\",\"5000\");
						  </script>";
					}
				else{
					$id = $row_5['ID_PR'];
					$ship = $row_5['ID_NAVE'];
				
					echo "<input type=\"hidden\" value=\"".$current_pwd."\" name=\"pwd_delete\">";
					echo "<input type=\"hidden\" value=\"".$id."\" name=\"id_delete\">";
					
					$query_yes = "SELECT * FROM viaggi WHERE ID='$ship'";
					$result_yes = mysql_query($query_yes) or die("Query Fallita");
					
					$row_yes = mysql_fetch_assoc($result_yes);
					
					echo "<h2>Dettagli</h2>";
					echo "<div id=\"chosen\">";
					echo "<p class=\"done\">Partenza:</p><p class=\"undone\">".$row_yes['Partenza']."</p>
					  	  <p class=\"done\">Arrivo:</p><p class=\"undone\">".$row_yes['Arrivo']."</p>
					  	  <p class=\"done\">Data Partenza:</p><p class=\"undone\">".substr($row_yes['Data_part'],8,2)."/".substr($row_yes['Data_part'],5,2)."/".substr($row_yes['Data_part'],0,4)."</p>
					   	  <p class=\"done\">Data Arrivo:</p><p class=\"undone\">".substr($row_yes['Data_arr'],8,2)."/".substr($row_yes['Data_arr'],5,2)."/".substr($row_yes['Data_arr'],0,4)."</p>
					  	  <p class=\"done\">Ora Partenza:</p><p class=\"undone\">".substr($row_yes['Ora_part'], 0, 5)."</p>
					  	  <p class=\"done\">Ora Arrivo:</p><p class=\"undone\">".substr($row_yes['Ora_arr'], 0, 5)."</p>";
					echo "</div>";
				
					echo "<button type=\"button\" onclick=\"ajax_delete()\">Procedi con la Cancellazione</button>";
				}
				?>
		</div>
	</body>
</html>