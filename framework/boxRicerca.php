<?php

class boxRicerca{
	
	
	var $BoxRicerca;
	var $titolo;
	var $contenuto;
	var $img;
	

	
	function __construct(){
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		
	
		
		/*$query="SELECT * FROM immobile WHERE id_imm = $id_imm";
		$result=$db->query($query);
		if (!$result) {
			$this->BoxRicerca="Qualcosa è andato storto";
		}else{
			$row=mysql_fetch_array($result);
		*/
			$this->BoxRicerca="";
			
			$this->BoxRicerca.="\n";
			$this->BoxRicerca.='<div class="boxRicercaTop"> </div>';
			$this->BoxRicerca.="\n";
			$this->BoxRicerca.='<div class="s">';
			$this->BoxRicerca.='<form action="ricerca.php" method="GET">';
			$this->BoxRicerca.="\n";
		
			$this->BoxRicerca.='<div align="center">';
			$this->BoxRicerca.='<label class="boxRicercaLabel"  for="tipo">
			Vendita<input type="radio" name="input_check" value="1" checked /></label> ';
			
			
			
			$this->BoxRicerca.='<label class="boxRicercaLabel" for="tipo">
			Affitto<input type="radio" name="input_check" value="2" /></label>';
			$this->BoxRicerca.='
			
			
			';
			
			
			$this->BoxRicerca.='
			<select class="select" name="comune">
			<option value="0">Tutti i comuni</option>
			';
			$query="SELECT * FROM comune ORDER BY nome ASC";
			$result=$db->query($query);
			if (!$result) {
				
			}else{
				
				while ($row=mysql_fetch_array($result)) {
					$this->BoxRicerca.='<option value="'.$row['id_comune'].'">'.$row['nome'].'</option>';
				}
			}
				
			$this->BoxRicerca.='</select>';
			
			$this->BoxRicerca.='
			<select class="select" name="tipologia">
			<option value="0">Tutte le tipologie</option>
			';
			$query="SELECT * FROM tipologia ORDER BY nome ASC";
			$result=$db->query($query);
			if (!$result) {
				
			}else{
				
				while ($row=mysql_fetch_array($result)) {
					$this->BoxRicerca.='<option value="'.$row['id_tipologia'].'">'.$row['nome'].'</option>';
				}
			}
	
			$this->BoxRicerca.='</select>';
			$this->BoxRicerca.='</div>'; // chiudo div align = center
		
			
			$this->BoxRicerca.='<label class="boxRicercaLabel" for="prezzo"> Prezzo<br>';
			$this->BoxRicerca.='</label>';
			$this->BoxRicerca.='<div align="center">';
			$this->BoxRicerca.='
				<select name="prezzomin" class="select2" size="1">
                  <option value="0">0
                  </option><option value="25000">25.000
                  </option><option value="50000">50.000
                  </option><option value="75000">75.000
                  </option><option value="100000">100.000
                  </option><option value="125000">125.000
                  </option><option value="150000">150.000
                  </option><option value="175000">175.000
                  </option><option value="200000">200.000
                  </option><option value="225000">225.000
                  </option><option value="250000">250.000
                  </option><option value="300000">300.000
                  </option><option value="350000">350.000
                  </option><option value="400000">400.000
                  </option><option value="450000">450.000
                  </option><option value="500000">500.000
                  </option><option value="750000">750.000

                </option>
               </select>
				';
			$this->BoxRicerca.='
				<select name="prezzomax" class="select2" size="1">
                  <option value="999999999999">&gt;5.000.000
                  </option><option value="5000000">5.000.000
                  </option><option value="2500000">2.500.000
                  </option><option value="2000000">2.000.000
                  </option><option value="1500000">1.500.000
                  </option><option value="1250000">1.250.000
                  </option><option value="1000000">1.000.000
                  </option><option value="750000">750.000
                  </option><option value="500000">500.000
                  </option><option value="450000">450.000
                  </option><option value="400000">400.000
                  </option><option value="350000">350.000
                  </option><option value="300000">300.000
                  </option><option value="250000">250.000
                  </option><option value="225000">225.000
                  </option><option value="200000">200.000
                  </option><option value="175000">175.000
                  </option><option value="150000">150.000
                  </option><option value="125000">125.000
                  </option><option value="100000">100.000
                  </option><option value="75000">75.000
                  </option><option value="50000">50.000
                  </option><option value="25000">25.000
                </option>
               </select>
                                ';
			
			$this->BoxRicerca.='</div>'; // chiudo div align = center
			
			
			
			$this->BoxRicerca.='<label class="boxRicercaLabel" for="prezzo"> Mq<br>';
			
			$this->BoxRicerca.='</label>';
			$this->BoxRicerca.='<div align="center">';
			
				$this->BoxRicerca.='
				<select name="mqmin" class="select2" size="1">
                  <option value="0">0
                  </option><option value="25">25
                  </option><option value="50">50
                  </option><option value="75">75
                  </option><option value="100">100
                  </option><option value="125">125
                  </option><option value="150">150
                  </option><option value="175">175
                  </option><option value="200">200
                  </option><option value="250">250
                  </option><option value="300">300
                  </option><option value="350">350
                  </option><option value="400">400
                  </option><option value="450">450
                  </option><option value="500">500
                  </option><option value="1000">1.000
                  </option><option value="1500">1.500
                  </option><option value="2000">2.000
                  </option><option value="3000">3.000
                  </option><option value="4000">4.000
                  </option><option value="5000">5.000
                  </option><option value="10000">10.000
                  </option><option value="15000">15.000
                  </option><option value="20000">20.000
                  </option><option value="30000">30.000
                  </option><option value="50000">50.000
                </option></select>
				';
			
				$this->BoxRicerca.='
				<select name="mqmax" class="select2" size="1">
                  <option value="999999999">&gt;50.000
                  </option><option value="50000">50.000
                  </option><option value="30000">30.000
                  </option><option value="20000">20.000
                  </option><option value="15000">15.000
                  </option><option value="10000">10.000
                  </option><option value="5000">5.000
                  </option><option value="4000">4.000
                  </option><option value="3000">3.000
                  </option><option value="2000">2.000
                  </option><option value="1500">1.500
                  </option><option value="1000">1.000
                  </option><option value="500">500
                  </option><option value="450">450
                  </option><option value="400">400
                  </option><option value="350">350
                  </option><option value="300">300
                  </option><option value="250">250
                  </option><option value="200">200
                  </option><option value="175">175
                  </option><option value="150">150
                  </option><option value="125">125
                  </option><option value="100">100
                  </option><option value="75">75
                  </option><option value="50">50
                  </option><option value="25">25
                </option></select>
                                ';
			$this->BoxRicerca.='</div>';
			
			
			$this->BoxRicerca.='<div id="submitCerca">';
			$this->BoxRicerca.='<input type="submit" class="submit" name="submit" value="Cerca.."/>';
			$this->BoxRicerca.='</div>';
			
			$this->BoxRicerca.='</form>'; // chiude il div s
			$this->BoxRicerca.='</div>'; // chiude il div s
			
			$this->BoxRicerca.="\n";
	
			
		//}
	}
	
	function getBoxRicerca(){
		return $this->BoxRicerca;
	}


}


?>