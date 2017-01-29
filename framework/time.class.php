<?php
/*
* 	Classe per stabilire il tempo di esecuzione di uno script php
* 	Tutti i diritti riservati, è consentito l'uso, ma non la modifica e la ridistribuzione
* 
* 	Autore: 	Andrea Tarquini
* 	Data:		05-205
* 	Contact:	atapro@gmail.com
* 
* 	Uso:
*	 	$pntTime=new executionScript();
*		$pntTime->start();
*		//inserire il codice php
*		$pntTime->stop();
*		echo 'Lo script è stato eseguito in '.$pntTime->getTime().' secondi.';
* 
*/
class executionScript{
	
	//dichiarazione delle propietà
	var $inizio,$fine;
	
	//metodo costruttore
	function executionScript(){}
	
	//metodo che imposta l'inizio dello script
	function start(){
		list($mic,$sec)=explode(' ',microtime());
		$this->inizio=$sec+$mic;
	}
	
	//metodo che imposta la fine dello script
	function stop(){
		list($mic,$sec)=explode(' ',microtime());
		$this->fine=$sec+$mic;
	}
	
	//metodo che esegue la differenza e restituisce il tempo di esecuzione dello script
	function getTime(){
		return round(($this->fine-$this->inizio),6);
	}
}
?>