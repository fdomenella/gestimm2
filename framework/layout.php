<?php



/**
 * Enter description here...
 *
 */
class Layout{
	
	var $section;
	var $menu;
	var $header;
	var $footer;
	var $subHeader;
	/**
	 * Il costruttore
	 */
	
	function  __construct($sezione){
		$this->setSection($sezione);
		$this->setHeader();
		$this->setMenu();
		$this->setFooter();
	}
	
	
	/**
	 * Ritorna la sezione del sito in cui mi trovo
	 */

	function getSection(){
		return $this->section;
	}

	/**
	 * Setta la sezione del sito per la pagina
	 */

	function setSection($ActualSection){
		if ($ActualSection=="") {
			$this->section = "";
		}
		else{
			$this->section = $ActualSection;
		}

	}


	function setMenu(){
		$this->menu ='
		<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="#" rel="dropmenu1">Clienti</a></li>
<li><a href="#" rel="dropmenu2">Immobili</a></li>
<li><a href="#" rel="dropmenu3">Richieste</a></li>
<li><a href="#" rel="dropmenu4">Ricerva Avanzata</a></li>
<li><a href="#" rel="dropmenu5">Note</a></li>
<li><a href="#" rel="dropmenu6">Gestione Sito</a></li>
<li><a href="#" rel="dropmenu8">Email</a></li>
<li><a href="#" rel="dropmenu9" >Marketing</a></li>
<li><a href="gestione_tendine.php" >Gestione Tendine</a></li>
<li><a href="gestione_tendine_unisci.php" >Unisci Tendine</a></li>
<li><a href="javascript: window.close()">Chiudi</a></li>
</ul>
</div>

<!--1st drop down menu --> 
<div id="dropmenu1" class="dropmenudiv">
<a href="cliente_add.php?azione=add">Aggiungi Cliente</a>
<a href="clienti_index.php">Tutti i Clienti</a>
<a href="clienti_index.php?id_tipo_cliente=2">Venditori</a>

<a href="clienti_index.php?id_tipo_cliente=1">Acquirenti</a>
<a href="clienti_index.php?id_tipo_cliente=3">Affittuari</a>
<a href="clienti_index.php?id_tipo_cliente=4">Cerca Affitto</a>
</div>


<!--2nd drop down menu --> 
<div id="dropmenu2" class="dropmenudiv" style="width: 150px;">
<a href="immobile_add.php?azione=add">Aggiungi Immobile</a>
<a href="immobili_index.php">Tutti gli immobili</a>
<a href="immobili_index.php?id_tipo_locazione=1">In Vendita</a>
<a href="immobili_index.php?id_tipo_locazione=2">In Affitto</a>
<a href="immobili_archiviati.php">Archiviati</a>
<a href="immobili_venduti.php">Archivio vendite</a>
</div>

<!--3nd drop down menu --> 
<div id="dropmenu3" class="dropmenudiv" style="width: 150px;">
<a href="richiesta_add.php?azione=add">Aggiungi Richiesta</a>
<a href="richieste_index.php?id_tipo_locazione=1">da Acquirenti</a>
<a href="richieste_index.php?id_tipo_locazione=2">da Affittuari</a>
 <a href="richieste_arichiate.php">Richieste Archiviate</a>
</div>

<!--4nd drop down menu --> 
<div id="dropmenu4" class="dropmenudiv" style="width: 150px;">
<a href="immobile_ricerca.php">Cerca Immobile</a>
<a href="richiesta_ricerca.php">Cerca Richiesta</a>


</div>

<!--5nd drop down menu --> 
<div id="dropmenu5" class="dropmenudiv" style="width: 150px;">
<a href="nota_add.php?azione=add">Aggiungi Nota</a>
<a href="nota_index.php">Tutte note</a>


</div>

<!--6nd drop down menu --> 
<div id="dropmenu6" class="dropmenudiv" style="width: 150px;">
<a href="sito_immobili.php">Lista Immobili </a>
<a href="sito_immobili_del.php">Rimuovi immobili sito </a>
<a href="sito_immobili.php?id_tipo_locazione=1">In Vendita</a>
<a href="sito_immobili.php?id_tipo_locazione=2">In Affitto</a>
<a href="sito_home.php">Gestione Home</a>
<a href="sito_newsletter.php">Gestione Newsletter</a>
<a href="">Messaggi Ricevuti</a>


<div id="dropmenu8" class="dropmenudiv" style="width: 150px;">
<a href="email_my.php">Mie Email Inviate</a>


</div>

<div id="dropmenu9" class="dropmenudiv" style="width: 150px;">
<a href="marketing_add.php?azione=add">Aggiungi</a>
<a href="marketing_index.php">Lista Marketing</a>


</div>
<!--7nd drop down menu --> 
<div  style="width: 150px;">

<!--<a href="gest_provincia.php">Gestione Provincia</a>
<a href="gest_citta.php">Gestione Citta</a>
<a href="gest_zona.php">Gestione zona</a>
<a href="gest_stato.php">Gestione Stato</a>
-->





</div>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>
	';
	}
	
	public function getMenu(){
		return $this->menu;
	}
	
	
	function setHeader(){
		
			$this->header='<a href="index.php">
<img id="img_logo" src="images/lgo.jpg"  alt="GestImm v2 " - " Rinaldelli Immobiliare">
</a>

';
                        $this->header .='<strong> Ricerca Rif.</strong>';
                        $this->header .='<form action="immobile_show.php" method="get">';
                        $this->header .='<input type="text" name="id_imm" value="">';
                        $this->header .='<input type="submit" name="submit" value="Ricerca">';
			$this->header .='</form>';
	
			
			
		
				
		
		
	}
	
	function getHeader(){
		return $this->header;
	}
	
	function setFooter(){
		$this->footer='
		<div id="footer">
			Copyright: Francesco Domenella	
	</div>';
	}
	
	
	function getFooter(){
		
			return $this->footer;
		
	}
	
	
	
	/**
	 * Setta il subheader contenetne la navigazione a briciole
	 *
	 * @param String $briciole
	 */
	function setSubHeaderBriciole($briciole){

			$this->subHeader='<div id="defaultsubhead_sx"></div><div id="defaultsubhead_cx">';
			$this->subHeader.= '<div id="briciole">'.$briciole.'</div>';
			$this->subHeader.='</div><div id="defaultsubhead_dx"></div>';
	}
	

function getTornaIndietro(){
		
		return '<div align="right"><a href="javascript:history.back();"> <strong>Torna Indietro</strong></a></div>';
	}
	
	
	
}

?>