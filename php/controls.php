<?php
	/*chack_again: funzione utilizzata per controllare se l'utente ha modificato l'URL ottenuto col metodo GET
	  check_vehicle: funzione utilizzata per notificare la mancata prenotazione per assenza di posti auto o moto
	  check_simoultaneous_booking: funzione utilizzata per controllare prenotazioni simultanee
	  */
	function check_again(){
		$city_1 = $_GET['departure'];
		$city_2 = $_GET['destination'];
		$cities = array('Genova','Palermo','Tunisi','Barcellona');
		$length = count($cities);
		$check = 0;
		for($i = 0; $i < $length; $i++){
			if($city_1 == $cities[$i]) {$check++;}
			}	
		
		for ($i = 0; $i < $length; $i++) { 
			if($city_2 == $cities[$i]) {$check++;}
			}
		switch ($check) {
			case '0':  
				echo "<p class=\"error\" >Hai specificato citt\xE0 di partenza e arrivo, nella tua ricerca, che non prevedono tratte della nostra Compagnia</p>";
				return false;
			case '1':
				echo "<p class=\"error\">Hai specificato una citt\xE0 di partenza o arrivo, nella tua ricerca, che non prevede tratte della nostra Compagnia</p>";
				return false;
			default: 
				return true;
			}	
		}
	
	function check_vehicle($auto, $moto, $travel){
		$query_check = "SELECT * FROM viaggi WHERE ID ='$travel'";
		$result_check = mysql_query($query_check) or die("Query fallita");
		
		while($row = mysql_fetch_assoc($result_check)){
			if($row['ID'] == $travel){
				$var_auto = $row['Pos_auto'];
				$var_moto = $row['Pos_moto'];
				if(($auto == 1 && $var_auto == 0) || ($moto == 1 && $var_moto == 0)){
					echo "<p class=\"error\">Siamo spiacenti, ma non è stato possibile portare a termine la tua registrazione
						   in quanto non ci sono posti disponibili per poter ospitare il tuo veicolo.
						   Tra poco tornerai nella pagina precedente dove potrai effettuare di nuovo la 
						   prenotazione, evitanto di selezionare le opzioni relative ai veicoli.</p>
						   
						  <script type=\"text/javascript\">
							setTimeout(\"window.history.back()\",\"5000\");
						  </script>";
						  return false;
					}
				else {
					if($auto == 1){
						$var_auto--;
						$query_auto = "UPDATE `viaggi` SET `Pos_auto`='$var_auto' WHERE `ID`='$travel';";
						$result_auto = mysql_query($query_auto) or die("Query fallita");
						}
					if($moto == 1){
						$var_moto--;
						$query_moto = "UPDATE `viaggi` SET `Pos_moto`='$var_moto' WHERE `ID`='$travel';";
						$result_moto = mysql_query($query_moto) or die("Query fallita");
						}
					return true;
					}	
				}
			}
		}	

	function check_simultaneous_booking($posti, $letti, $travel, $list){
		$sm_book = 0;
		$place_list = array();
		$cont = -1;
		$length = strlen($list);
		for($i = 0; $i < $length; $i+=4){
			$cont++; $a = ($i+1); $b = ($i+2);
			$first = substr($list, $i, 1);
			$second = substr($list, $a, 1);
			$third = substr($list, $b, 1);
			if($first == "0"){
				if($second == "0") $place_list[$cont] = "".$third."";
				else $place_list[$cont] = "".$second.$third."";
				}
			else $place_list[$cont] = "".$first.$second.$third."";
			}
		$length_2 = count($place_list);
		
		for ($i = 0; $i < $length_2; $i++) {
			$q_place = $place_list[$i];
			$query_pr_check = "SELECT * FROM prenotazioni WHERE ID_NAVE = '$travel'";
			$result_pr_check = mysql_query($query_pr_check) or die("Query fallita");
			
			while($row = mysql_fetch_assoc($result_pr_check)){
				if($row['ID_PR'] == $q_place)
					$sm_book++;
				}
			}
		
		if($sm_book != 0){
			echo "<p class=\"error\">Siamo spiacenti, ma non &egrave; stato possibile portare a termine la tua prenotazione
					 poich&egrave; alcuni posti da te selezionati si sono da poco occupiamo. Tra poco tornerai
					 nella pagina precedente dove potrai effettuare di nuovo la prenotazione, scegliendo
					  ovviamente posti diversi.
					 </p>
						   
				  <script type=\"text/javascript\">
					setTimeout(\"window.history.back()\",\"5000\");
				  </script>";
			return false;
			}
		return true;
		}	
	?>