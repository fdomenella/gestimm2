<?php

class SmallBox{
	
	
	var $smallBox;
	var $titolo;
	var $contenuto;
	var $img;
	

	
	function __construct($id_imm,$pathImg){
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		
	
		
		$query="SELECT * FROM immobile WHERE id_imm = $id_imm";
		$result=$db->query($query);
		if (!$result) {
			$this->smallBox="Qualcosa è andato storto";
		}else{
			$row=mysql_fetch_array($result);
		
			$this->smallBox='<div class="boxPiccolo">';
			$this->smallBox.="\n";
			$this->smallBox.='<div class="boxPiccoloTop"> </div>';
			$this->smallBox.="\n";
			$this->smallBox.='<div class="boxPiccoloCenter">';
			$this->smallBox.="\n";
			
			
			$this->smallBox.='<img class="imgVetrina1" width="100px" height="79px" src="'.$pathImg.'" alt=""/>';
			$this->smallBox.="\n";
			$this->smallBox.='<p class="smallBoxP">';
			
			$this->smallBox.='<strong class="smallBoxStrong">Comune</strong>: ';
			$this->smallBox.= stampa_comune($row['comune']);
			$this->smallBox.='<br/>';
			$this->smallBox.='<strong class="smallBoxStrong">Zona</strong>: ';
			$this->smallBox.= stampa_zona($row['id_zona']);
			$this->smallBox.='<br/>';
			$this->smallBox.='<strong class="smallBoxStrong">Tipologia</strong>: ';
			$this->smallBox.= truncateString(stampa_tipologia($row['tipologia']),14);
			//$this->smallBox.= truncateString(stampa_tipologia($row['tipologia']),16);
			$this->smallBox.='<br/>';
			$this->smallBox.='<strong class="smallBoxStrong">Mq</strong>: ';
			$this->smallBox.= stampa_mq($row['mq']);
			
			$this->smallBox.='</p>';
			$this->smallBox.='</div>';
			$this->smallBox.="\n";
			$this->smallBox.='<div class="boxPiccoloBottom">';
			$this->smallBox.="\n";
			$this->smallBox.='<a href="immobile_show.php?id_imm=';
			$this->smallBox.=$id_imm;
			$this->smallBox.='" title="Visualizza L\'immobile"/>';
			$this->smallBox.='<img src="images/btDettagliBlue.gif" alt=""/>';
			$this->smallBox.="</a>";
			$this->smallBox.="\n";
			$this->smallBox.='</div>';
			$this->smallBox.="\n";
			$this->smallBox.='</div><!-- fine boxPiccolo-->';
		}
	}
	
	function getSmallBox(){
		return $this->smallBox;
	}


}


?>