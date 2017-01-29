<?php


class vetrinaBoxNewsletter{
	
	
	var $smallBox;
	var $titolo;
	var $contenuto;
	var $img;
	
	
	function __construct(){
		
		$cont='';
		$cont.='<form name="new" action="sendMailAPageNewsletter.php" method="POST" onsubmit="return controllaDati();">';
		$cont.='<br/>';
		$cont.='<label class="newsletter">Il Tuo Nome</label><input id="nominativo" type="text" name="nominativo" value="" />';
		$cont.='<br/>';
		$cont.='<br/>';
		$cont.='<label class="newsletter">E-Mail</label><input id="email" type="text" name="email" value=""/>';
		$cont.='<br/>';
		$cont.='<br/>';
		$cont.='<span class="datiPersonali">Informativa Privacy </span>
				<span class="datiPersonali">
				<input id="privacy" class="info" type="checkbox" checked name="privacy"/>
				 <a href="privacy.php" target="_blank">Consulta..</a></span>';
		$cont.='<br/>';
		$cont.='<br/>';
		$cont.='<span class="newsletter">';
		$cont.='<input type="submit" name="submit" value="Iscriviti"/>';
		$cont.='</span>';
		$cont.='</form>';
		$this->smallBox='<div class="proposteInEvidenza">';
		$this->smallBox.='<div class="proposteInEvidenzaCenter">';
		$this->smallBox.= '<h3>';
		$this->smallBox.="\n";
		$this->smallBox.= 'Iscriviti Alla Newsletter';
		$this->smallBox.="\n";
		$this->smallBox.='</h3>';
		$this->smallBox.='<p>Iscriviti alla newsletter di Rinaldelli Immobiliare, sarai periodicamente informato sulle novit&agrave; del sito, i nuovi immobili o i nuovi tassi</p>';
	
		$this->smallBox.="\n";
		$this->smallBox.=$cont;
		$this->smallBox.="\n";
	
		$this->smallBox.="\n";
		$this->smallBox.= '<p class="vetrina2">';


		
		$this->smallBox.='</p>';	
		$this->smallBox.="\n";
		$this->smallBox.='</div>';
	
		$this->smallBox.='</div><!-- fine proposteInEvidenza-->';
		
	}
	
	function getSmallBox(){
		return $this->smallBox;
	}

	
}




?>