<?php





function lista_immobili_web($id_tipo_locazione=""){
  $starttime = microtime();


  $db_sito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$str="";

	$q="select id_imm from immobile ";
	
	
	$r=$db_sito->query($q);
	$idImmSito= array();
	while($row_sito=mysql_fetch_array($r)){
    array_push($idImmSito,$row_sito['id_imm']);
  }
 // 		print_r($idImmSito);
		

//  exit;
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";

	if ($id_tipo_locazione=="all") {
		$q="select * from immobile ORDER BY id_imm DESC ";
	}else {

		$q="select * from immobile where id_tipo_locazione = $id_tipo_locazione ORDER BY id_imm DESC  ";
	}
	
	$r=$db->query($q);
	if (!$r) {
  		echo "<SCRIPT>";
		echo "alert(\"Nessun Immobile nel database\")";
		echo "</SCRIPT>";
		
		$str.="<tr><td  colspan=\"4\">NESSUN IMMOBILE NEL DATABASE</td></tr>";
	}	
	if (isset($nome)) {
		echo "<SCRIPT>";
		echo "alert(\"Nessun immobile nel database col nome ->  ".$nome."  <-\")";
		echo "</SCRIPT>";
		
		$str.= "Nessun immobile nel database col nome ->  ".$nome;
	}
	if ($r) {

		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"immobili_index\">";
	    $str.="<THEAD class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="Rif.Imm";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq/Prezzo";
		$str.="</TD>";
		 $str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		if ($id_tipo_locazione=="all"){
			$str.="<td>";
			$str.="Tipo di Locazione";
			$str.="</td>";
		}
		 $str.="<TD>";
		$str.="Stato";
		$str.="</TD>";
 $str.="<TD>";
		$str.="Rimuovi";
		$str.="</TD>";
		$str.="</TR>";
	
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_imm']."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_stampa($ro['id_imm']);
			$str.=" -- ";
			$str.= prezzo_stampa($ro['id_imm']);
			$str.="\n</TD\n>";
			
			$str.= "<TD class=\"clienti\">\n";
			$str.="<a href=\"immobile_show.php?id_imm=".$ro['id_imm']."\"><img src=\"images/immobile_dati.gif\" title=\"Visualizza Dati Dell'immobile\"/></a>";
			$str.=' <a title="Carica sul sito" href="sito_carica_immobile.php?azione=mod&id_imm='.$ro['id_imm'].'"><img src="images/web.gif" ></a>';
			$str.=' <a target="_black" title="Visualizza sul sito" href="http://www.immobiliarerinaldelli.com/immobile_show.php?id_imm='.$ro['id_imm'].'"><img src="images/immobile_remoto.jpg" ></a>';
			$str.= "\n</TD>\n";
			if ($id_tipo_locazione=="all"){
				$str.= "<TD class=\"clienti\">\n";
/*
				$str.= tipo_locazione($ro['id_tipo_locazione']);
*/
				$str.="</td>";
			}


			
			$str.= "<TD class=\"clienti_rif\">\n";
			$stato="";
			if(in_array($ro['id_imm'],$idImmSito)){
          $stato="OnLine";
      }else{
        $stato="OffLine";
      }
	//		$stato= controlla_stato_web($ro['id_imm'],$idImmSito);
			$str.= $stato."\n</TD>\n";
		    //$str.= "</TR>\n\n\n";

$str.= "<TD class=\"clienti_rif\">\n";
if($stato=="OnLine"){
			$str.= "<a href=\"http://www.immobiliarerinaldelli.com/admin/del.php?id_imm=".$ro['id_imm']." \" >Rimuovi</a>\n</TD>\n";
}else{
$str.= "\n</TD>\n";
}
		    $str.= "</TR>\n\n\n";
		    
		}
	
		
		$endtime = microtime();
    $str.=" inizio: \"";  //number_format($secs,3); 
    $str.=$starttime;
    $str.="\" fine: \"";
    $str.=$endtime;
    $str.= "\" totale: ";
    $str.=$endtime- $starttime;
    $str.= "in secs: ";    
    $str.=$endtime- $starttime;
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('immobili_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('immobili_index',Array('S','S','S','N',";
		if ($id_tipo_locazione=="all"){
			$str.="'S'";
		}
		$str.="));";
		$str.="</script>";
    
	}	
	
	return $str;
	
}

function controlla_stato_web($id_imm,$idImmArr){
	
	/*$db = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$str="";

	$q="select * from immobile where id_imm = $id_imm";
	
	
	$r=$db->query($q);
	if (!$r) {
  		
		
		return "OffLine";
	}	
	
	if ($r) {
		return "OnLine";
	}  */
	print_r($idImmArr);exit;
	if(in_array($id_imm,$idImmArr)){
      return "OnLine";
  } else{
       return "OffLine";
  }
	
}


/**
 * La funzione ha il compito di visualizzare le opzioni disponibili per l'immobile
 *
 * @param id del tipo di cliente $id_tipo_cliente
 */
function opzioni_immobile_web($id_tipo_locazione="", $id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$visualizza ="<a href=\"immobile_show.php?id_imm=".$id_imm."\"><img src=\"images/immobile_dati.gif\" title=\"Visualizza Dati Dell'immobile\"/></a>";
	
	$str="";

	switch ($id_tipo_locazione) {
		
		
		case 1: // venditore
			$richieste = "<a href=\"richiesta_ricerca_trova.php?id_imm=".$id_imm."\"><img class=\"cliente_opzioni\" src=\"images/immobile_vendo.gif\" title=\"Mostra Richieste Correlate all'immobile\"/></a>";
			$str.= $visualizza;
			$str.= $richieste;
		
			break;
		
		case 2: // cerca affitto
			
			$richieste = "<a href=\"richiesta_ricerca_trova.php?id_imm=".$id_imm."\"><img class=\"cliente_opzioni\" src=\"images/immobile_affitti.gif\" title=\"Mostra tutti i clienti disposti predere in affitto l'immobile\"/></a>";
			$str.= $visualizza;
			$str.= $richieste;
		
			break;
		case null:
		default:
			
			$str.="Nessuna Opzione";
			break;
	}
	return $str;
}

/**
 * Stampa la tabella contentente i dati del cliente passato tramite id_cli
 *
 * @param IDimmobile $id_imm
 * @param Tipo di azione $azione
 */
function immobile_form_web($azione="", $id_imm=""){
	
	
	
	
	
	
	
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if ($azione=="mod") {
		$q_mod="SELECT * FROM immobile WHERE immobile.id_imm = $id_imm";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	

	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"POST\" action=\"sito_carica_immobile_save.php\">\n";
	$query_foto="SELECT * FROM imm_img JOIN immagine ON immagine.id_img = imm_img.id_img WHERE id_imm=$id_imm";
	$result_foto=$db->query($query_foto);
	if ($result_foto) {
		$str.= "<div class=\"clienti\" >\n";
		$str.= "<TABLE id=\"clienti\">\n";
		
		while ($row_foto=mysql_fetch_array($result_foto)) {
			$str.= "<TR>\n";
		 	for ($i=0;$i<3; $i++){
			
				
				$str.= "<TD class=\"foto_box\">\n";
				$str.= immagine_stampa_low($row_foto['id_img']);
				$str.=" Carica? ";
				$str.='<input type="checkbox" name="id_img[]" value="'.$row_foto['id_img'].'"/>';
				$str.=' - Principale? <input type="radio" name="primaria" value="'.$row_foto['id_img'].'" />';
				$str.= "</TD>\n";
				$row_foto=mysql_fetch_array($result_foto);
				$i++;
				$str.= "<TD class=\"foto_box\">\n";
				$str.= immagine_stampa_low($row_foto['id_img']);
				$str.=" Carica? ";
				$str.='<input type="checkbox" name="id_img[]" value="'.$row_foto['id_img'].'"/>';
				$str.=' - Principale? <input type="radio" name="primaria" value="'.$row_foto['id_img'].'" />';
				$str.= "</TD>\n";
				$row_foto=mysql_fetch_array($result_foto);
				$i++;
				$str.= "<TD class=\"foto_box\">\n";
				$str.= immagine_stampa_low($row_foto['id_img']);
				
				$str.=" Carica? ";
				$str.='<input type="checkbox" name="id_img[]" value="'.$row_foto['id_img'].'"/>';
				$str.=' - Principale? <input type="radio" name="primaria" value="'.$row_foto['id_img'].'" />';
				$str.= "</TD>\n";
				
				
				
			}
			$str.= "</TR>";
		}
		
		
		
		$str.= "</TABLE>";
	
		$str.="</div>";
	}
	
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_imm\" value=\"";
		$str.= $id_imm;
		$str.= "\">\n";
	}	
	$str.= "<TABLE id=\"clienti\">\n";
	
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Locazione\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
	$q = "SELECT * FROM tipo_locazione";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ( $azione=="mod" AND $ro['id_tipo_locazione']==$ro_mod['id_tipo_locazione']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_tipo_locazione'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Rif.Num.\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input class=\"readonly\" type=\"text\" name=\"id_imm\"readonly value=\"";
	if ($azione=="mod") {
		$str.= $id_imm;
	}
	else {
		$str.=crea_id_imm();
	}
	$str.="\" size=\"10\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Immobile\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_immobile\">\n";

	$q = "SELECT * FROM tipo_immobile";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_tipo_immobile']==$ro_mod['id_tipo_immobile']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_tipo_immobile'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.=" Nuova Tipologia:\n";
	$str.= "<input type=\"text\"  name=\"new_tipo_immobile\" value=\"\" size=\"15\"/>\n";
	$str.= "</TD>";
	$str.= "</TR>";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Provincia\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_provincia\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM provincia";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_provincia']==$ro_mod['id_provincia']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_provincia'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.=" Nuova:\n";
	$str.= "<input type=\"text\"  name=\"new_provincia\" value=\"\" size=\"15\"/>\n";
	$str.= "</TD>";
	$str.= "</TR>";	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Citt&agrave;\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_citta\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM citta";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_citta']==$ro_mod['id_comune']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_citta'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.=" Nuova:\n";
	$str.= "<input type=\"text\"  name=\"new_citta\" value=\"\" size=\"15\"/>\n";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Zona\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_zona\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM zona";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_zona']==$ro_mod['id_zona']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_zona'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.=" Nuova:\n";
	$str.= "<input type=\"text\"  name=\"new_zona\" value=\"\" size=\"15\"/>\n";
	$str.= "</TD>";
	$str.= "</TR>";
	/*$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Via\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"via\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['via'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";*/
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['mq'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo\" value=\"";
	if ($azione=="mod") {
		if ($ro_mod['prezzo']==null) {
			$str.="0";
		}else{
			$str.= $ro_mod['prezzo'];
		}
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Classe Energetica\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"classe_en\" value=\"";
	if ($azione=="mod") {
		if ($ro_mod['classe_en']==null) {
			$str.="0";
		}else{
			$str.= $ro_mod['classe_en'];
		}
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Spese Condominiali\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"spese_cond\" value=\"";
	if ($azione=="mod") {
		if ($ro_mod['spese_cond']==null) {
			$str.="0";
		}else{
			$str.= $ro_mod['spese_cond'];
		}
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Vani\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"vani\" value=\"";
	if ($azione=="mod") {
		if ($ro_mod['vani']==null) {
			$str.="0";
		}else{
			$str.= $ro_mod['vani'];
		}
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	
	
/*	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Garage\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_garage\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM garage";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_garage']==$ro_mod['id_garage']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_garage'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Piani\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_piani\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['num_piani'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Camere\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_camere\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['num_camere'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";

	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Bagni\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_bagni\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['num_bagni'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Stato\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_stato\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM stato";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_stato']==$ro_mod['id_stato']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		$str.="<option $sel value=\"";
		$str.= $ro['id_stato'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";
	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";*/
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Note: non verranno caricate sul sito";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<textarea rows=\"10\" cols=\"80\"  name=\"note_read\" readonly>";
	if ($azione=="mod") {
		$str.= $ro_mod['note'];
	}	
	$str.="</textarea>";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Note X SITO";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<textarea rows=\"10\" cols=\"80\"  name=\"note\">";
	if ($azione=="mod") {
		$str.= $ro_mod['note_sito'];
	}	
	$str.="</textarea>";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD colspan=\"2\"  align=\"center\">";
	$str.= "<input type=\"submit\" value=\"Submit\" class=\"buttonSubmit\" />";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "</TABLE>";
	$str.="</form>";
	$str.="</div>";

	
	return $str;
}


function inserisci_zona_web($nome_zona=""){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$nome_zona= sistemaTesto($nome_zona);
	$q="INSERT INTO zona (id_zona, nome) VALUES (null,'$nome_zona')";
	$r=$dbSito->query($q);
	$id_zona=mysql_insert_id();
	return $id_zona;
}


/**
 * Inserisci una citta nel db e ritorna il suo id
 *
 * @param unknown_type $nome_citta
 * @return id_citta $id_citta
 */
function inserisci_citta_web($nome_citta=""){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$nome_citta= sistema_testo_provincia(sistemaTesto($nome_citta));
	$q="INSERT INTO citta (id_comune, nome) VALUES (null,'$nome_citta')";
	$r=$dbSito->queryInsert($q);
	$id_citta=mysql_insert_id();
	return $id_citta;
}

/**
 * Inserisci una tipo_immobile nel db e ritorna il suo id
 *
 * @param unknown_type $nome_tipo_immobile
 * @return id_tipo_immobile $id_tipo_immobile
 */
function inserisci_tipo_immobile_web($nome_immobile=""){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$nome_immobile= sistemaTesto($nome_immobile);
	$nome_immobile= str_replace("'", "\'", $nome_immobile);
	$q="INSERT INTO tipologia (id_tipologia, nome) VALUES (null,'$nome_immobile')";
	$r=$dbSito->query($q);
	$id=mysql_insert_id();
	return $id;
}

/**
 * Inserisci una provincia nel db e ritorna il suo id
 *
 * @param unknown_type $nome_provincia
 * @return id_provincia $id_provincia
 */
function inserisci_provincia_web($nome_provincia=""){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$nome_provincia=  sistemaTesto($nome_provincia);
	$nome_provincia= str_replace("'", "\'", $nome_provincia);	
	$q="INSERT INTO provincia (id_provincia, nome) VALUES (null,'$nome_provincia')";
	$r=$dbSito->query($q);
	$id=mysql_insert_id();
	return $id;
}


/**
 * controlla che la zona selezionata esista sul sito, se non esiste la crea e ritorna l'id
 *
 * @param unknown_type $id_zona
 * @return id_zona
 */
function check_zona_web($id_zona){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	
	$q="SELECT * FROM zona WHERE id_zona = $id_zona";
	$r=$dbSito->query($q);
	if (!$r) {
		/**
		 * la zona non c'�
		 */
		//recupero i valori dal db locale
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		$query_locale="SELECT * FROM zona WHERE id_zona= $id_zona";
		$result_locale=$db->query($query_locale);
		$row_locale=mysql_fetch_array($result_locale);
		$valore= sistemaTesto($row_locale['nome']);
		$valore = str_replace("'", "\'", $valore);
		$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
		$query_remota="INSERT INTO zona (id_zona, nome) VALUES ($id_zona,'$valore')";
		$result_remoto=$dbSito->queryInsert($query_remota);
		return $id_zona;
	}
	else {
		/**
		 * la zona c'�
		 */
		
		return $id_zona;
	}
	
}

function check_comune_web($id_comune){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	
	$q="SELECT * FROM comune WHERE id_comune = $id_comune";
	$r=$dbSito->query($q);
	if (!$r) {
		/**
		 * il ocmune non c'�
		 */
		//recupero i valori dal db locale
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		$query_locale="SELECT * FROM citta WHERE id_citta= $id_comune";
		$result_locale=$db->query($query_locale);
		$row_locale=mysql_fetch_array($result_locale);
		$valore= sistemaTesto($row_locale['nome']);
		$valore = str_replace("'", "\'", $valore);

		$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
		$query_remota="INSERT INTO comune (id_comune, nome) VALUES ($id_comune,'$valore')";
		$result_remoto=$dbSito->queryInsert($query_remota);
		return $id_comune;
	}
	else {
		/**
		 * il comune c'�
		 */
		
		return $id_comune;
	}
	
}


function sistema_testo_provincia($str){
	str_replace("'", "\'", $str);

	if(!get_magic_quotes_gpc()){  
		$str     = stripslashes($str);  
		
		
		$str      = mysql_real_escape_string($str); 
str_replace("'", "\'", $str);
		
 
	} else{
		
		str_replace("'", "\'", $str);
		

	}
		
		
	return str_replace("'", "\'", $str);}



function check_provincia_web($id){
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	
	$q="SELECT * FROM provincia WHERE id_provincia = $id";
	$r=$dbSito->query($q);
	if (!$r) {
		/**
		 * la prov c'�
		 */
		//recupero i valori dal db locale
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		$query_locale="SELECT * FROM provincia WHERE id_provincia= $id";
		$result_locale=$db->query($query_locale);
		$row_locale=mysql_fetch_array($result_locale);
		$valore= sistema_testo_provincia(sistemaTesto($row_locale['nome']));
		
		$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
		$query_remota="INSERT INTO provincia (id_provincia, nome) VALUES ($id,'$valore')";
		$result_remoto=$dbSito->queryInsert($query_remota);
		return $id;
	}
	else {
		/**
		 * la prov c'�
		 */
		
		return $id;
	}
	
}


function check_tipo_immobile_web($id){
	
	
	
	$dbSito2 = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	
	$q="SELECT * FROM tipologia WHERE id_tipologia = $id";
	$r=$dbSito2->query($q);
	if (!$r) {
		/**
		 * la prov c'�
		 */
		//recupero i valori dal db locale
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		$query_locale="SELECT * FROM tipo_immobile WHERE id_tipo_immobile= $id";
		$result_locale=$db->query($query_locale);
		$row_locale=mysql_fetch_array($result_locale);
		$valore= sistemaTesto($row_locale['nome']);
		$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
		$query_remota="INSERT INTO tipologia (id_tipologia, nome) VALUES ($id,'$valore')";
		$result_remoto=$dbSito->queryInsert($query_remota);
		return $id;
	}
	else {
		/**
		 * la prov c'�
		 */
		
		return $id;
	}
	
}
?>