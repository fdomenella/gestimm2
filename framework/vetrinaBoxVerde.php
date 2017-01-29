<?php


class vetrinaBoxVerde{
	
	
	var $smallBox;
	var $titolo;
	var $contenuto;
	var $img;
	
	
	function __construct($id_imm,$pathImg, $note){
		
		
		$this->smallBox='<div class="proposteInEvidenza">';
		$this->smallBox.='<div class="proposteInEvidenzaCenter">';
		$this->smallBox.= '<h3>';
		$this->smallBox.="\n";
		$this->smallBox.= 'Proposte in Evidenza';
		$this->smallBox.="\n";
		$this->smallBox.='</h3>';
		$this->smallBox.="\n";
		$this->smallBox.= '<img class="imgVetrina2" height="120px" src="'.$pathImg.'" alt="';
		$this->smallBox.="\n";
		//$this->smallBox.=$note;
		$this->smallBox.="\n";
		$this->smallBox.='"/>';
		$this->smallBox.="\n";
		$this->smallBox.= '<p class="vetrina2">';

		$this->smallBox.=truncateString(strip_tags($note),180);
		
		$this->smallBox.='</p>';	
		$this->smallBox.="\n";
		$this->smallBox.='</div>';
		$this->smallBox.='<div class="btDettagliWhite"><a href="immobile_show.php?id_imm='.$id_imm.'" title=""><img src="images/btDettagli.jpg" alt=""/></a></div>';
		$this->smallBox.='</div><!-- fine proposteInEvidenza-->';
		
	}
	
	function getSmallBox(){
		return $this->smallBox;
	}

	
}




?>