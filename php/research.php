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
		</head>
	<body>
		<div id ="top">
			<h1>
				SeaMar Lines
			</h1>
		    <h2>
				Ricerca
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
			include '../php/controls.php';
			$nomehost = "localhost";
			$nomeutente = "root";
			$password = "";
			$nomedb = "sistema_marittimo";
			$link = mysql_connect($nomehost, $nomeutente, $password) or die('Connection refused:'.mysql_error());
			
			$database = mysql_select_db($nomedb, $link) or die('Database not opened:'.mysql_error());
			
			$query = "SELECT * FROM viaggi";
			$result = mysql_query($query);
			
			if(!check_again()){
				echo '<script type="text/javascript">
								setTimeout("window.history.back()","5000");
						  		</script>';
				}
			else create_result_1($result);
		?>
	</body>
</html>