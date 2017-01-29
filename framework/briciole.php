<?php

class Briciole{
	var $sezione;
	var $livello1;
	var $livello2;
	var $briciole;
	var $array_sezioni_menu = array("home","contatti","ambulatori","trattamenti","articoli","attivita","faq","orari");
	
	
	function __construct($sezione, $livello1="", $livello2=""){
		$this->setSezione($sezione);
		$this->briciole='Ti Trovi qui: <a class="bricioleLink" href="index.php" title="Home Page">Home Page</a> -> ';
		
		/**
		 * livello1 indica la sotto sezione
		 */
		if ($livello2!="") {
			$this->setLivello1($livello1);
			$this->setLivello2($livello2);
			$this->initializeLivello1();
			$this->initializeLivello2();
			
		}else{
			if ($livello1!="") {
				$this->setLivello1($livello1);
				$this->initializeLivello1();
			}	
			else {
				$this->initialize();
			}
		}
		
	}
	
	function setSezione($sezione){
		$this->sezione=$sezione;
	}
	function getSezione(){
		return $this->sezione;
	}
	function setLivello1($liv1){
		$this->livello1=$liv1;
	}
	function getLivello1(){
		return $this->livello1;
	}	
	function setLivello2($liv2){
		$this->livello2=$liv2;
	}
	function getLivello2(){
		return $this->livello2;
	}
	
	/**
	 * Setto le briciole per tutte le sezioni tranne che x il consorzio
	 *
	 */
	function initialize(){
		
		switch ($this->getSezione()) {
			case "ambulatori":
				$this->briciole .= 'Gli Ambulatori';
				break;
			case "contatti":
				$this->briciole .= 'I Contatti';
				break;
			case "curriculum":
				$this->briciole .= 'Il Curriculum';
				break;
			case "photogallery":
				$this->briciole .= 'La PhotoGallery';
				break;
			case "trattamenti":
				$this->briciole .= 'I Trattamenti';
				break;
			case "articoli":
				$this->briciole .= 'Gli Articoli';
				break;
			case "attivita":
				$this->briciole .= 'Le Attivit&agrave;';
				break;
			case "faq":
				$this->briciole .= 'Le FAQ';
				break;
			case "orari":
				$this->briciole .= 'Gli Orari';
				break;
			default:
				break;
		}
		
	
		
	}
	
	
	function InitializeLivello1(){
		
		switch ($this->getSezione()) {
			case "ambulatori":
				$this->briciole .= '<a href="ambulatori.php" title="Gli Ambulatori">Gli Ambulatori</a> -> ';
			
				break;
			case "contatti":
				$this->briciole .= 'I Contatti';
				break;
			case "trattamenti":
				$this->briciole .= '<a href="trattamenti.php" title="I Trattamenti">I Trattamenti</a> -> ';
				break;
			case "articoli":
				$this->briciole .= '<a href="articoli.php" title="Gli Articoli">Gli Articoli</a> -> ';
				break;
			case "attivita":
				$this->briciole .= 'Le Attivit&agrave;';
				break;
			case "faq":
				$this->briciole .= 'Le FAQ';
				break;
			case "orari":
				$this->briciole .= 'Gli Orari';
				break;
			default:
				break;
		}
		
		
		
		switch ($this->getLivello1()) {
			case "dietetica":
				$this->briciole .= 'La Dietetica -> ';
			
				break;
			case "":
				$this->briciole .="";
				break;
			
		}
		
	
		
	}
	
	function InitializeLivello2(){
		if ($this->livello2!="") {
			$this->briciole.= " " .$this->livello2;
		}
		
	
	}
	
	
	function getBriciole(){
		return $this->briciole;
	}
}

?>