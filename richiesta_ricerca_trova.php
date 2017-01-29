<?php

include_once("./framework/framework.php");

$layout = new Layout("");

/**
 * 
 * CONFIGURAZIONI GLOBALI DEI CRITERI
 * 
 * 
 */
		$mq_inmeno=20; // i metri quadri che sottraggo ai dati dal db per la ricerca
		$mq_inpiu=20;
		$prezzo_inmeno = 20000;
		$prezzo_inpiu= 10000;
		
		$num_piani_inmeno=1;
		$num_piani_inpiu=1;
		$num_bagni_inmeno=1;
		$num_bagni_inpiu=1;
		$num_camere_inmeno=2;
		$num_camere_inpiu=2;

		
			
if (isset($_GET['id_imm'])) {
			
	/**
	 * 	 
	 * QUESTE OPERAZIONI VENGONO FATTE SOLO SE LA RICERCA ï¿½ FATTA TRAMITE RICHIESTA DA DB
	 *
	 */
	
	/**
		 * 
		 * imposto la ricerca da db se mirata oppure no
		 * 1=> mirata
		 * 0=> non mirat
		 * 
		 */
		$tipo_ricerca=0;  // imposto il tipo di ricerca per la  RICERCA DAL DATABASE
	
	
	
	$id_imm=$_GET['id_imm'];
	
	$q="SELECT * FROM immobile WHERE id_imm=$id_imm";
	$r=$db->query($q);
	$ro=mysql_fetch_array($r);
	
	
	if($ro['id_tipo_locazione']==null){
	
		$querylocazione = "";
	}
	else{
		$querylocazione = "id_tipo_locazione  = $ro[id_tipo_locazione] AND";
	}
	
	if($ro['id_tipo_immobile']==null){
		$querytipoimmobile = "";
		$querytipoimmobilejoin="";
	}
	else{
		$querytipoimmobilejoin="JOIN ric_tipo_imm ON ric_tipo_imm.id_tipo_immobile = richiesta.id_ric";
		$querytipoimmobile = "id_tipo_immobile  = $ro[id_tipo_immobile] AND";
	}
	
	
	if($ro['id_provincia']==null){
		$queryprovincia = "";
	}
	else{
		$queryprovincia = "id_provincia  = $ro[id_provincia] AND";
	}
	
	if($ro['id_comune']==null){
		$querycitta = "";
	}
	else{
		$querycitta = "id_comune  = $ro[id_comune] AND";
	}
		
	
	if ($tipo_ricerca==1) {
			
		
		if($ro['mq']==null){
			$querymq = "";
		}
		
		else {
			$querymq = "mq_min  >= $ro[mq] AND mq_max  <= $ro[mq] AND";
			
		}
		
		if($ro['prezzo']==null){
			$queryprezzo = "";
		}
		else {
			$queryprezzo = "prezzo_min  >= $ro[prezzo] and prezzo_max  <= $ro[prezzo] AND";
			
		}
		
		
		if($ro['id_garage']==null){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $ro[id_garage] AND";
		}
                
                
		if($ro['id_zona']==null){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $ro[id_zona] AND";
		}
		
		if($ro['num_piani']==null){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani = $ro[num_piani] AND";
		}
		if($ro['num_bagni']==null){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  = $ro[num_bagni] AND";
		}
		if($ro['num_camere']==null){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  = $ro[num_camere] AND";
		}
		
		if($ro['id_stato']==null){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $ro[id_stato] AND";
		}
	}else {
		/**
		 * ricerca sommaria
		 */
		if($ro['mq']==null){
			$querymq = "";
		}
		
		else {
			$querymq = "mq_min  >= $ro[mq]-$mq_inmeno AND mq_max  <= $ro[mq]+$mq_inpiu AND";
			
		}
		
		if($ro['prezzo']==null){
			$queryprezzo = "";
		}
		else {
			$queryprezzo = "prezzo_min  >= $ro[prezzo]-$prezzo_inmeno and prezzo_max  <= $ro[prezzo]+$prezzo_inpiu AND";
			
		}
		
		
		if($ro['id_garage']==null){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $ro[id_garage] AND";
		}
                
                if($ro['id_zona']==null){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $ro[id_zona] AND";
		}
                
                
		if($ro['num_piani']==null){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani  >= $ro[num_piani]-$num_piani_inmeno and num_piani <= $ro[num_piani]+$num_piani_inpiu AND";
		}
		if($ro['num_bagni']==null){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  >= $ro[num_bagni]-$num_bagni_inmeno and num_bagni  <= $ro[num_bagni]+$num_bagni_inpiu AND";
		}
		if($ro['num_camere']==null){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  >= $ro[num_camere]-$num_camere_inmeno and num_camere  <= $ro[num_camere]+$num_camere_inpiu AND";
		}
		
		if($ro['id_stato']==null){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $ro[id_stato] AND";
		}
	}
	
	
}
/**
 * 
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 */


else {
	
	/**
	 * 
	 *QUESTE OPERAZIONI VENGONO FATTE SOLO SE L'UTENTE HA EFFETTUATO UNA RICERCA MANUALE 
	 * 
	 */
	$id_imm="";
	
	
		

	
	
	if($_GET['id_tipo_locazione']=="all"){
	
		$querylocazione = "";
	}
	else{
		$querylocazione = "id_tipo_locazione  = $_GET[id_tipo_locazione] AND";
	}
	
	
	if($_GET['id_tipo_immobile']=="all"){
		$querytipoimmobile = "";
		$querytipoimmobilejoin="";
	}
	else{
		$querytipoimmobile = "id_tipo_immobile  = $_GET[id_tipo_immobile] AND";
		$querytipoimmobilejoin="JOIN ric_tipo_imm ON ric_tipo_imm.id_tipo_immobile = richiesta.id_ric";
	}
	
	if($_GET['id_provincia']=="all"){
		$queryprovincia = "";
	}
	else{
		$queryprovincia = "id_provincia  = $_GET[id_provincia] AND";
	}
	
	if($_GET['id_citta']=="all"){
		$querycitta = "";
	}
	else{
		$querycitta = "id_comune  = $_GET[id_citta] AND";
	}
		
	
	if ($_GET['tipo_ricerca']==1) {
			
		
		if($_GET['mq_min']=="" and $_GET['mq_max']==""){
			$querymq = "";
		}
		elseif ($_GET['mq_min']!="" and $_GET['mq_max']!=""){
			$querymq = "mq_min  >= $_GET[mq_min] and mq_max <= $_GET[mq_max] AND";
		}
		elseif ($_GET['mq_min']!=""){
			$querymq = "mq_min  >= $_GET[mq_min] and";
			
		}else{
			$querymq = "mq_max <= $_GET[mq_max] AND";
		}
		
		if($_GET['prezzo_min']=="" and $_GET['prezzo_max']==""){
			$queryprezzo = "";
		}
		elseif ($_GET['prezzo_min']!="" and $_GET['prezzo_max']!=""){
			$queryprezzo = "prezzo_min  >= $_GET[prezzo_min] and prezzo_max <= $_GET[prezzo_max] AND";
		}
		elseif ($_GET['prezzo_min']!=""){
			$queryprezzo = "prezzo_min  >= $_GET[prezzo_min] and";
			
		}else{
			$queryprezzo = "prezzo_max <= $_GET[prezzo_max] AND";
		}
		
		
		if($_GET['id_garage']=="all"){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $_GET[id_garage] AND";
		}
                
                if($_GET['id_zona']=='Tutte'){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $_GET[id_zona] AND";
		}
		
		if($_GET['num_piani']==""){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani = $_GET[num_piani] AND";
		}
		if($_GET['num_bagni']==""){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  = $_GET[num_bagni] AND";
		}
		if($_GET['num_camere']==""){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  = $_GET[num_camere] AND";
		}
		
		if($_GET['id_stato']=="all"){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $_GET[id_stato] AND";
		}
	}else {
		/**
		 * ricerca sommaria
		 */
		if($_GET['mq_min']=="" and $_GET['mq_max']==""){
			$querymq = "";
		}
		elseif ($_GET['mq_min']!="" and $_GET['mq_max']!=""){
			$querymq = "mq_min  >= $_GET[mq_min]-$mq_inmeno and mq_min <= $_GET[mq_max]+$mq_inpiu AND";
		}
		elseif ($_GET['mq_min']!=""){
			$querymq = "mq_min  >= $_GET[mq_min]-$mq_inmeno and";
			
		}else{
			$querymq = "mq_max <= $_GET[mq_max]+$mq_inpiu AND";
		}
		
		if($_GET['prezzo_min']=="" and $_GET['prezzo_max']==""){
			$queryprezzo = "";
		}
		elseif ($_GET['prezzo_min']!="" and $_GET['prezzo_max']!=""){
			$queryprezzo = "prezzo_min  >= $_GET[prezzo_min]-$prezzo_inmeno and prezzo_min <= $_GET[prezzo_max]+$prezzo_inpiu AND";
		}
		elseif ($_GET['prezzo_min']!=""){
			$queryprezzo = "prezzo_min  >= $_GET[prezzo_min]-$prezzo_inmeno and";
			
		}else{
			$queryprezzo = "prezzo_max <= $_GET[prezzo_max]+$prezzo_inpiu AND";
		}
		
		
		if($_GET['id_garage']=="all"){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $_GET[id_garage] AND";
		}
                
                if($_GET['id_zona']=="Tutte"){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $_GET[id_zona] AND";
		}
		if($_GET['num_piani']==""){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani  >= $_GET[num_piani]-$num_piani_inmeno and num_piani <= $_GET[num_piani]+$num_piani_inpiu AND";
		}
		if($_GET['num_bagni']==""){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  >= $_GET[num_bagni]-$num_bagni_inmeno and num_bagni  <= $_GET[num_bagni]+$num_bagni_inpiu AND";
		}
		if($_GET['num_camere']==""){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  >= $_GET[num_camere]-$num_camere_inmeno and num_camere  <= $_GET[num_camere]+$num_camere_inpiu AND";
		}
		
		if($_GET['id_stato']=="all"){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $_GET[id_stato] AND";
		}
	}	
}










$query="SELECT * FROM richiesta $querytipoimmobilejoin WHERE $querylocazione $querytipoimmobile $queryprovincia $querycitta $querymq
$querygarage $queryzona $queryprezzo $querynum_bagni $querynum_piani $querynum_camere $queryid_stato";
$s=strlen(trim($query));
$query = substr_replace($query,"",$s-3);

echo $query;


/**
 * qui posso inserire un possibile ordinamento
 */

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $title_html . " - " . $nome_azienda; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="gestimm2_.css">

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />

<script type="text/javascript" src="chromejs/chrome.js"></script>

<script>

function checkForm(){
	  var e = document.getElementById("id_tipo_cliente");
      var item = e.options[e.selectedIndex].value;
		if(item==""){
			alert("Seleziona che tipo di cliente e'!");
			e.focus();
			return false;
		}
      
}

</script>


<?php 
echo $menu_fix; 
include_once("inc.js_sortTable.php"); 
?>
<script type="text/javascript" src="row_highLight.js"></script>

</head>

<body>




<div id="body">
	
<div id="head"> 
  <?php
		
		echo $layout->getHeader();
		echo $layout->getMenu();
		?>
</div>
	
	
	
<div id="center"> 
  <div id="sx"> 
    <?php
			$cont='<a href="immobile_ricerca.php"><img src="images/add.gif" class="img_menu_sx">Nuova Ricerca</a><br/>';
			$menu_sx = new Menu_Sx($cont);
			echo $menu_sx->getMenuSx();
			?>
  </div>
  <div id="dx"> 
    <?php
		include("inc.tornaindietro.php");
		?>
    <h2>Elenco Richieste filtrate</h2>
    <?php
				if ($id_imm!="") {
					echo scheda_immobile($id_imm);
				}
				
				
					echo lista_ricerca_richieste($query);
					

				?>
  </div>
</div>

</body>
</html>