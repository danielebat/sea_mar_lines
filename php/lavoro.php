<?php
	/*create_result_1: funzione utilizzata per mostrare i risultati della ricerca nella pagina research.php
	  create_result_2: funzione utilizzata per settare vriabili necessarie per la prenotazione
	  selected_places e selected_places_2: funzioni utilizzate per visualizzare posti liberi e occupati sulla nave
	  set_month: funzione utilizzata per trasformare il mese da stringa a numero
	  rand_string: funzione utilizzata per creare una password casuale
	 */
	function create_result_1($result){
		$yes = 0;
		echo "<div>
			<form action=\"../php/place.php\" method=\"post\" id=\"second\">
			<table class=\"result\" border=3>
			<thead>
				<tr>	
					<th>Partenza</th>
					<th>Arrivo</th>
					<th>Data Partenza</th>
					<th>Data Arrivo</th>
					<th>Ora Partenza</th>
					<th>Data Partenza</th>
					<th>Prezzo posto a sedere</th>
					<th>Prezzo posto letto</th>
					<th>Scelta</th>
				</tr>
			</thead>
			<tbody>";
			set_month($_GET['month']);
			$date = "".$_GET['year']."-".$_GET['month']."-".$_GET['day'];
			while($row = mysql_fetch_assoc($result)){
				if(($row['Partenza'] == $_GET['departure']) && ($row['Arrivo'] == $_GET['destination']) && 
					($row['Data_part'] == $date)){
						$yes++;
						echo "<tr>
								<td>".$row['Partenza']."</td>
								<td>".$row['Arrivo']."</td>
								<td>".substr($row['Data_part'],8,2)."/".substr($row['Data_part'],5,2)."/".substr($row['Data_part'],0,4)."</td>
								<td>".substr($row['Data_arr'],8,2)."/".substr($row['Data_arr'],5,2)."/".substr($row['Data_arr'],0,4)."</td>
								<td>".substr($row['Ora_part'],0,5)."</td>
								<td>".substr($row['Ora_arr'],0,5)."</td>
								<td>".$row['Costo_posto']."</td>
								<td>".$row['Costo_letto']."</td>
								<td><input id=\"choice".$row['ID']."\" type=\"radio\" name=\"scelta\" value=".$row['ID']." class=\"decision\"></td>
							</tr>
							";
						}
				}
				echo "</tbody>
				</table>";
				if(!$yes) echo "<p class=\"error\">Non ci sono soluzioni di viaggio con le caratteristiche da lei indicate. Tra poco torner&agrave; nella
							   pagina precedente per poter modificare le sue scelte.</p>
							   
							   <script type=\"text/javascript\">
									setTimeout(\"window.history.back()\",\"5000\");
				  			   </script>";
				
				else echo "<div><button type=\"button\" id=\"button_3\" onClick=\"one_choice()\">Procedi ora con la scelta del posto---></button></div>";
				echo"</form></div>";
		}
	
	function create_result_2($result_2, &$partenza, &$arrivo, &$data_part, &$data_arr, &$ora_part, &$ora_arr, &$costo_posto, &$costo_letto, $choice){
		while($row = mysql_fetch_assoc($result_2)){
			if($row['ID'] == $choice){
				$partenza = $row['Partenza'];
				$arrivo = $row['Arrivo'];
				$data_part = $row['Data_part'];
				$data_arr = $row['Data_arr'];
				$ora_part = $row['Ora_part'];
				$ora_arr = $row['Ora_arr'];
				$costo_posto = $row['Costo_posto'];
				$costo_letto = $row['Costo_letto'];	
				}
			}
		}
	
	function selected_places($result_3, $choice){
		$contatore = 0; $booked_places = array();
		while($row = mysql_fetch_assoc($result_3)){
			if($row['ID_NAVE'] == $choice){
				$booked_places[$contatore] = $row['ID_PR'];
				$contatore++;
				}
			}
		$work = -1; $length = count($booked_places);
		echo "<br>";
		for ($i = 0; $i < 108 ; $i++) {
			$work = -1;
			for($j = 0; $j < $length; $j++){
				if($booked_places[$j] == $i){
					$work = $i;
					break;
				}
			}
			$id = "p".$i;
			$ID = "D".$i;
			if ($work != -1) {
				echo "<div id=\"".$ID."\" class=\"posto\"><img src=\"../images/bullet_occupato.png\" id=\"".$id."\" alt=\"posto\"></div>";
			} 
			else{
				echo "<div id=\"".$ID."\" class=\"posto\"><img src=\"../images/bullet_disponibile.png\" id=\"".$id."\" name=\"verde\" alt=\"posto\" onClick=\"change_color(id)\" style=\"cursor:pointer\"></div>";
				}
			if(($i+1) % 18 == 0) echo "<br>";
			}
	}

	function selected_places_2($result_4, $choice){
		$contatore = 0; $booked_places = array();
		while($row = mysql_fetch_assoc($result_4)){
			if($row['ID_NAVE'] == $choice){
				$booked_places[$contatore] = $row['ID_PR'];
				$contatore++;
				}
			}
		$work = 0; $length = count($booked_places);
		echo "<br>";
		for ($i = 108; $i < 178 ; $i++) {
			$work = 0;
			for($j = 0; $j < $length; $j++){
				if($booked_places[$j] == $i){
					$work = $i;
					break;
				}
			}
			$id = "l".$i;
			$ID = "V".$i;
			if ($work != 0) {
				if($i>135) echo "<div id=\"".$ID."\" class=\"letto_1\"><img src=\"../images/poltrona_occupata.png\" id=\"".$id."\" alt=\"bed\"></div>";
				else echo "<div id=\"".$ID."\" class=\"letto\"><img src=\"../images/poltrona_occupata.png\" id=\"".$id."\" alt=\"bed\"></div>";
			} 
			else{
				if($i>135) echo "<div id=\"".$ID."\" class=\"letto_1\"><img src=\"../images/poltrona_disponibile.png\" id=\"".$id."\" alt=\"bed\" name=\"VERDE\" onClick=\"change_color_2(id)\" style=\"cursor:pointer\"></div>";
				else echo "<div id=\"".$ID."\" class=\"letto\"><img src=\"../images/poltrona_disponibile.png\" id=\"".$id."\" name=\"VERDE\" alt=\"bed\" onClick=\"change_color_2(id)\" style=\"cursor:pointer\"></div>";
				}
			if (($i-9) %14 == 0) echo "<br>";
			if ($i == 135) echo "<br>";
			}
	}
	
	function set_month(&$month){
		$year = array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
		$length = count($year);
		for ($i = 0; $i < $length; $i++) { 
			if($month == $year[$i]){
				if($i < 9) $month = "0".($i+1);
				else $month = ($i+1);
				}
			}
		}
	
	function rand_string($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		$size = strlen( $chars );
		$str = "";
		for( $i = 0; $i < $length; $i++ ) {
				$str .= $chars[ rand( 0, $size - 1 ) ];
				}
		return $str;
		}
	
	?>				