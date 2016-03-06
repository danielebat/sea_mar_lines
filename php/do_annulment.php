<?php
	$nomehost = "localhost";
	$nomeutente = "root";
	$password = "";
	$nomedb = "sistema_marittimo";
	$link = mysql_connect($nomehost, $nomeutente, $password) or die('Connection refused:'.mysql_error());
			
	$database = mysql_select_db($nomedb, $link) or die('Database not opened:'.mysql_error());
	
	$delete_pwd = $_GET['pwd_delete'];
	$delete_id = $_GET['id_delete'];
	
	$query_6 = "DELETE FROM `prenotazioni` WHERE `ID_PR`='$delete_id' and`PWD`='$delete_pwd';";
	$result_6 = mysql_query($query_6) or die("Query Fallita");
	
	
	
	/*script utilizzato per cancellare una prenotazione*/
	?>