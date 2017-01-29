<?php



/**
 * Ritorna il valore testuale del tipo di cliente
 *
 * @param id_cliente $id_tipo_cliente
 * @return nome
 */
function tipo_cliente($id_tipo_cliente=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_tipo_cliente=="") {
		return "Tutti i Clienti";
	}
	$q="SELECT * FROM tipo_cliente WHERE id_tipo_cliente=$id_tipo_cliente";
	$r=$db->query($q);
	if (!$r) {
		return "Dato Assente";
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['nome'];
	}
}


function stampa_tipo_cliente($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_cli=="") {
		return 0;
	}
	$q="SELECT * FROM tipo_cliente AS t JOIN cliente ON cliente.id_tipo_cliente=t.id_tipo_cliente WHERE id_cli=$id_cli";
	$r=$db->query($q);
	if (!$r) {
		return 0;
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['id_tipo_cliente'];
	}
}

/**
 * Ritorna un valora dal db 
 *
 * @param Singolo_VALORE_DI_RITORNO $lista_nomi
 * @param Nome_Tabella $tabella
 * @param Clusola_where $clausola_where
 * @return nome
 */
function val_from_db($lista_nomi="",$tabella="", $clausola_where=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT '$lista_nomi' FROM $tabella WHERE $clausola_where";
	$r=$db->query($q);
	$ro= mysql_fetch_array($r);
	return $ro[$lista_nomi];
}


function nominativo_stampa($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT * FROM cliente WHERE id_cli=$id_cli";
	$r=$db->query($q);
	if (!$r) {
		return "Dato Assente";
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['nominativo'];
	}
}

function marketing_nome_stampa($id_mrk=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT * FROM marketing WHERE id_mrk=$id_mrk";
	$r=$db->query($q);
	if (!$r) {
		return "Dato Assente";
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['nome'];
	}
}

function spacer($altezza="",$larghezza="1"){
	return "<img src=\"images/spacer.gif\" height=\"".$altezza."px\" width=\"".$larghezza."px\"/>";
}

/*
function lista_clienti($id_tipo_cliente=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q="select * from cliente  ";
	if ($id_tipo_cliente!="") {
		$q.="where id_tipo_cliente = $id_tipo_cliente";
	}
	
	$q.=" order by nominativo asc";
	$r=$db->query($q);
	if (!$r) {
  		echo "<SCRIPT>";
		echo "alert(\"Nessun Cliente nel database\")";
		echo "</SCRIPT>";
		
		$str.="<tr><td  colspan=\"4\">NESSUN CLIENTE NEL DATABASE</td></tr>";
	}	
	if (isset($nome)) {
		echo "<SCRIPT>";
		echo "alert(\"Nessun Cliente nel database col nome ->  ".$nome."  <-\")";
		echo "</SCRIPT>";
		
		$str.= "Nessun Cliente nel database col nome ->  ".$nome;
	}
	if ($r) {
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"clienti\">";
	    $str.="<THEAD class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="Nominativo";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Telefono";
		$str.="</TD>";
                $str.="<TD>";
		$str.="Email";
		$str.="</TD>";
		 $str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		if ($id_tipo_cliente=="") {
			$str.= "<TD>Tipo Cliente</TD>";
		}
		$str.="</TR>";

		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= nominativo_stampa($ro['id_cli'])."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_citta'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= telefono_stampa($ro['id_cli'])."\n</TD\n>";
                        $str.= "<TD class=\"clienti\">\n";
			$str.= email_stampa($ro['id_cli'])."\n</TD\n>";
			$str.= "<TD class=\"clienti_opz\">\n";
			$str.= opzioni_cliente($id_tipo_cliente,$ro['id_cli'])."\n</TD>\n";
			if ($id_tipo_cliente=="") {
				$str.= '<TD class="clienti_tipoCliente">';
				$str.=tipo_cliente($ro['id_tipo_cliente']);
				$str.='</TD>';
			}
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('clienti','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('clienti',Array('S','S','S','S'));";
		$str.="</script>";
	}	
	
	return $str;
	
}
*/

function lista_clienti($id_tipo_cliente=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q="select * from cliente  ";
	if ($id_tipo_cliente!="") {
		$q.="where id_tipo_cliente = $id_tipo_cliente";
	}
	
	$q.=" order by nominativo asc";
	$r=$db->query($q);
	if (!$r) {
  		echo "<SCRIPT>";
		echo "alert(\"Nessun Cliente nel database\")";
		echo "</SCRIPT>";
		
		$str.="<tr><td  colspan=\"4\">NESSUN CLIENTE NEL DATABASE</td></tr>";
	}	
	if (isset($nome)) {
		echo "<SCRIPT>";
		echo "alert(\"Nessun Cliente nel database col nome ->  ".$nome."  <-\")";
		echo "</SCRIPT>";
		
		$str.= "Nessun Cliente nel database col nome ->  ".$nome;
	}
	if ($r) {
		$str.='<table width="1000px" class="display" id="example" cellspacing="0">
        <thead>
            <tr>
                 <th>Nominativo</th>
                <th>Citta</th>
                <th>Telefono</th>
                <th>Email</th>
               
                <th>Opzioni</th>
                <th>Tipo Cliente</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nominativo</th>
                <th>Citta</th>
                <th>Telefono</th>
                <th>Email</th>
               
                <th>Opzioni</th>
                <th>Tipo Cliente</th>
                
            </tr>
        </tfoot>
        <tbody>';
                
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD >\n";
			$str.= nominativo_stampa($ro['id_cli'])."\n</TD>\n";
		    $str.= "<TD>\n";
			$str.= citta_stampa($ro['id_citta'])."\n</TD>\n";
			$str.= "<TD >\n";
			$str.= telefono_stampa($ro['id_cli'])."\n</TD\n>";
                        $str.= "<TD >\n";
			$str.= email_stampa($ro['id_cli'])."\n</TD\n>";
			$str.= "<TD >\n";
			$str.= opzioni_cliente($id_tipo_cliente,$ro['id_cli'])."\n</TD>\n";
			if ($id_tipo_cliente=="") {
				$str.= '<TD >';
				$str.=tipo_cliente($ro['id_tipo_cliente']);
				$str.='</TD>';
			}
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		
		
	}	
	
	return $str;
	
}
/**
 * Stampa il numero di telefono del cliente tramite il suo id,
 * spampa prima il cell, se non c'� il cell stampa quello fisso
 * oppure da un msg di errore
 *
 * @param ID del cliente $id_cli
 * @return telefono
 */
function telefono_stampa($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT tel_fisso, tel_mobile FROM cliente WHERE id_cli = $id_cli";
	$r=$db->query($q);
        if($r){
	$ro=mysql_fetch_array($r);
	if (isset($ro['tel_mobile'])) {
		return $ro['tel_mobile'];
	}
	if (isset($ro['tel_fisso'])) {
		return $ro['tel_fisso'];
        }}
	return "Dato assente";
}
function email_stampa($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT email FROM cliente WHERE id_cli = $id_cli";
	$r=$db->query($q);
        if($r){
            $ro=mysql_fetch_array($r);
            
            return $ro['email'];
            
        
        }
	return "Dato assente";
}
function nota_stampa($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT nota FROM cliente WHERE id_cli = $id_cli";
	$r=$db->query($q);
        if($r){
	$ro=mysql_fetch_array($r);
	if (isset($ro['nota'])) {
		return $ro['nota'];
	}
	}
	return "Dato assente";
}

function citta_stampa($id_citta=" "){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if($id_citta!=""){
		$q1="SELECT nome FROM citta WHERE id_citta = $id_citta";
		
		
		$r1 = $db->query($q1);
                if($r1){
		$ro1=mysql_fetch_array($r1); ///////////// 20151009 mod
		if ($ro1['nome']==null) {
			return "Dato Assente";
		}else{
			return $ro1['nome'];
                }}
                
	}else {
		return "Dato Assente";
	}
}
/*
function zona_stampa($id_zona=" "){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if($id_zona!=""){
		$q1="SELECT nome FROM zona WHERE id_zona = $id_zona";
		
		
		$r1 = $db->query($q1);
		$ro1=mysql_fetch_array($r1);
		if ($ro1['nome']==null) {
			return "Dato Assente";
		}else{
			return $ro1['nome'];
		}
	}else {
		return "Dato Assente";
	}
} */


function zona_stampa($id_zona=" "){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if($id_zona!=""){
		$q1="SELECT nome FROM zona WHERE id_zona = $id_zona";
		$r1 = $db->query($q1);
                if($r1){
		$ro1=mysql_fetch_array($r1);
		if ($ro1['nome']==null) {
			return "Dato Assente";
		}else{
			return $ro1['nome'];
		}
                }
	}else {
		return "Dato Assente";
	}
}


/**
 * La funzione ha il compito di visualizzare le opzioni disponibili per il cliente
 *
 * @param id del tipo di cliente $id_tipo_cliente
 */
function opzioni_cliente($id_tipo_cliente="", $id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$visualizza ="<a href=\"cliente_show.php?id_cli=".$id_cli."\"><img src=\"images/cliente_dati.gif\" title=\"Visualizza Dati Cliente\"/></a>";
	$opzione ="<a href=\"popup_immobili.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_popup_immobili.gif\" title=\"Mostra Immobile/i del cliente\"/></a>";
	$str="";

	switch ($id_tipo_cliente) {
		
		case 1: // acquirente
			//$opzione ="<a href=\"popup_richieste.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_popup_richieste.gif\" title=\"Mostra Richiesta/e del cliente\"/></a>";
		//	$richieste = "<a href=\"immobile_cerca.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_richieste.gif\" title=\"Mostra Immobili Affini alle richieste del cliente\"/></a>";
			$str.= $visualizza;
		//	$str.= $richieste;
		//	$str.=$opzione;
			break;
		case 2: // venditore
			//$richieste = "<a href=\"richieste_cerca.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_vendo.gif\" title=\"Mostra Richieste Correlate all'immobile del cliente\"/></a>";
			$str.= $visualizza;
		//	$str.= $richieste;
		//	$str.=$opzione;
			break;
		case 3: // affittuario
			$richieste = "<a href=\"affittuario_cerca.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_affittuario.gif\" title=\"Mostra  persone disposte ad acquistare l'immobile del cliente\"/></a>";
			$str.= $visualizza;
		//	$str.= $richieste;
			//$str.=$opzione;
			break;
		case 4: // cerca affitto
		//	$opzione ="<a href=\"popup_affitti.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_popup_affitti.gif\" title=\"Mostra Richieste di affitti del cliente\"/></a>";
		//	$richieste = "<a href=\"affitti_cerca.php?id_cli=".$id_cli."\"><img class=\"cliente_opzioni\" src=\"images/cliente_cerco_affitti.gif\" title=\"Mostra gli immobili in affitto adatti alle richieste del cliente\"/></a>";
			$str.= $visualizza;
		//	$str.= $richieste;
		//	$str.=$opzione;
			break;
	
		default:
			$str.= $visualizza;
			
			break;
	}
	return $str;
}

function scheda_acquirente_immobile($id_imm){
        $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
        $id_cli=
	$str="";
	if (isset($id_cli)) {
		$q="SELECT * FROM cliente WHERE  id_cli=$id_cli";
		$r=$db->query($q);
		$ro=mysql_fetch_array($r);
		
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti1\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
		$str.="Dati cliente ".nominativo_stampa($ro['id_cli']);
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Nominativo\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.="<a href=\"cliente_show.php?id_cli=";
		$str.= $ro['id_cli'];
		$str.="\">";
		$str.= nominativo_stampa($ro['id_cli']);
		$str.="</a>";
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Tipo di Cliente\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= tipo_cliente($ro['id_tipo_cliente']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "E-Mail\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['email'];
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Codice Fiscale\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['codfisc'];
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Citt&agrave;\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= citta_stampa($ro['id_citta']);
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Via";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['via'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Telefono Fisso";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['tel_fisso'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Telefono Cellulare";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['tel_mobile'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Note";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['nota'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Inserito Da";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= idUtenteToNome($ro['id_utente_ins']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	else {
		$str.="<center>Nessun Cliente selezionato</center>";
	}
	return $str;
}

/**
 * Stampa la tabella contentente i dati del cliente passato tramite id_cli
 *
 * @param ID cliente $id_cli
 */
function scheda_marketing($id_mrk=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if (isset($id_mrk)) {
		$q="SELECT * FROM marketing WHERE  id_mrk=$id_mrk";
		$r=$db->query($q);
		$ro=mysql_fetch_array($r);
		
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti1\">\n";
		$str.="<tr>\n";
		
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Nominativo\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['nome'];
		$str.= "</TD>\n";
                $str.="</tr>";
		$str.="<tr>";
                $str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Note\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['note'];
		$str.= "</TD>\n";
		$str.="</tr>";
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	else {
		$str.="<center>Nessun Marketing selezionato</center>";
	}
	return $str;
}

/**
 * Stampa la tabella contentente i dati del cliente passato tramite id_cli
 *
 * @param ID cliente $id_cli
 */
function scheda_cliente($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if (isset($id_cli)) {
		$q="SELECT * FROM cliente WHERE  id_cli=$id_cli";
		$r=$db->query($q);
		$ro=mysql_fetch_array($r);
		
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti1\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
		$str.="Dati cliente ".nominativo_stampa($ro['id_cli']);
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Nominativo\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.="<a href=\"cliente_show.php?id_cli=";
		$str.= $ro['id_cli'];
		$str.="\">";
		$str.= nominativo_stampa($ro['id_cli']);
		$str.="</a>";
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Tipo di Cliente\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= tipo_cliente($ro['id_tipo_cliente']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "E-Mail\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['email'];
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Codice Fiscale\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['codfisc'];
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Citt&agrave;\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= citta_stampa($ro['id_citta']);
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Via";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['via'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Telefono Fisso";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['tel_fisso'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Telefono Cellulare";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['tel_mobile'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Note";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['nota'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Inserito Da";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= idUtenteToNome($ro['id_utente_ins']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	else {
		$str.="<center>Nessun Cliente selezionato</center>";
	}
	return $str;
}



/**
 * Stampa la tabella contentente i dati del cliente passato tramite id_cli
 *
 * @param ID cliente $id_cli
 */
function immobili_visionati($id_cli=""){
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";


	$q="select * from immobile i JOIN immobile_visite v ON v.id_imm=i.id_imm where v.id_cli = $id_cli ORDER BY v.data asc";

	$r=$db->query($q);
	if (!$r) {
  	
		$str.="<tr><td  colspan=\"4\">Nessun immobile proposto <a href=\"index.php\" >PROPONI</A></td></tr>";
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
		$str.="Data";
		$str.="</TD>";
		 $str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		
		$str.="<td>";
			$str.="Proprietario";
			$str.="</td>";
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
			$str.='<td>';
                        $str .=$ro['data'];
                        $str.='</td>';
			$str.= "<TD class=\"clienti\">\n";
			
			$str.= opzioni_immobile($ro['id_tipo_locazione'],$ro['id_imm'])."\n</TD>\n";
			
		   
		    $str.= "<TD class=\"clienti\">\n";
		    $str.= nominativo_stampa(id_imm_to_id_cli($ro['id_imm']));
		     $str.= "</TD>\n";
		      $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('immobili_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('immobili_index',Array('S','S','S','N',";
		
		$str.="));";
		$str.="</script>";

	}	
	
	return $str;
	
}



/**
 * Stampa la tabella contentente i dati del cliente passato tramite id_cli
 *
 * @param ID cliente $id_cli
 */
function cliente_form($azione="", $id_cli=""){
	
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if ($azione=="mod") {
		$q_mod="SELECT * FROM cliente WHERE id_cli = $id_cli";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"POST\" action=\"cliente_save.php\" onsubmit=\"return checkForm();\">\n";
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_cli\" value=\"";
		$str.= $id_cli;
		$str.= "\">\n";
	}	
	$str.= "<TABLE id=\"clienti\">\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Cliente\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select id=\"id_tipo_cliente\" size=\"1\" name=\"id_tipo_cliente\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM tipo_cliente";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		if ($azione=="mod" and $ro['id_tipo_cliente']==$ro_mod['id_tipo_cliente']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_tipo_cliente'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Nominativo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\" name=\"nominativo\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['nominativo'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "E-Mail\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"email\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['email'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Codice Fiscale\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"codfis\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['codfisc'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Citt&agrave;\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_citta\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM citta order by nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ( $azione =="mod" and $ro['id_citta']==$ro_mod['id_citta']) {
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
	$str.= "<input type=\"text\"  name=\"new_citta\" value=\"\" size=\"20\"/>\n";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Via";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<input type=\"text\"  name=\"via\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['via'];
	}	
	$str.="\" size=\"40\"/>";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Telefono Fisso";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<input type=\"text\"  name=\"fisso\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['tel_fisso'];
	}	
	$str.="\" size=\"40\"/>";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Cellulare";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<input type=\"text\"  name=\"mobile\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['tel_mobile'];
	}	
	$str.="\" size=\"40\"/>";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Nota";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<input type=\"text\"  name=\"nota\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['nota'];
	}	
	$str.="\" size=\"40\"/>";
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


function marketing_form($azione="", $id_mrk=""){
	
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if ($azione=="mod") {
		$q_mod="SELECT * FROM marketing WHERE id_mrk = $id_mrk";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"POST\" action=\"marketing_save.php\" onsubmit=\"return checkForm();\">\n";
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_mrk\" value=\"";
		$str.= $id_mrk;
		$str.= "\">\n";
	}	
	$str.= "<TABLE id=\"clienti\">\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Nome\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\" name=\"nominativo\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['nome'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Nota";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<input type=\"text\"  name=\"nota\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['nota'];
	}	
	$str.="\" size=\"40\"/>";
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


function inserisci_zona($nome_zona=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$nome_zona= sistemaTesto($nome_zona);
	$q="INSERT INTO zona (id_zona, nome) VALUES (null,'$nome_zona')";
	$r=$db->query($q);
	$id_zona=mysql_insert_id();
	return $id_zona;
}


/**
 * Inserisci una citta nel db e ritorna il suo id
 *
 * @param unknown_type $nome_citta
 * @return id_citta $id_citta
 */
function inserisci_citta($nome_citta=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$nome_citta= sistemaTesto($nome_citta);
	$q="INSERT INTO citta (id_citta, nome) VALUES (null,'$nome_citta')";
	$r=$db->queryInsert($q);
	$id_citta=mysql_insert_id();
	return $id_citta;
}

/**
 * Inserisci una tipo_immobile nel db e ritorna il suo id
 *
 * @param unknown_type $nome_tipo_immobile
 * @return id_tipo_immobile $id_tipo_immobile
 */
function inserisci_tipo_immobile($nome_immobile=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$nome_immobile= sistemaTesto($nome_immobile);
	$q="INSERT INTO tipo_immobile (id_tipo_immobile, nome) VALUES (null,'$nome_immobile')";
	$r=$db->query($q);
	$id=mysql_insert_id();
	return $id;
}

/**
 * Inserisci una provincia nel db e ritorna il suo id
 *
 * @param unknown_type $nome_provincia
 * @return id_provincia $id_provincia
 */
function inserisci_provincia($nome_provincia=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$nome_provincia=  sistemaTesto($nome_provincia);
	$q="INSERT INTO provincia (id_provincia, nome) VALUES (null,'$nome_provincia')";
	$r=$db->query($q);
	$id=mysql_insert_id();
	return $id;
}

/**
 * Inserisci un comune nel db e ritorna il suo id
 *
 * @param unknown_type $nome_comune
 * @return id_comune $id_comune
 */
function inserisci_comune($nome_comune=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$nome_comune= sistemaTesto($nome_comune);
	$q="INSERT INTO comune (id_comune, nome) VALUES (null,'$nome_comune')";
	$r=$db->query($q);
	$id=mysql_insert_id();
	return $id;
}


/**
 * ritorna il nome di un tipo di locazione
 *
 * @param unknown_type $id_tipo_locazione
 * @return come del tipo locazione
 */
function tipo_locazione($id_tipo_locazione=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_tipo_locazione=="all") {
		return "Tutti gli Immobili";
	}
	$q="select * from tipo_locazione where id_tipo_locazione = $id_tipo_locazione";
	$r=$db->query($q);
	if (!$r) {
		return "Dato Assente";
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['nome'];
	}
}



function lista_immobili($id_tipo_locazione=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";

	if ($id_tipo_locazione=="all") {
		$q="select * from immobile where archiviato=0 ORDER BY id_imm DESC";
	}else {
		$q="select * from immobile where id_tipo_locazione = $id_tipo_locazione and archiviato=0 ORDER BY id_imm DESC";
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
		$str.="Num Richieste";
		$str.="</TD>";
		 $str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		if ($id_tipo_locazione=="all"){
			$str.="<td>";
			$str.="Tipo di Locazione";
			$str.="</td>";
		}
	$str.="<td>";
			$str.="Tipologia";
			$str.="</td>";
		$str.="<td>";
			$str.="Proprietario";
			$str.="</td>";
		$str.="</TR>";
	
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.='<a class="fancybox fancybox.ajax" href="immobile_popup_detail.php?id_imm='.$ro['id_imm'].'">';
			
			$str.= $ro['id_imm']."\n</TD>\n";
			$str.='</a>';
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_stampa($ro['id_imm']);
			$str.=" -- ";
			$str.= prezzo_stampa($ro['id_imm']);
			$str.="\n</TD\n>";
			$str.="<td>";
                        $str.=lista_ricerca_richieste_immobile($ro['id_imm'],false,true);
                        
                        $str.="</td>";
			$str.= "<TD class=\"clienti\">\n";
			
			$str.= opzioni_immobile($ro['id_tipo_locazione'],$ro['id_imm'])."\n</TD>\n";
			if ($id_tipo_locazione=="all"){
				$str.= "<TD >\n";
				$str.= tipo_locazione($ro['id_tipo_locazione']);
				$str.="</td>";
			}
		    $str.= "<TD class=\"clienti\">\n";

		    $str.= tipo_immobile($ro['id_tipo_immobile']);

		     $str.= "</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$id_cli=id_imm_to_id_cli($ro['id_imm']);
if($id_cli!=""){
$str.= nominativo_stampa($id_cli);
}else{
$str.="";
}
	//    

		     $str.= "</TD>\n";
		      $str.= "</TR>\n\n\n";
		}
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

function lista_immobili_archiviati($id_tipo_locazione=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";

	if ($id_tipo_locazione=="all") {
		$q="select * from immobile WHERE archiviato=1 ORDER BY id_imm DESC";
	}else {
		$q="select * from immobile where id_tipo_locazione = $id_tipo_locazione and archiviato=1 ORDER BY id_imm DESC";
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
	$str.="<td>";
			$str.="Tipologia";
			$str.="</td>";
		$str.="<td>";
			$str.="Proprietario";
			$str.="</td>";
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
			
			$str.= opzioni_immobile($ro['id_tipo_locazione'],$ro['id_imm'])."\n</TD>\n";
			if ($id_tipo_locazione=="all"){
				$str.= "<TD >\n";
				$str.= tipo_locazione($ro['id_tipo_locazione']);
				$str.="</td>";
			}
		    $str.= "<TD class=\"clienti\">\n";

		    $str.= tipo_immobile($ro['id_tipo_immobile']);

		     $str.= "</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$id_cli=id_imm_to_id_cli($ro['id_imm']);
if($id_cli!=""){
$str.= nominativo_stampa($id_cli);
}else{
$str.="";
}
	//    

		     $str.= "</TD>\n";
		      $str.= "</TR>\n\n\n";
		}
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


function lista_immobili_venduti($id_tipo_locazione=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";

	if ($id_tipo_locazione=="all") {
		$q="select * from immobile WHERE archiviato=2 ORDER BY id_imm DESC";
	}else {
		$q="select * from immobile where id_tipo_locazione = $id_tipo_locazione and archiviato=2 ORDER BY id_imm DESC";
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
	$str.="<td>";
			$str.="Tipologia";
			$str.="</td>";
		$str.="<td>";
			$str.="Proprietario";
			$str.="</td>";
                $str.="<td>";
			$str.="Acquirente";
			$str.="</td>";
                        $str.="<td>";
			$str.="prezzo";
			$str.="</td>";
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
			
			$str.= opzioni_immobile($ro['id_tipo_locazione'],$ro['id_imm'])."\n</TD>\n";
			if ($id_tipo_locazione=="all"){
				$str.= "<TD >\n";
				$str.= tipo_locazione($ro['id_tipo_locazione']);
				$str.="</td>";
			}
		    $str.= "<TD class=\"clienti\">\n";

		    $str.= tipo_immobile($ro['id_tipo_immobile']);

		     $str.= "</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$id_cli=id_imm_to_id_cli($ro['id_imm']);
if($id_cli!=""){
$str.= nominativo_stampa($id_cli);
}else{
$str.="";
}
	//    

		     $str.= "</TD>\n";
                     $str.= "<TD class=\"clienti\">\n";
			$id_cli=id_acquirente($ro['id_imm']);
if($id_cli!=""){
$str.= nominativo_stampa($id_cli);
}else{
$str.="";
}
	//    

		     $str.= "</TD>\n";
                       $str.= "<TD class=\"clienti\">\n";
                    $str.=stampa_prezzo(immobile_venduto_prezzo($ro['id_imm']))  ;

	//    

		     $str.= "</TD>\n";
		      $str.= "</TR>\n\n\n";
		}
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




/**
 * Stampa la tabella contentente i dati del cliente passato tramite id_cli
 *
 * @param IDimmobile $id_imm
 * @param Tipo di azione $azione
 */
function immobile_form($azione="", $id_imm="",$id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if ($azione=="mod") {
		
		$q_mod="SELECT * FROM immobile WHERE immobile.id_imm = $id_imm";
		$r_mod=$db->query($q_mod);

		$ro_mod=mysql_fetch_array($r_mod);
	}	

	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"POST\" action=\"immobile_save.php\">\n";
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_imm\" value=\"";
		$str.= $id_imm;
		$str.= "\">\n";
	}	
	$str.= "<TABLE id=\"clienti\">\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Associa a Cliente\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	
	if ($id_cli!="") {
		$str.= nominativo_stampa($id_cli);
		$str.="<input type=\"hidden\" name=\"id_cli\" value=\"";
		$str.= $id_cli;
		$str.= "\">\n";
	}
	else {
		$str.="<select size=\"1\" name=\"id_cli\">\n";
		$str.="<option value=\"\">Scegli</option>\n";
		$q_tipi="SELECT * FROM tipo_cliente";
		$r_tipi=$db->query($q_tipi);
		$i=1;
		while ($ro_tipi=mysql_fetch_array($r_tipi)) {
			
			$str.="<optgroup class=\"opt$i\" label=\"";
			$str.=$ro_tipi['nome'];
			$str.="\">";
			$i++;
			$q = "SELECT * FROM cliente WHERE id_tipo_cliente=$ro_tipi[id_tipo_cliente] order by nominativo asc";	
		
			$r = $db->query($q);
			if ($r) {
				
			
				while($ro = mysql_fetch_array($r)){
					if ($azione=="mod" AND $ro['id_cli']==$ro_mod['id_cli']) { // restituisce un warning se non � associato a nessun cliente
						$sel="Selected";
					}
					else {
						$sel=" ";
					}
				$str.="<option $sel value=\"";
				$str.= $ro['id_cli'];
				$str.="\">";
				$str.= $ro['nominativo'];
				$str.="</option>\n";
				}	
			}
		$str.="</optgroup>";	
		}
		
		$str.="</select>\n";
	}
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Locazione\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
	$q = "SELECT * FROM tipo_locazione order by nome asc";	
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
	$str.= "<input class=\"readonly\" type=\"text\" name=\"id_imm\" readonly value=\"";
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

	$q = "SELECT * FROM tipo_immobile order by nome asc";	
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
	$q = "SELECT * FROM provincia order by nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod"  AND $ro['id_provincia']==$ro_mod['id_provincia']) {
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
	$q = "SELECT * FROM citta order by nome asc";	
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
	$q = "SELECT * FROM zona order by nome asc";	
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
	$str.= "<TR>\n";
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
	$str.= "</TR>\n";
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
	$str.= "Mq Comm\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_comm\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['mq_comm'];
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
		$str.= $ro_mod['prezzo'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
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
	$str.= "</TR>";
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Classe Energetica\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"classe_en\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['classe_en'];
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
		$str.= $ro_mod['spese_cond'];
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Num Vani\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"vani\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['vani'];
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Ascensore\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_ascensore\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM ascensore";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_ascensore']==$ro_mod['id_ascensore']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_ascensore'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Chiavi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_chiavi\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM chiavi";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id_chiavi']==$ro_mod['id_chiavi']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id_chiavi'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Anno Costruzione\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"anno_costruzione\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['anno_costruzione'];
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Al piano\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"al_piano\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['al_piano'];
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Posto Auto\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
        
        $str.="<input type=\"checkbox\" name=\"posto_auto\" value=\"1\" ";
	
	if ($azione=="mod" && $ro_mod['posto_auto']==1) {
		$str.="checked";
	}
        $str.=" >\n";
	
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Esclusiva\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
        
        $str.="<input type=\"checkbox\" name=\"esclusiva\" value=\"1\" ";
	
	if ($azione=="mod" && $ro_mod['esclusiva']==1) {
		$str.="checked";
	}
        $str.=" >\n";
	
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
	 $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Durata Esclusiva\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"esclusiva_durata\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['esclusiva_durata'];
	}	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Note";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<textarea rows=\"10\" cols=\"80\"  name=\"note\">";
	if ($azione=="mod") {
		$str.= $ro_mod['note'];
	}	
	$str.="</textarea>";
	$str.= "</TD>";
	$str.= "</TR>";
        $str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Note PUBBLICHE";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<textarea rows=\"10\" cols=\"80\"  name=\"note_sito\">";
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


/**
 * Crea un id unico per l'immobile
 *
 */
function crea_id_imm(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_crea_id_imm = "SELECT * FROM ultimo_id_imm LIMIT 1";
	$r_crea_id_imm = $db->query($q_crea_id_imm);
	$ro_crea_id_imm = mysql_fetch_array($r_crea_id_imm);
	$id_imm = $ro_crea_id_imm['id_imm'];
	$q_agg="update ultimo_id_imm set id_imm = id_imm+1";
	$r_agg=$db->query($q_agg);
	
	return $id_imm;
}


/**
 * Crea un id unico per la richiesta
 *
 */
function crea_id_ric(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_crea_id_imm = "SELECT * FROM ultimo_id_ric LIMIT 1";
	$r_crea_id_imm = $db->query($q_crea_id_imm);
	$ro_crea_id_imm = mysql_fetch_array($r_crea_id_imm);
	$id_ric = $ro_crea_id_imm['id_ric'];
	$q_agg="update ultimo_id_ric set id_ric = id_ric+1";
	$r_agg=$db->query($q_agg);
	
	return $id_ric;
}



function mq_stampa($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_mq= "SELECT mq FROM immobile WHERE id_imm = $id_imm";
	$r_mq=$db->query($q_mq);
	$ro_mq=mysql_fetch_array($r_mq);
if($ro_mq['mq']==null){
		return "Assente";
	}
	else {
		return $ro_mq['mq'] . " mq";
	}
}

function mq_comm_stampa($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_mq= "SELECT mq_comm FROM immobile WHERE id_imm = $id_imm";
	$r_mq=$db->query($q_mq);
	$ro_mq=mysql_fetch_array($r_mq);
if($ro_mq['mq_comm']==null){
		return "Assente";
	}
	else {
		return $ro_mq['mq_comm'] . " mq";
	}
}

function prezzo_stampa($id_imm=""){
$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_prezzo= "SELECT prezzo FROM immobile WHERE id_imm = $id_imm";
	$r_prezzo=$db->query($q_prezzo);
	$ro_prezzo=mysql_fetch_array($r_prezzo);
if($ro_prezzo['prezzo']==null){
		return "Assente";
	}
	else {
		return stampa_prezzo($ro_prezzo	['prezzo']);
	}
}


function stampa_prezzo($prezzo=""){
	return number_format($prezzo,2,",",".");
}



/**
 * La funzione ha il compito di visualizzare le opzioni disponibili per l'immobile
 *
 * @param id del tipo di cliente $id_tipo_cliente
 */
function opzioni_immobile($id_tipo_locazione="", $id_imm=""){
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


function opzioni_nota($id_nota=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$visualizza ="<a href=\"nota_show.php?id_nota=".$id_nota."\"><img src=\"images/immobile_dati.gif\" title=\"Visualizza la nota\"/></a> ";
	$cancella =' <a onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'no\');return false;"  href="nota_del.php?id_nota='.$id_nota.'"><img src="images/cancella.gif" title="Cencella la nota"/></a>';
	$str="";

	$str.=$visualizza;
	$str.=$cancella;
	
	return $str;
}

/**
 * Stampa la tabella contentente i dati dell'immobile passato tramite id_imm
 *
 * @param ID immobile $id_imm
 */
function scheda_immobile($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if (isset($id_imm)) {
		$q="SELECT * FROM immobile WHERE  id_imm=$id_imm";
		$r=$db->query($q);
		$ro=mysql_fetch_array($r);
			
		
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
		$str.="Scheda dell'immobile Rif.Imm. $id_imm";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Rif.Imm\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.="<a href=\"immobile_show.php?id_imm=";
		$str.= $id_imm;
		$str.="\">";
		$str.= $id_imm;
		$str.="</a>";
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Tipo Locazione\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= tipo_locazione($ro['id_tipo_locazione']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Tipo Immobile\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= tipo_immobile($ro['id_tipo_immobile']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Provincia\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= provincia_stampa($ro['id_provincia']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Citt&agrave;\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= citta_stampa($ro['id_comune']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Zona\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= zona_stampa($ro['id_zona']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Via\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= $ro['via'];
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Mq";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= mq_stampa($ro['id_imm']);
		$str.= "</TD>";
		$str.= "</TR>";
                $str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Mq Comm";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= mq_comm_stampa($ro['id_imm']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Prezzo";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= stampa_prezzo($ro['prezzo']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Garage";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= garage_stampa($ro['id_garage']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero Piani";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['num_piani'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero Camere";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['num_camere'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero Bagni";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['num_bagni'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Stato";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= stato_stampa($ro['id_stato']);
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Classe Energetica";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['classe_en'];
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Spese Condominiali";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['spese_cond'];
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero vani";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['vani'];
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Ascensore";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= ascensore_stampa($ro['id_ascensore']);
		$str.= "</TD>";
		$str.= "</TR>";
                
                $str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Chiavi";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= chiavi_stampa($ro['id_chiavi']);
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Anno Costruzione:";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['anno_costruzione'];
		$str.= "</TD>";
		$str.= "</TR>";
                
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Al Piano:  ";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['al_piano'];
		$str.= "</TD>";
		$str.= "</TR>";
                $str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "In Esclusiva:  ";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
                if($ro['esclusiva']==1){
                    $str.='SI';
                }else{
                    $str.='NO';
                }
		
		$str.= "</TD>";
		$str.= "</TR>";
                
                $str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Esclusiva Durata:  ";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['esclusiva_durata'];
		$str.= "</TD>";
		$str.= "</TR>";
                $str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Posto Auto:  ";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
                if($ro['posto_auto']==1){
                    $str.='SI';
                }else{
                    $str.='NO';
                }
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Note";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['note'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Note PUBBLICHE";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['note_sito'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Inserito Da";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= idUtenteToNome($ro['id_utente_ins']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Inserito IL";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= stampa_data($ro['data_ins']);
		$str.= "</TD>";
		$str.= "</TR>";
			$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Archiviato";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
                switch ($ro['archiviato']){
                    case 1:
                        $str.="Archiviato";
                        break;
                    case 2:
                        $str.="Venduto";
                        break;
                    
                    default:
                        $str.="no";
                    
                }/*
		if($ro['archiviato']==1){
    $str.='si';
    }else{
    $str.='no';
    }*/
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	else {
		$str.="Nessun Immobile selezionato";
	}
	return $str;
}
function immArchiviato($id_imm){
     $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

	$q_tipo_imm="SELECT archiviato FROM immobile WHERE id_imm=$id_imm";
	$r_tipo_imm = $db->query($q_tipo_imm);
	
		$ro_tipo_imm=mysql_fetch_array($r_tipo_imm);
		return $ro_tipo_imm['archiviato'];
	     


}

function immVenduto($id_imm){
     $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

	$q_tipo_imm="SELECT archiviato FROM immobile WHERE id_imm=$id_imm";
	$r_tipo_imm = $db->query($q_tipo_imm);
	
		$ro_tipo_imm=mysql_fetch_array($r_tipo_imm);
		return $ro_tipo_imm['archiviato'];
	     


}
function tipo_immobile($id_tipo_immobile=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_tipo_immobile==null) {
		return "Dato Assente";		
	}
	$q_tipo_imm="SELECT * FROM tipo_immobile WHERE id_tipo_immobile = $id_tipo_immobile";
	$r_tipo_imm = $db->query($q_tipo_imm);
	if (!$r_tipo_imm) {
		return "Dato Assente";
	}else{
		$ro_tipo_imm=mysql_fetch_array($r_tipo_imm);
		return $ro_tipo_imm['nome'];
	}
	
}


function provincia_stampa($id_provincia=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_provincia==null) {
		return "Dato Assente";		
	}
	$q_prov="SELECT * FROM provincia WHERE id_provincia = $id_provincia";
	$r_prov=$db->query($q_prov);
	if (!$r_prov) {
		return "Dato Assente";
	}else{
		$ro_prov=mysql_fetch_array($r_prov);
		return $ro_prov['nome'];
	}
}

function garage_stampa($id_garage=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_garage==null) {
		return "Dato Assente";		
	}
	$q_garage="SELECT * FROM garage WHERE id_garage=$id_garage";
	$r_garage=$db->query($q_garage);
	if (!$r_garage) {
		return "Dato Assente";
	}else{
		$ro_garage=mysql_fetch_array($r_garage);
		return $ro_garage['nome'];
	}
}

function chiavi_stampa($id_chiavi=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_chiavi==null) {
		return "Dato Assente";		
	}
	$q_chiavi="SELECT * FROM chiavi WHERE id_chiavi=$id_chiavi";
	$r_chiavi=$db->query($q_chiavi);
	if (!$r_chiavi) {
		return "Dato Assente";
	}else{
		$ro_chiavi=mysql_fetch_array($r_chiavi);
		return $ro_chiavi['nome'];
	}
}


function ascensore_stampa($id_ascensore=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_ascensore==null) {
		return "Dato Assente";		
	}
	$q_ascensore="SELECT * FROM ascensore WHERE id_ascensore=$id_ascensore";
	$r_ascensore=$db->query($q_ascensore);
	if (!$r_ascensore) {
		return "Dato Assente";
	}else{
		$ro_ascensore=mysql_fetch_array($r_ascensore);
		return $ro_ascensore['nome'];
	}
}


function tipo_richiesta_stampa($id_tipo_richiesta=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_tipo_richiesta==null) {
		return "Dato Assente";		
	}
	$q_tipo_richiesta="SELECT * FROM tipo_richiesta WHERE id=$id_tipo_richiesta";
	$r_tipo_richiesta=$db->query($q_tipo_richiesta);
	if (!$r_tipo_richiesta) {
		return "Dato Assente";
	}else{
		$ro_tipo_richiesta=mysql_fetch_array($r_tipo_richiesta);
		return $ro_tipo_richiesta['tipo_richiesta'];
	}
}

function stato_stampa($id_stato=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_stato==null) {
		return "Dato Assente";		
	}
	$q_stato="SELECT * FROM stato WHERE id_stato =$id_stato";
	$r_stato=$db->query($q_stato);
	if (!$r_stato) {
		return "Dato Assente";
	}else{
		$ro_stato=mysql_fetch_array($r_stato);
		return $ro_stato['nome'];
	}
}




/**
 * Stampa il form per modificare/inserire le immagini
 *
 * @param $azione
 * @param $id_imm
 * @param $id_img
 */
function immagine_form($azione="",$id_imm="",$id_img){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	
	if ($azione=="mod") {
		
		$q_mod="SELECT * FROM imm_img JOIN immagine ON imm_img.id_img=immagine.id_img WHERE immagine.id_img=$id_img";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form name=\"mainForm\" method=\"POST\" action=\"immagine_save.php\" enctype=\"multipart/form-data\">\n";
	$str.="<input type=\"hidden\" name=\"id_imm\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['id_imm'];
	}else {
		$str.= $id_imm;
	}
	
	$str.= "\">\n";
	
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_img\" value=\"";
		$str.= $ro_mod['id_img'];
		$str.= "\">\n";
	}
	
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	if ($azione=="mod") {
		/**
		 * mostro l'immagine nel db
		 */
		$str.= "<TABLE id=\"clienti\">\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Immagine da sostituire:\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= immagine_stampa_low($ro_mod['id_img']);
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.="</table>";
		
	}
	$str.= "<TABLE id=\"clienti\">\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Rif.Imm\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	if ($azione=="mod") {
		$str.=  "<b>". $ro_mod['id_imm']."</b>";
	}else {
		$str.= " <b>". $id_imm."</b>";
	}
	
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Seleziona la foto\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input name=\"file\" type=\"file\">\n";
	$str.= "<a href=\"javascript: PreviewImage(0);\">Visualizza Anteprima</a></TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Anteprima \n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<img align=\"center\" src=\"images/no_img_sel.jpg\" name=\"img1\" width=\"350px\" height=\"250px\">\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
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



function crea_id_img(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_id_img="SELECT ultimo_id_img FROM ultimo_id_img ORDER BY ultimo_id_img DESC LIMIT 1";
	$r_id_img=$db->query($q_id_img);
	$ro_id_img=mysql_fetch_array($r_id_img);
	$id_img = $ro_id_img['ultimo_id_img'];
	$q_agg_id = "UPDATE ultimo_id_img SET ultimo_id_img = ultimo_id_img+1";
	$r_agg_id=$db->query($q_agg_id);
	
	return $id_img;
	
}



function box_img_immobile($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q_foto="SELECT * FROM imm_img JOIN immagine on immagine.id_img=imm_img.id_img WHERE imm_img.id_imm =$id_imm order by ordine ASC";
	$r_foto=$db->query($q_foto);
	
	if (!$r_foto) {
		$str.="<center>Nessuna foto disponibile per l'immobile</center>";
	}else {
		
			$str.= "<div class=\"clienti\">\n";
			$str.= "<TABLE id=\"clienti\">\n";
			$str.="<tr>\n";
			$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
			$str.="Immagini dell'immobile Rif.Imm. $id_imm";
			$str.="</td>\n";
			$str.="</tr>\n";
			 
			while ($ro_foto=mysql_fetch_array($r_foto)) {
				$str.= "<TR>\n";
			 	for ($i=0;$i<3; $i++){
				
					
					$str.= "<TD class=\"foto_box\">\n";
					$str.= immagine_stampa_low($ro_foto['id_img']);
					$str.= "</TD>\n";
					$ro_foto=mysql_fetch_array($r_foto);
					$i++;
					$str.= "<TD class=\"foto_box\">\n";
					$str.= immagine_stampa_low($ro_foto['id_img']);
					$str.= "</TD>\n";
					$ro_foto=mysql_fetch_array($r_foto);
					$i++;
					$str.= "<TD class=\"foto_box\">\n";
					$str.= immagine_stampa_low($ro_foto['id_img']);
					$str.= "</TD>\n";
					
					
					
				}
				$str.= "</TR>";
			}
			
			
			
			$str.= "</TABLE>";

			$str.="</div>";
	
		
	}///fine else
	return $str;

	
}



function immagine_stampa_high($id_img=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_img=="") {
		return "";
	}else {
		$q_img="SELECT high_res FROM immagine WHERE id_img=$id_img";
		$r_img=$db->query($q_img);
		if (!$r_img) {
			return "";
		}
		else {
			$ro_img=mysql_fetch_array($r_img);
			$img="<img src=\"".$ro_img['high_res']."\"/>";
			return $img;
		}	
	}
	
}
function immagine_stampa_med($id_img=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_img=="") {
		return "";
	}else {
		$q_img="SELECT med_res FROM immagine WHERE id_img=$id_img";
		$r_img=$db->query($q_img);
		if (!$r_img) {
			return "";
		}
		else {
			$ro_img=mysql_fetch_array($r_img);
			$img="<img src=\"".$ro_img['med_res']."\"/>";
			return $img;
		}
	}
	
}

/**
 * usata solo pe il box img
 *
 * @param unknown_type $id_img
 * @return unknown
 */

function immagine_stampa_low($id_img=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_img=="") {
		return "";
	}else {
		$q_img="SELECT low_res, med_res FROM immagine WHERE id_img=$id_img";
		$r_img=$db->query($q_img);
		if (!$r_img) {
			return "";
		}
		else {
			$ro_img=mysql_fetch_array($r_img);
			$img="<img width=\"176px\"  src=\"".$ro_img['low_res']."\"/>";
			$a='<a href="';
      $a.=$ro_img['med_res'];
      $a.='"';
      $a.= 'rel="lightbox">';
			$img = $a . $img . "</a>";
			return $img;
		}
	}
	
}





/**
 * Stampa la tabella contentente le foto e le opzioni disponibili
 *
 * @param ID imm $id_imm
 */
function immagini_gest($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q_foto="SELECT * FROM imm_img JOIN immagine on immagine.id_img=imm_img.id_img WHERE imm_img.id_imm =$id_imm";
	$r_foto=$db->query($q_foto);
	
	if (!$r_foto) {
		$str.="<center>Nessuna foto disponibile per l'immobile</center><br>";
		$str.="<b><a href=\"immobile_show.php?id_imm=$id_imm\"><img src=\"images/freccia.gif\"/>Torna all'immobile</a></b>";
	}else {
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Immagini dell'immobile $id_imm";
		$str.="</td>\n";
		$str.="</tr>\n";
		
		while ($ro_foto=mysql_fetch_array($r_foto)) {
			$str.= "<TR>\n";
			$str.= "<TD class=\"foto_gest_header\">\n";
			$str.= immagine_stampa_low($ro_foto['id_img']);
			$str.= "</TD>\n";
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.="<a href=\"immagine_add.php?azione=mod&id_img=";
			$str.= $ro_foto['id_img'];
			$str.="\">";
			$str.= "Modifica";
			$str.="</a>";
			$str.="<br><br>";
			$str.="<a href=\"immagine_del.php?id_imm=$id_imm&id_img=";
			$str.= $ro_foto['id_img'];
			$str.="\" onclick=\"NewWindow(this.href,'pg_center','500','350','no');return false;\">";
			$str.="Cancella";
			$str.="</a>";
			$str.= "</TD>\n";
	
			$str.= "</TR>\n";
		}
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	
	return $str;
}

function immagini_get($id_imm=""){
   // $query = mysqli_query($this->connect,"SELECT * FROM `images` ORDER BY `order` ASC") or die(mysql_error());
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$q_foto="SELECT immagine.* FROM imm_img JOIN immagine on immagine.id_img=imm_img.id_img WHERE imm_img.id_imm =$id_imm ORDER BY `ordine` ASC";
        
	$r_foto=$db->query($q_foto);
        while($row_foto = mysql_fetch_assoc($r_foto))
        {
            $rows_foto[] = $row_foto;
        }
       
        return $rows_foto;

    
}


/**
 * La funzione ritorna l'id del cliente associato all'id_imm
 *
 * @param ID immobile $id_imm
 */
function id_imm_to_id_cli($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

	$q="SELECT * FROM cli_imm WHERE id_imm=$id_imm";
	$r=$db->query($q);
        if($r){
            $ro=mysql_fetch_array($r);
	return $ro['id_cli'];
        }
}
function id_acquirente($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

	$q="SELECT * FROM immobile_vendita WHERE id_imm=$id_imm";
	$r=$db->query($q);
        if($r){
            $ro=mysql_fetch_array($r);
	return $ro['id_cli'];
        }
}

function immobile_venduto_prezzo($id_imm){
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

	$q="SELECT * FROM immobile_vendita WHERE id_imm=$id_imm";
	$r=$db->query($q);
        if($r){
            $ro=mysql_fetch_array($r);
	return $ro['prezzo'];
        }
    
}
function id_ric_to_id_cli($id_ric=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT * FROM cli_ric WHERE id_ric=$id_ric";
	$r=$db->query($q);
	$ro=mysql_fetch_array($r);
	return $ro['id_cli'];
}

function id_cli_to_id_citta($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT * FROM cliente WHERE id_cli=$id_cli";
	$r=$db->query($q);
	$ro=mysql_fetch_array($r);
	return $ro['id_citta'];
	
	
}
function id_cli_to_email($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT * FROM cliente WHERE id_cli=$id_cli";
	$r=$db->query($q);
	$ro=mysql_fetch_array($r);
	return $ro['email'];
	
	
}


/**
 * Stampa il form per modificare/inserire le immagini
 *
 * @param $azione
 * @param $id_imm
 * @param $id_doc
 */
function documento_form($azione="",$id_imm="",$id_doc){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	
	if ($azione=="mod") {
		
		$q_mod="SELECT * FROM imm_doc JOIN documento ON imm_doc.id_doc=documento.id_doc WHERE documento.id_doc = $id_doc";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form name=\"mainForm\" method=\"POST\" action=\"documento_save.php\" enctype=\"multipart/form-data\">\n";
	$str.="<input type=\"hidden\" name=\"id_imm\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['id_imm'];
	}else {
		$str.= $id_imm;
	}
	
	$str.= "\">\n";
	
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_doc\" value=\"";
		$str.= $ro_mod['id_doc'];
		$str.= "\">\n";
	}
	
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	$str.= "<TABLE id=\"clienti\">\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Rif.Imm\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	if ($azione=="mod") {
		$str.=  "<b>". $ro_mod['id_imm']."</b>";
	}else {
		$str.= " <b>". $id_imm."</b>";
	}
	
	$str.= "</TD>";
	$str.= "</TR>";
	if ($azione=="mod"){
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Note Documento\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		
		$str.=   $ro_mod['note'];
		
		$str.= "</TD>";
		$str.= "</TR>";
	}
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Seleziona Il documento\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input name=\"file\" type=\"file\">\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Note Documento\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<textarea cols=\"50\" rows=\"10\" name=\"note\">\n";
	if ($azione=="mod") {
		$str.=$ro_mod['note'];
	}
	$str.="</textarea>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
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



function crea_id_doc(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q_id_doc="SELECT ultimo_id_doc FROM ultimo_id_doc ORDER BY ultimo_id_doc DESC LIMIT 1";
	$r_id_doc=$db->query($q_id_doc);
	$ro_id_doc=mysql_fetch_array($r_id_doc);
	$id_doc = $ro_id_doc['ultimo_id_doc'];
	$q_agg_id = "UPDATE ultimo_id_doc SET ultimo_id_doc = ultimo_id_doc+1";
	$r_agg_id=$db->queryInsert($q_agg_id);
	
	return $id_doc;
	
}




/**
 * Stampa la tabella contentente i documenti e le opzioni disponibili
 *
 * @param ID imm $id_imm
 */
function documenti_gest($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q_doc="SELECT * FROM imm_doc JOIN documento on documento.id_doc=imm_doc.id_doc WHERE imm_doc.id_imm =$id_imm";
	$r_doc=$db->query($q_doc);
	
	if (!$r_doc) {
		$str.="<center>Nessun documento disponibile disponibile per l'immobile</center><br>";
		$str.="<b><a href=\"immobile_show.php?id_imm=$id_imm\"><img src=\"images/freccia.gif\"/>Torna all'immobile</a></b>";
	}else {
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Documenti dell'immobile $id_imm";
		$str.="</td>\n";
		$str.="</tr>\n";
		
		while ($ro_doc=mysql_fetch_array($r_doc)) {
			$str.= "<TR>\n";
			$str.= "<TD class=\"foto_gest_header\">\n";
			$str.= $ro_doc['nome_file'] .": ".$ro_doc['note'];
			$str.= "</TD>\n";
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.="<a target=\"_black\" href=\"".$ro_doc['path']."";
			$str.="\">";
			$str.= "Visualizza";
			$str.="</a>";
			$str.="<br><br>";
			$str.="<a href=\"documento_add.php?azione=mod&id_doc=";
			$str.= $ro_doc['id_doc'];
			$str.="\">";
			$str.= "Modifica";
			$str.="</a>";
			$str.="<br><br>";
			$str.="<a href=\"documento_del.php?id_imm=$id_imm&id_doc=";
			$str.= $ro_doc['id_doc'];
			$str.="\" onclick=\"NewWindow(this.href,'pg_center','500','350','no');return false;\">";
			$str.="Cancella";
			$str.="</a>";
			$str.= "</TD>\n";
	
			$str.= "</TR>\n";
		}
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	
	return $str;
}




function box_doc_immobile($id_imm=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q_doc="SELECT * FROM imm_doc JOIN documento on documento.id_doc=imm_doc.id_doc WHERE imm_doc.id_imm =$id_imm";
	$r_doc=$db->query($q_doc);
	
	if (!$r_doc) {
		$str.="<center>Nessun documento disponibile per l'immobile</center>";
	}else {
		
			$str.= "<div class=\"clienti\">\n";
			$str.= "<TABLE id=\"clienti\">\n";
			$str.="<tr>\n";
			$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
			$str.="Documenti dell'immobile Rif.Imm. $id_imm";
			$str.="</td>\n";
			$str.="</tr>\n";
			 
			while ($ro_doc=mysql_fetch_array($r_doc)) {
				$str.= "<TR>\n";
			 	for ($i=0;$i<3; $i++){
				
					
					$str.= "<TD class=\"doc_box\">\n";
					$str.=  documento_stampa($ro_doc['id_doc']);
					$str.= "</TD>\n";
					$ro_doc=mysql_fetch_array($r_doc);
					$i++;
					$str.= "<TD class=\"doc_box\">\n";
					$str.= documento_stampa($ro_doc['id_doc']);
					$str.= "</TD>\n";
					$ro_doc=mysql_fetch_array($r_doc);
					$i++;
					$str.= "<TD class=\"doc_box\">\n";
					$str.= documento_stampa($ro_doc['id_doc']);
					$str.= "</TD>\n";
					
					
					
				}
				$str.= "</TR>";
			}
			
			
			
			$str.= "</TABLE>";

			$str.="</div>";
	
		
	}///fine else
	return $str;

	
}

function documento_stampa($id_doc=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if ($id_doc=="") {
		return "";
	}else{
		$q_stampa_doc="SELECT * FROM documento WHERE  id_doc = $id_doc";
		$r_stampa_doc=$db->query($q_stampa_doc);
		if (!$r_stampa_doc) {
			return "";
		}else{
			$ro_stampa_doc=mysql_fetch_array($r_stampa_doc);
			$str.="<a target=\"_black\" href=\"";
			$str.= $ro_stampa_doc['path'];
			$str.="\">";
			$str.="<img src=\"images/doc_apri.gif\" class=\"img_doc\">";
			$str.= $ro_stampa_doc['nome_file'] .": ".$ro_stampa_doc['note'];
			$str.= "</a>";
			
			
			return $str;
		}
	}
}



function remove_dir($dir){
	
	if($handle= opendir("$dir")){
		while (false!==($item=readdir($handle))) {
			if ($item!= "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					remove_dir("$dir/$item");
				}else {
					unlink("$dir/$item");
					
				}
			}
		}
		closedir($handle);
		
	}
}



function lista_immobili_cliente($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$str="";
	
	$q="SELECT * FROM cli_imm JOIN immobile ON immobile.id_imm=cli_imm.id_imm WHERE id_cli=$id_cli";
	
	
	$r=$db->query($q);
	if (!$r) {
  		
		
		$str.="<tr><td  colspan=\"4\"><center>Nessun Immobile associato al cliente presente</center></td></tr>";
	}	
	
	if ($r) {
		
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"lista_richieste_index\">";
		
	    $str.="<THEAD  class=\"thead\">";
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
		
		$str.="<td>";
		$str.="Tipo di Locazione";
		$str.="</td>";
	
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
			
			$str.= opzioni_immobile($ro['id_tipo_locazione'],$ro['id_imm'])."\n</TD>\n";
		
			$str.= "<TD class=\"clienti\">\n";
			$str.= tipo_locazione($ro['id_tipo_locazione']);
			$str.="</td>";
		
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('lista_immobili_cliente','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('lista_immobili_cliente',Array('S','S','S','S'));";
		$str.="</script>";
	}
	
	return $str;
	
}


/**

 *
 */
function richiesta_form($azione="", $id_cli="", $id_ric=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if ($azione=="mod") {
		$q_mod="SELECT * FROM richiesta JOIN cli_ric ON cli_ric.id_ric = richiesta.id_ric WHERE richiesta.id_ric= $id_ric";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	

	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"POST\" action=\"richiesta_save.php\">\n";
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_ric\" value=\"";
		$str.= $id_ric;
		$str.= "\">\n";
	}	
	
	$str.= "<TABLE id=\"clienti\">\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Associa a Cliente\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	if ($id_cli!="") {
		
		$str.= nominativo_stampa($id_cli);
		$str.="<input type=\"hidden\" name=\"id_cli\" value=\"";
		$str.= $id_cli;
		$str.= "\">\n";
	}
	else {
	
		$str.="<select size=\"1\" name=\"id_cli\">\n";
		$str.="<option value=\"\">Scegli</option>\n";
		$q_tipi="SELECT * FROM tipo_cliente";
		$r_tipi=$db->query($q_tipi);
		$i=1;
			
		while ($ro_tipi=mysql_fetch_array($r_tipi)) {
			
			$str.="<optgroup class=\"opt$i\" label=\"";
			$str.=$ro_tipi['nome'];
			$str.="\">";
			$i++;
			$q = "SELECT * FROM cliente WHERE id_tipo_cliente=$ro_tipi[id_tipo_cliente]";	
			$r = $db->query($q);
			if($r){
				while($ro = mysql_fetch_array($r)){
					if ($azione=="mod" AND $ro['id_cli']==$ro_mod['id_cli']) {
						$sel="Selected";
					}
					else {
						$sel=" ";
					}
				
				$str.="<option $sel value=\"";
				$str.= $ro['id_cli'];
				$str.="\">";
				$str.= $ro['nominativo'];
				$str.="</option>\n";
				}	
			}
		$str.="</optgroup>";	
		}
		
		$str.="</select>\n";
	}
	$str.= "</TD>";
	$str.= "</TR>";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Locazione\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	if ($azione!="mod") {
	
		if (stampa_tipo_cliente($id_cli)==1) {
		//acquirenti
			
			$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
			$q = "SELECT * FROM tipo_locazione order by nome desc";	
			$r = $db->query($q);
			while($ro = mysql_fetch_array($r)){
				if ($azione=="mod" AND $ro['id_tipo_locazione']==1) {
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
				
		}
		elseif (stampa_tipo_cliente($id_cli)==4) {
		//cerca affittoecho "xxx";
		
		$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
			$q = "SELECT * FROM tipo_locazione order by nome desc";	
			$r = $db->query($q);
			while($ro = mysql_fetch_array($r)){
				if ($azione=="mod" AND $ro['id_tipo_locazione']==2) {
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
		}else {/** punto critico */
			
		$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
			$q = "SELECT * FROM tipo_locazione order by nome desc";	
			$r = $db->query($q);
			while($ro = mysql_fetch_array($r)){
				
				$str.="<option value=\"";
				$str.= $ro['id_tipo_locazione'];
				$str.="\">";
				$str.= $ro['nome'];
				$str.="</option>\n";
		
			}
			$str.="</select>\n";
			
		}
	}else {
		// l'azione � una modifica
		$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
			$q = "SELECT * FROM tipo_locazione order by nome desc";	
			$r = $db->query($q);
			while($ro = mysql_fetch_array($r)){
				if ($azione=="mod" AND $ro['id_tipo_locazione']==$ro_mod['id_tipo_locazione']) {
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
	}
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Richiesta Num.\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input class=\"readonly\" type=\"text\" name=\"id_ric\"readonly value=\"";
	if ($azione=="mod") {
		$str.= $id_ric;
	}
	else {
		$str.=crea_id_ric();
	}
	$str.="\" size=\"10\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Immobile\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	
	
	$q_tipi_loc="SELECT * FROM tipo_immobile order by nome asc";
	$r_tipi_loc=$db->query($q_tipi_loc);
	
	$str.= "<div class=\"clienti\">\n";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
		$str.="Seleziona il tipo di Immobile ricercato";
		$str.="</td>\n";
		$str.="</tr>\n";
		$x=mysql_num_rows($r_tipi_loc);
		$y=0;
		while ($x>$y) {
			$str.= "<TR>\n";
		 	for ($i=0;$i<3; $i++,$y++){
				/**
				 * scrivere checked per far selezionare il tipo immobile
				 */
				/**SELECT id_tipo_immobile
FROM ric_tipo_imm
JOIN cli_ric ON cli_ric.id_ric = ric_tipo_imm.id_ric
WHERE ric_tipo_imm.id_ric =79

				 * 	
				 * 
				 */
				if ($azione=="mod") {
					 $q_check = "SELECT id_tipo_immobile FROM ric_tipo_imm 
					 JOIN cli_ric ON cli_ric.id_ric = ric_tipo_imm.id_ric WHERE ric_tipo_imm.id_ric =$id_ric ";
					 $r_check=$db->query($q_check);
					 
					 /**
					  * l'array_id_tipo_immobile contiente gli id dei tipi di immobile selezionati
					  * 
					  * uso la funzione in _array ("giorgio",$nomearray) per sapere se un id_tipo_immobile
					  * � stato selezionato
					  */
					 while ($ro_check=mysql_fetch_array($r_check)) {
					 	$array_id_tipo_imm[] = $ro_check['id_tipo_immobile'];
			 		}
				}else {
					$array_id_tipo_imm="";
				}
				 
							 

				$str.= "<TD class=\"doc_box\">\n";
				if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
					
					if ($azione=="mod" AND in_array($ro_tipi_loc['id_tipo_immobile'],$array_id_tipo_imm)) {
						$sel="checked";
					}
					else {
						$sel="";
					}
					
					$str.="<input $sel type=\"checkbox\" name=\"id_tipo_immobile[]\" value=\"";
					$str.=$ro_tipi_loc['id_tipo_immobile'];
					$str.="\"/>\n";
					$str.= $ro_tipi_loc['nome'];
				}
				$str.= "</TD>\n";
				
				$y++;
				$i++;
				$str.= "<TD class=\"doc_box\">\n";
				if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
					if ($azione=="mod" AND  in_array($ro_tipi_loc['id_tipo_immobile'],$array_id_tipo_imm)) {
						$sel="checked";
					}
					else {
						$sel="";
					}
					$str.="<input $sel type=\"checkbox\" name=\"id_tipo_immobile[]\" value=\"";
					$str.=$ro_tipi_loc['id_tipo_immobile'];
					$str.="\"/>\n";
					$str.= $ro_tipi_loc['nome'];
				}
				$str.= "</TD>\n";
				
				$y++;
				$i++;
				$str.= "<TD class=\"doc_box\">\n";
				
				if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
					if ($azione=="mod" AND  in_array($ro_tipi_loc['id_tipo_immobile'],$array_id_tipo_imm)) {
						$sel="checked";
					}
					else {
						$sel="";
					}
					$str.="<input $sel type=\"checkbox\" name=\"id_tipo_immobile[]\" value=\"";
					$str.=$ro_tipi_loc['id_tipo_immobile'];
					$str.="\"/>\n";
					$str.= $ro_tipi_loc['nome'];
				}
				
				$str.= "</TD>\n";
				
				
				
			}
			$str.= "</TR>";
		}
		
		
		
		$str.= "</TABLE>";

		$str.="</div>";
	
	
	
	
	$str.= "</TD>";
	$str.= "</TR>";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Provincia\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_provincia\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM provincia order by nome asc";	
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
	$q = "SELECT * FROM citta order by nome asc";	
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
	$q = "SELECT * FROM zona order by nome asc";	
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
		
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq minimi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_min\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['mq_min'];
	}	
	$str.="\" size=\"10\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq massimi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_max\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['mq_max'];
	}	
	$str.="\" size=\"10\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo minimo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo_min\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['prezzo_min'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo massimo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo_max\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['prezzo_max'];
	}	
	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
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
	$str.= "Tipo Richiesta\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_richiesta\">\n";
	$str.="<option value=\"\">Scegli</option>\n";
	$q = "SELECT * FROM tipo_richiesta";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		if ($azione=="mod" AND $ro['id']==$ro_mod['id_tipo_richiesta']) {
			$sel="Selected";
		}
		else {
			$sel=" ";
		}
		
		$str.="<option $sel value=\"";
		$str.= $ro['id'];
		$str.="\">";
		$str.= $ro['tipo_richiesta'];
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
	$str.= "</TR>";
	$str.= "<TR>";
	$str.= "<TD class=\"clienti_show_header\">";
	$str.= "Note";
	$str.= "</TD>";
	$str.= " <TD class=\"clienti_show\">";
	$str.= "<textarea rows=\"10\" cols=\"80\"  name=\"note\">";
	if ($azione=="mod") {
		$str.= $ro_mod['note'];
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


function opzioni_richiesta($id_tipo_locazione="", $id_ric=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$visualizza ="<a href=\"richiesta_show.php?id_ric=".$id_ric."\"><img src=\"images/cliente_affittuario.gif\" title=\"Visualizza i dati della richiesta	\"/></a>";
	//onmouseover="balloon.showTooltip(event,'load:lorem1')"
	
	
	$str="";

	switch ($id_tipo_locazione) {
		
		
		case 1: // vendita
			$richieste = "<a href=\"immobile_ricerca_trova.php?id_ric=".$id_ric."\"><img class=\"cliente_opzioni\" src=\"images/cliente_richieste.gif\" title=\"Mostra Richieste Correlate all'immobile\"/></a>";
			$str.= $visualizza;
			$str.= $richieste;
			//$str.=$baloon;
			break;
		
		case 2: //affitto
			
			$richieste = "<a href=\"immobile_ricerca_trova.php?id_ric=".$id_ric."\"><img class=\"cliente_opzioni\" src=\"images/cliente_richieste.gif\" title=\"Mostra tutti i clienti disposti predere in affitto l'immobile\"/></a>";
			$str.= $visualizza;
			//$str.= $richieste;
		//$str.=$baloon;
			break;
		case null:
		default:
			
			$str.="Nessuna Opzione";
			break;
	}
	return $str;
}


function lista_richieste_cliente($id_cli=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$str="";
	
	$q="SELECT * FROM cli_ric JOIN richiesta ON richiesta.id_ric=cli_ric.id_ric WHERE cli_ric.id_cli=$id_cli";
	
	
	$r=$db->query($q);
	if (!$r) {
  		
		
		$str.="<tr><td  colspan=\"4\"><center>Nessuna richiesta associata al cliente </center></td></tr>";
	}	
	
	if ($r) {
		
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"lista_richieste_cliente\">";
		
	    $str.="<THEAD class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="Rif.Ric";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Prezzo";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		$str.="<td>";
		$str.="Tipo di Locazione";
		$str.="</td>";
	
		$str.="</TR>";

		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_ric']."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			$str.= "<TD class=\"clienti\">\n";
			$str.= prezzo_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			
			$str.= "<TD class=\"clienti\">\n";
		
			$str.= opzioni_richiesta($ro['id_tipo_locazione'],$ro['id_ric'])."\n</TD>\n";
		
			$str.= "<TD class=\"clienti\">\n";
			$str.= tipo_locazione($ro['id_tipo_locazione']);
			$str.="</td>";
		
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('lista_richieste_cliente','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('lista_richieste_cliente',Array('S','S','S','S'));";
		$str.="</script>";
	}	
	
	return $str;
	
}


function mq_ric_stampa($id_ric=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q_prezzo= "SELECT * FROM richiesta WHERE id_ric = $id_ric";
	$r_prezzo=$db->query($q_prezzo);
	$ro_prezzo=mysql_fetch_array($r_prezzo);
	if ($ro_prezzo['mq_min']==null and $ro_prezzo['mq_max']==null) {
		$str.="Dato assente";
		return $str;
	}
	if ($ro_prezzo['mq_min']!=null and $ro_prezzo['mq_max']!=null) {
		$str.="min: ".$ro_prezzo['mq_min'];
		$str.="<br>";
		$str.="max: ".$ro_prezzo['mq_max'];
		return $str;
	}
	else {
		
		if($ro_prezzo['mq_min']==null){
			$str.="min: 0";
			$str.="<br>";
			$str.="max: ".$ro_prezzo['mq_max'];
			return $str;
		}
		if($ro_prezzo['mq_max']==null){
			$str.="min: ".$ro_prezzo['mq_min'];
			$str.="<br>";
			$str.="max: 0";
			return $str;
		}
	}
}

function prezzo_ric_stampa($id_ric=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
$str="";
	$q_prezzo= "SELECT * FROM richiesta WHERE id_ric = $id_ric";
	$r_prezzo=$db->query($q_prezzo);
	$ro_prezzo=mysql_fetch_array($r_prezzo);
	if ($ro_prezzo['prezzo_min']==null and $ro_prezzo['prezzo_max']==null) {
		$str.="Dato assente";
		return $str;
	}
	if ($ro_prezzo['prezzo_min']!=null and $ro_prezzo['prezzo_max']!=null) {
		$str.="min: ".stampa_prezzo($ro_prezzo['prezzo_min']);
		$str.="<br>";
		$str.="max: ".stampa_prezzo($ro_prezzo['prezzo_max']);
		return $str;
	}
	else {
		
		if($ro_prezzo['prezzo_min']==null){
			$str.="min: ".stampa_prezzo(0);
			$str.="<br>";
			$str.="max: ".stampa_prezzo($ro_prezzo['prezzo_max']);
			return $str;
		}
		if($ro_prezzo['prezzo_max']==null){
			$str.="min: ".stampa_prezzo($ro_prezzo['prezzo_min']);
			$str.="<br>";
			$str.="max: ".stampa_prezzo(0);
			return $str;
		}
	}

}	
	

  function stampa_data($data=""){
    list($aaaa, $mm, $gg) = explode("-", $data);

    $ret_data = $gg.'/'. $mm.'/'. $aaaa;
    return  $ret_data;
}
	
function scheda_richiesta($id_ric=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if (isset($id_ric)) {
		$q="SELECT * FROM richiesta WHERE  id_ric=$id_ric";
		$r=$db->query($q);
		$ro=mysql_fetch_array($r);
			
		
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
		$str.="Scheda Rif.Ric. $id_ric";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Rif.Ric\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.="<a href=\"richiesta_show.php?id_ric=";
		$str.= $id_ric;
		$str.="\">";
		$str.= $id_ric;
		$str.="</a>";
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Tipo Locazione\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= tipo_locazione($ro['id_tipo_locazione']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Data Inserimento\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= stampa_data($ro['data_ins']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
                $str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Data ultima modifica\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
                
                $data_last_mod = $ro['data_last_mod'];
                $str.= date("d-n-Y",$data_last_mod);
		
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Lista tipi Immobile Desiderati\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
	
	
		$q_tipi_loc="SELECT * FROM ric_tipo_imm JOIN tipo_immobile ON 
		tipo_immobile.id_tipo_immobile=ric_tipo_imm.id_tipo_immobile where id_ric = $id_ric";
		$r_tipi_loc=$db->query($q_tipi_loc);
		
		$str.= "<div class=\"clienti\">\n";
			$str.= "<TABLE id=\"clienti\">\n";
			
			$x=mysql_num_rows($r_tipi_loc);
			$y=0;
			while ($x>$y) {
				$str.= "<TR>\n";
			 	for ($i=0;$i<3; $i++,$y++){
					
					 
								 
	
					$str.= "<TD class=\"doc_box\">\n";
					if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
						
					
						
						
						$str.= $ro_tipi_loc['nome'];
					}
					$str.= "</TD>\n";
					
					$y++;
					$i++;
					$str.= "<TD class=\"doc_box\">\n";
					if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
						
						
						$str.= $ro_tipi_loc['nome'];
					}
					$str.= "</TD>\n";
					
					$y++;
					$i++;
					$str.= "<TD class=\"doc_box\">\n";
					
					if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
					
						$str.= $ro_tipi_loc['nome'];
					}
					
					$str.= "</TD>\n";
					
					
					
				}
				$str.= "</TR>";
			}
			
			
			
			$str.= "</TABLE>";
	
			$str.="</div>";
		
		
		
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Provincia\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= provincia_stampa($ro['id_provincia']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Citt&agrave;\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= citta_stampa($ro['id_comune']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Zona\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		$str.= zona_stampa($ro['id_zona']);
		$str.= "</TD>\n";
		$str.= "</TR>\n";       
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Mq Min";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['mq_min'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Mq Max";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['mq_max'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Prezzo Min";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= stampa_prezzo($ro['prezzo_min']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Prezzo Max";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= stampa_prezzo($ro['prezzo_max']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Garage";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= garage_stampa($ro['id_garage']);
		$str.= "</TD>";
		$str.= "</TR>";
                
                $str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Tipo Richiesta";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= tipo_richiesta_stampa($ro['id_tipo_richiesta']);
		$str.= "</TD>";
		$str.= "</TR>";
                
                
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero Piani";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['num_piani'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero Camere";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['num_camere'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Numero Bagni";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['num_bagni'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Stato";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= stato_stampa($ro['id_stato']);
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Note";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['note'];
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Archiviato?";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		if($ro['archiviato']==1){
    $str.="si";
    }else{
    $str.="no";
    }
		
		$str.= "</TD>";
		$str.= "</TR>";
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	else {
		$str.="Nessuna richiesta selezionata";
	}
	return $str;
}


function lista_richieste($id_tipo_locazione=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$str="";
	
	$q="SELECT * FROM cli_ric JOIN richiesta ON richiesta.id_ric=cli_ric.id_ric WHERE id_tipo_locazione=$id_tipo_locazione AND archiviato=0 ORDER BY azione DESC, data_last_mod DESC";
	
	
	$r=$db->query($q);
	if (!$r) {
  		
		
		$str.="<tr><td  colspan=\"4\"><center>Nessuna richiesta </center></td></tr>";
	}	
	
	if ($r) {
		
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"lista_richieste_index\">";
		
	    $str.="<THEAD  class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
                $str.="<td></td>";
		$str.="<TD>";
		$str.="Rif.Ric";
		$str.=" </TD>";
                $str.="<TD>";
		$str.="Tipologia";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
                $str.="<TD>";
		$str.="Zona";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Prezzo";
		$str.="</TD>";
                $str.="<TD>";
		$str.="Data Modifica";
		$str.="</TD>";
                
                 
		$str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
                
                $str.="<td>";
                $str.="Num Richieste";
                $str.="</td>";
                $str.="<td>";
                $str.="Note";
                $str.="</td>";
		$str.="<td>";
		$str.="Nome Cliente";
		$str.="</td>";
		$str.="<td>";
		$str.="Telefono Cliente";
		$str.="</td>";
                $str.="<td>";
		$str.="Nota Cliente";
		$str.="</td>";
                 $str.="<td>";
		$str.="Azione";
		$str.="</td>";
		$str.="</TR>";
	
		
		$str.="</THEAD>";
               $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
                         $str.= "<TD class=\"clienti_nomeCliente\">\n";
			
                         switch ($ro['azione']){
                             
                             case 0:
                                 $str.= "";
                                 break;
                             
                             case 1:
                                  $str.= '<img src="images/esclamativo.png" />';
                                 break;
                             
                             case 2:
                                  $str.= '<img src="images/cornetta.png" />';
                                 break;
                             
                             
                         }
			$str.="</td>";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_ric']."\n</TD>\n";
                     
                        
                        $str.= " <TD class=\"clienti_show\">\n";
	
	
		$q_tipi_loc="SELECT * FROM ric_tipo_imm JOIN tipo_immobile ON 
		tipo_immobile.id_tipo_immobile=ric_tipo_imm.id_tipo_immobile where id_ric = ".$ro['id_ric'];
		$r_tipi_loc=$db->query($q_tipi_loc);
		
		$str.= "<div class=\"clienti\">\n";
			$str.= "<TABLE id=\"clienti\">\n";
			if($r_tipi_loc){
			$x=mysql_num_rows($r_tipi_loc);
                        }   
			$y=0;
			while ($x>$y) {
				$str.= "<TR>\n";
			 	for ($i=0;$i<3; $i++,$y++){
					
					 
								 
	
					$str.= "<TD class=\"doc_box\">\n";
                                        if($r_tipi_loc){
					if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
						
					
						
						
						$str.= $ro_tipi_loc['nome'];
					}
                                        }
					$str.= "</TD>\n";
					
					$y++;
					$i++;
					$str.= "<TD class=\"doc_box\">\n";
                                        if($r_tipi_loc){
					if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
						
						
						$str.= $ro_tipi_loc['nome'];
					}}
					$str.= "</TD>\n";
					
					$y++;
					$i++;
					$str.= "<TD class=\"doc_box\">\n";
					if($r_tipi_loc){
					if ($ro_tipi_loc=mysql_fetch_array($r_tipi_loc)) {
					
						$str.= $ro_tipi_loc['nome'];
					}
					}
					$str.= "</TD>\n";
					
					
					
				}
				$str.= "</TR>";
			}
			
			
			
			$str.= "</TABLE>";
	
			$str.="</div>";
		
		
		
		
                        $str.= "</TD>";
                        
                        
                        
                        
                        $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
                        $str.= "<TD class=\"clienti\">\n";
			$str.= zona_stampa($ro['id_zona'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			$str.= "<TD class=\"clienti\">\n";
			$str.= prezzo_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			
			$str.= "<TD>\n";
		
                        $data_last_mod = $ro['data_last_mod'];
                        $str.= date("d-n-Y",$data_last_mod);
                        $str.="\n</TD\n>";
                        $str.= "<TD>\n";
			$str.= opzioni_richiesta($ro['id_tipo_locazione'],$ro['id_ric'])."\n</TD>\n";
                	$str.= "<TD class=\"clienti\">\n";
			$str.= "num ric";
			$str.="\n</TD\n>";
                        $str.= "<TD class=\"clienti\">\n";
                        $str.= '<a href="#" title="'.$ro['note'].'">';
			$str.= 'click to show note';
                         $str.='</a>';
			$str.="\n</TD\n>";
			$str.= "<TD class=\"clienti_nomeCliente\">\n";
			$str.= nominativo_stampa(id_ric_to_id_cli($ro['id_ric']));
			$str.="</td>";
			$str.= "<TD class=\"clienti_nomeCliente\">\n";
			//$str.= citta_stampa(id_cli_to_id_citta(id_ric_to_id_cli($ro['id_ric'])));
                        $str.= telefono_stampa(id_ric_to_id_cli($ro['id_ric']));
			$str.="</td>";
                        $str.= "<TD class=\"clienti_nomeCliente\">\n";
			
                        $str.= nota_stampa(id_ric_to_id_cli($ro['id_ric']));
                       
			$str.="</td>";
                        
                         $str.= "<TD class=\"clienti_nomeCliente\">\n";
			
                        
                                 $str.= '<a href="richiesta_stato.php?id_ric='.$ro['id_ric'].'&azione=1"><img src="images/esclamativo.png" /></a>';
                               $str.= " - ";
                                 $str.= '<a href="richiesta_stato.php?id_ric='.$ro['id_ric'].'&azione=2"><img src="images/cornetta.png" /></a>';
                                
                              $str.= " - ";
                                 $str.= '<a href="richiesta_stato.php?id_ric='.$ro['id_ric'].'&azione=0"><img src="images/divieto.jpg" /></a>';
                                
                             
                             
                         
			$str.="</td>";
                        
                      
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('lista_richieste_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('lista_richieste_index',Array('S','S','S','S'));";
		$str.="</script>";
	}	
	
	return $str;
	
}
 
function lista_richieste_archiviate(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$str="";
	
	$q="SELECT * FROM cli_ric JOIN richiesta ON richiesta.id_ric=cli_ric.id_ric WHERE archiviato=1 ORDER BY data_ins DESC";
	
	
	$r=$db->query($q);
	if (!$r) {
  		
		
		$str.="<tr><td  colspan=\"4\"><center>Nessuna richiesta </center></td></tr>";
	}	
	
	if ($r) {
		
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"lista_richieste_index\">";
		
	    $str.="<THEAD  class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="Rif.Ric";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Prezzo";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		$str.="<td>";
		$str.="Nome Cliente";
		$str.="</td>";
		$str.="<td>";
		$str.="Citt&agrave; Cliente";
		$str.="</td>";
		$str.="</TR>";
	
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_ric']."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			$str.= "<TD class=\"clienti\">\n";
			$str.= prezzo_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			
			$str.= "<TD>\n";
		
			$str.= opzioni_richiesta($ro['id_tipo_locazione'],$ro['id_ric'])."\n</TD>\n";
		
		
			$str.= "<TD class=\"clienti_nomeCliente\">\n";
			$str.= nominativo_stampa(id_ric_to_id_cli($ro['id_ric']));
			$str.="</td>";
			$str.= "<TD class=\"clienti_nomeCliente\">\n";
			$str.= citta_stampa(id_cli_to_id_citta(id_ric_to_id_cli($ro['id_ric'])));
			$str.="</td>";
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('lista_richieste_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('lista_richieste_index',Array('S','S','S','S'));";
		$str.="</script>";
	}	
	
	return $str;
	
}



function ricerca_immobile_form(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"GET\" action=\"immobile_ricerca_trova.php\">\n";
		
	$str.= "<TABLE id=\"clienti\">\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Locazione\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
	$q = "SELECT * FROM tipo_locazione";	
	$r = $db->query($q);
	$str.="<option value=\"all\">Tutte le locazioni</option>";
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option value=\"";
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
	$str.= "Tipo di Immobile\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_immobile\">\n";

	$q = "SELECT * FROM tipo_immobile ORDER BY nome asc";	
	$r = $db->query($q);
	$str.="<option value=\"all\">Tutte le tipologie</option>";
	while($ro = mysql_fetch_array($r)){
	
		$str.="<option  value=\"";
		$str.= $ro['id_tipo_immobile'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Provincia\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_provincia\">\n";
	$str.="<option value=\"all\">Tutte le provincie</option>\n";
	$q = "SELECT * FROM provincia ORDER BY nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		$str.="<option  value=\"";
		$str.= $ro['id_provincia'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Citt&agrave;\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_citta\">\n";
	$str.="<option value=\"all\">Tutte le citta</option>\n";
	$q = "SELECT * FROM citta ORDER BY nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
	
		$str.="<option  value=\"";
		$str.= $ro['id_citta'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";
		
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq minimi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_min\" value=\"";
	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq massimi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_max\" value=\"";
	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo minimo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo_min\" value=\"";

	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo massimo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo_max\" value=\"";

	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Garage\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_garage\">\n";
	$str.="<option value=\"all\">con e senza</option>\n";
	$q = "SELECT * FROM garage";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option  value=\"";
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
	$str.= "Zona\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_zona\">\n";
	$str.="<option value=\"all\">tutte</option>\n";
	$q = "SELECT * FROM zona ORDER BY nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option  value=\"";
		$str.= $ro['id_zona'];
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

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Camere\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_camere\" value=\"";

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";

	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Bagni\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_bagni\" value=\"";

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Stato\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_stato\">\n";
	$str.="<option value=\"all\">Tutte le condizioni</option>\n";
	$q = "SELECT * FROM stato";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		$str.="<option  value=\"";
		$str.= $ro['id_stato'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";
	}
	$str.="</select>\n";
	
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "al piano\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"al_piano\" value=\"";

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
        
        
        $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Via\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"via\" value=\"";

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
        
        
        
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Ricerca Precisa\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<input type=\"checkbox\" name=\"tipo_ricerca\" value=\"1\" checked>";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
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

function giaProposto($id_imm,$id_ric){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$q="SELECT * FROM proposte WHERE id_imm=$id_imm and id_ric=$id_ric";
	$r=$db->query($q);
	if (!$r) {
		return false;
	}
	else {
		
		return true;
	}
	
	
}
	
function lista_ricerca($query=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
        
	$q=$query;
	
	$r=$db->query($q);
	if (!$r) {
  		echo "<SCRIPT>";
		echo "alert(\"Nessun immobile trovato nel database \")";
		echo "</SCRIPT>";
		
		$str.= "<center>Nessun immobile trovato nel database</center>";
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
		$str.="Zona";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq/Prezzo";
		$str.="</TD>";
                $str.="<TD>";
		$str.="al_piano";
		$str.="</TD>";
                $str.="<TD>";
		$str.="Propietario";
		$str.="</TD>";
		 $str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
	
	
		$str.="<td>";
		$str.="Tipo di Locazione";
		$str.="</td>";
	
		$str.="</TR>";
	
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
                        $str.='<a class="fancybox fancybox.ajax" href="immobile_popup_detail.php?id_imm='.$ro['id_imm'].'">';
			$str.= $ro['id_imm']."\n</a></TD>\n";
                         $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
                         $str.= "<TD class=\"clienti\">\n";
			$str.= zona_stampa($ro['id_zona'])."\n</TD>\n";
			$str.= "<TD class=\"clienti_mq\">\n";
			$str.= mq_stampa($ro['id_imm']);
			$str.=" -- ";
			$str.= prezzo_stampa($ro['id_imm']);
			$str.="\n</TD\n>";
			 $str.= "<TD class=\"clienti\">\n";
			$str.= $ro['al_piano']."\n</TD>\n";
			
			$str.= "<TD class=\"clienti\">\n";
                        $str.='<a href="cliente_show.php?id_cli='.id_imm_to_id_cli($ro['id_imm']).'">';
			$str.=  nominativo_stampa(id_imm_to_id_cli($ro['id_imm'])). "\n";
                        $str.='</a>';    
                        $str.="</TD>\n";
                        $str.= "<TD>\n";
			$str.= opzioni_immobile($ro['id_tipo_locazione'],$ro['id_imm'])."\n";
			
			if( !isset($_GET['id_ric'])){
				
				
			}else{
				if(giaProposto($ro['id_imm'],$_GET['id_ric'])){
					
					$str.='<a onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'no\');return false;"  href="immobile_ricerca_trova_proponi_del.php?id_imm='.$ro['id_imm'].'&id_ric='.$_GET['id_ric'].'"><img src="images/proposta_del.gif" alt="Gia Proposto, CANCELLALO"/></a>';
				}else{
					$str.='<a href="immobile_ricerca_trova_proponi.php?id_imm='.$ro['id_imm'].'&id_ric='.$_GET['id_ric'].'"><img src="images/proposta.gif" alt="Proponi"/></a>';
				}
			}
			$str.= "</TD>\n";
		
			$str.= "<TD class=\"clienti\">\n";
			$str.= tipo_locazione($ro['id_tipo_locazione']);
			
			
			
			$str.="</td>";
		
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('immobili_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('immobili_index',Array('S','S','S','S','S'));";
		$str.="</script>";

	}	
	
	return $str;
	
}



function ricerca_richiesta_form(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form method=\"GET\" action=\"richiesta_ricerca_trova.php\">\n";
		
	$str.= "<TABLE id=\"clienti\">\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo di Locazione\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_locazione\">\n";
	$q = "SELECT * FROM tipo_locazione";	
	$r = $db->query($q);
	$str.="<option value=\"all\">Tutte le locazioni</option>";
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option value=\"";
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
	$str.= "Tipo di Immobile\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_immobile\">\n";

	$q = "SELECT * FROM tipo_immobile ORDER BY nome ASC";	
	$r = $db->query($q);
	$str.="<option value=\"all\">Tutte le tipologie</option>";
	while($ro = mysql_fetch_array($r)){
	
		$str.="<option  value=\"";
		$str.= $ro['id_tipo_immobile'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Provincia\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_provincia\">\n";
	$str.="<option value=\"all\">Tutte le provincie</option>\n";
	$q = "SELECT * FROM provincia ORDER BY nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		$str.="<option  value=\"";
		$str.= $ro['id_provincia'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Citt&agrave;\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_citta\">\n";
	$str.="<option value=\"all\">Tutte le citta</option>\n";
	$q = "SELECT * FROM citta ORDER BY nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
	
		$str.="<option  value=\"";
		$str.= $ro['id_citta'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";
		
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq minimi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_min\" value=\"";
	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Mq massimi\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"mq_max\" value=\"";
	
	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo minimo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo_min\" value=\"";

	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Prezzo massimo\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"prezzo_max\" value=\"";

	$str.="\" size=\"20\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Garage\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_garage\">\n";
	$str.="<option value=\"all\">con e senza</option>\n";
	$q = "SELECT * FROM garage";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option  value=\"";
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
	$str.= "Zona\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_zona\">\n";
	$str.="<option value=\"Tutte\">Tutte</option>\n";
	$q = "SELECT * FROM zona ORDER BY nome asc";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option  value=\"";
		$str.= $ro['id_zona'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";

	}
	$str.="</select>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
        
         $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Tipo Richiesta\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_tipo_richiesta\">\n";
	$str.="<option value=\"all\">Tutte</option>\n";
	$q = "SELECT * FROM tipo_richiesta";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		
		$str.="<option  value=\"";
		$str.= $ro['id'];
		$str.="\">";
		$str.= $ro['tipo_richiesta'];
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

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Camere\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_camere\" value=\"";

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";

	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Numero Bagni\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"text\"  name=\"num_bagni\" value=\"";

	$str.="\" size=\"40\"/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Stato\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_stato\">\n";
	$str.="<option value=\"all\">Tutte le condizioni</option>\n";
	$q = "SELECT * FROM stato";	
	$r = $db->query($q);
	while($ro = mysql_fetch_array($r)){
		
		$str.="<option  value=\"";
		$str.= $ro['id_stato'];
		$str.="\">";
		$str.= $ro['nome'];
		$str.="</option>\n";
	}
	$str.="</select>\n";
	
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Ricerca Precisa\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<input type=\"checkbox\" name=\"tipo_ricerca\" value=\"1\" checked>";
	$str.= "</TD>\n";
	$str.= "</TR>\n";	
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





function lista_ricerca_richieste($query=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";

	$q=$query;
	
	$r=$db->query($q);

	if (!$r) {
  		
		
		$str.="<tr><td  colspan=\"4\"><center>Nessuna richiesta Trovata </center></td></tr>";
	}	

	if ($r) {
		
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"lista_richieste_index\">";
		
	    $str.="<THEAD  class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="Rif.Ric";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Prezzo";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		$str.="<td>";
		$str.="Nome Cliente";
		$str.="</td>";
	
		$str.="</TR>";
	
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_ric']."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			$str.= "<TD class=\"clienti\">\n";
			$str.= prezzo_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			
			$str.= "<TD class=\"clienti_opz\">\n";
		
			$str.= opzioni_richiesta($ro['id_tipo_locazione'],$ro['id_ric'])."\n</TD>\n";
		
			$str.= "<TD class=\"clienti_nomeCliente\">\n";
			$str.= nominativo_stampa(id_ric_to_id_cli($ro['id_ric']));
			$str.="</td>";
		
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('lista_richieste_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('lista_richieste_index',Array('S','S','S','S'));";
		$str.="</script>";
	}	
	
	return $str;
	
}


function lista_ricerca_richieste_immobile($id_imm="",$debug=false,$num_richieste=false){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
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
        // recupero i dati utili dell'immobile
        
        $query_imm="select * from immobile where id_imm=".$id_imm;
	
	$r_imm=$db->query($query_imm);
        $ro_imm=mysql_fetch_array($r_imm);
        /*
        echo "<pre>";
        print_r($ro_imm);
        echo "<pre>";
        */
         
        //exit;
        if($ro_imm['id_tipo_locazione']==""){
	
		$querylocazione = "";
	}
	else{
		$querylocazione = "id_tipo_locazione  = $ro_imm[id_tipo_locazione] AND";
	}
        $querytipoimmobile = "id_tipo_immobile  = $ro_imm[id_tipo_immobile] AND";
	$querytipoimmobilejoin="JOIN ric_tipo_imm ON ric_tipo_imm.id_ric= richiesta.id_ric";
        
        if($ro_imm['id_provincia']==""){
		$queryprovincia = "";
	}
	else{
		$queryprovincia = "id_provincia  = $ro_imm[id_provincia] AND";
	}
        
        if($ro_imm['id_comune']==""){
		$querycitta = "";
	}
	else{
		$querycitta = "(id_comune is null or id_comune  = $ro_imm[id_comune] ) AND";
	}
        
        if($ro_imm['mq']==""){
            $querymq = "";
            
        }else{
            
            
            $querymq = "(mq_min is null or mq_min  >= $ro_imm[mq]-$mq_inmeno) and (mq_max is null or mq_max <= $ro_imm[mq]+$mq_inpiu) AND";
            
            
        }
       if($ro_imm['prezzo']==""){
           $queryprezzo="";
           
           
       }else{
           //$queryprezzo = "(prezzo_min is null or prezzo_min  >= $ro_imm[prezzo]-$prezzo_inmeno) and (prezzo_max is null or prezzo_max <= $ro_imm[prezzo]+$prezzo_inpiu) AND";
           $queryprezzo = "(prezzo_max is null or prezzo_max <= $ro_imm[prezzo]+$prezzo_inpiu) AND";
       }
        
        
       
        $query="SELECT * FROM richiesta $querytipoimmobilejoin WHERE $querylocazione $querytipoimmobile $queryprovincia $querycitta $querymq
 $queryprezzo "; //$queryzona $querygarage  $querynum_bagni $querynum_piani $querynum_camere $queryid_stato
$s=strlen(trim($query));
$query = substr_replace($query,"",$s-3);

//echo $query;

        
        
	$q=$query;
	
	$r=$db->query($q);

	if (!$r) {
  		
		
		$str.="<tr><td  colspan=\"4\"><center>Nessuna richiesta Trovata </center></td></tr>";
	}	

	if ($r) {
            if($num_richieste){
              
                return  mysql_num_rows($r);
            }
		echo "<br><br><strong>totale Richieste trovate: ". mysql_num_rows($r) ."</stron>";
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"lista_richieste_index\">";
		
	    $str.="<THEAD  class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="Rif.Ric";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Citt&agrave;";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Mq";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Prezzo";
		$str.="</TD>";
		$str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		$str.="<td>";
		$str.="Nome Cliente";
		$str.="</td>";
	
		$str.="</TR>";
	
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_ric']."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
			$str.= citta_stampa($ro['id_comune'])."\n</TD>\n";
			$str.= "<TD class=\"clienti\">\n";
			$str.= mq_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			$str.= "<TD class=\"clienti\">\n";
			$str.= prezzo_ric_stampa($ro['id_ric']);
			$str.="\n</TD\n>";
			
			$str.= "<TD class=\"clienti_opz\">\n";
		
			$str.= opzioni_richiesta($ro['id_tipo_locazione'],$ro['id_ric'])."\n</TD>\n";
		
			$str.= "<TD class=\"clienti_nomeCliente\">\n";
			$str.= nominativo_stampa(id_ric_to_id_cli($ro['id_ric']));
			$str.="</td>";
		
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('lista_richieste_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('lista_richieste_index',Array('S','S','S','S'));";
		$str.="</script>";
                if($debug){
                return "<br><br>" .$query;

            }else{
                return $str;
            }
	}else{	
          return "0";  
        }
}
function sistemaTesto($str){
	if(!get_magic_quotes_gpc()){  
		$str     = stripslashes($str);  
		
		
		$str      = mysql_real_escape_string($str);  
		
	} else{
		
		
	}
		
		
	return $str;
}




/**
 * Stampa il form per modificare/inserire le immagini
 *
 * @param $azione
 * @param $id_imm
 * @param $id_doc
 */
function nota_form($azione="",$id_utente="",$id_nota){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	
	if ($azione=="mod") {
		
		$q_mod="SELECT * FROM nota_utente JOIN nota ON nota_utente.id_nota=nota.id_nota WHERE nota_utente.id_nota = $id_nota";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form name=\"mainForm\" method=\"POST\" action=\"nota_save.php\" enctype=\"multipart/form-data\">\n";
	$str.="<input type=\"hidden\" name=\"id_utente\" value=\"";
	if ($azione=="mod") {
		$str.= $ro_mod['id_utente'];
	}else {
		$str.= $id_utente;
	}
	
	$str.= "\">\n";
	
	if ($azione=="mod") {
		$str.="<input type=\"hidden\" name=\"id_nota\" value=\"";
		$str.= $ro_mod['id_nota'];
		$str.= "\">\n";
	}
	
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	$str.= "<TABLE id=\"clienti\">\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Proprietario\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	if ($azione=="mod") {
		$str.=  "<b>". idUtenteToNome($ro_mod['id_utente'])."</b>";
	}else {
		$str.= " <b>". idUtenteToNome($_SESSION['id_utente'])."</b>";
	}
	
	$str.= "</TD>";
	$str.= "</TR>";
	if ($azione=="mod"){
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Nota:\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		
		$str.=   $ro_mod['testo'];
		
		$str.= "</TD>";
		$str.= "</TR>";
	}
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Nota\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<textarea cols=\"80\" rows=\"10\" name=\"testo\">\n";
	if ($azione=="mod") {
		$str.=$ro_mod['testo'];
	}
	$str.="</textarea>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Privata\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input type=\"checkbox\" name=\"private\" value=\"1\" ";
	if ($azione=="mod" and $ro_mod['private']==1 ) {
		$str.="checked";
	}else{
		
	}
	$str.="/>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";
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
function idUtenteToNome($id_utente=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$q="select nominativo from utente where id_utente = $id_utente";
	$r=$db->query($q);
	if (!$r) {
		return "Dato Assente";
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['nominativo'];
	}
}
function idUtenteToEmail($id_utente=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	
	$q="select email from utente where id_utente = $id_utente";
	$r=$db->query($q);
	if (!$r) {
		return "Dato Assente";
	}else{
		$ro= mysql_fetch_array($r);
		return $ro['email'];
	}
}

function visualizza_nota($id_nota=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	if (isset($id_nota)) {
		$q="SELECT * FROM nota JOIN nota_utente ON nota.id_nota=nota_utente.id_nota WHERE  nota.id_nota=$id_nota";
		$r=$db->query($q);
		$ro=mysql_fetch_array($r);
		
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti1\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"3\" class=\"clienti_header_top\">\n";
		$str.="Nota di ".idUtenteToNome($ro['id_utente']);
		$str.="</td>\n";
		$str.="</tr>\n";
		
		$str.= "<TR>\n";
		$str.= "<TD class=\"clienti_show_header\">\n";
		$str.= "Tipo privilegi\n";
		$str.= "</TD>\n";
		$str.= " <TD class=\"clienti_show\">\n";
		if ($ro['private']==1) {
			$str.="Riservata";
		}else{
			$str.="Pubblica";
		}
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "<TR>";
		$str.= "<TD class=\"clienti_show_header\">";
		$str.= "Testo";
		$str.= "</TD>";
		$str.= " <TD class=\"clienti_show\">";
		$str.= $ro['testo'];
		$str.= "</TD>";
		$str.= "</TR>";
		
		$str.= "</TABLE>";
		
		$str.="</div>";

	}
	else {
		$str.="<center>Nessuna nota selezionato</center>";
	}
	return $str;
}




function lista_note($id_utente=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";

	$q="SELECT * FROM nota JOIN nota_utente ON nota.id_nota=nota_utente.id_nota WHERE id_utente =$id_utente";
	
	
	$r=$db->query($q);
	if (!$r) {
  		echo "<SCRIPT>";
		echo "alert(\"Nessuna NOta nel database\")";
		echo "</SCRIPT>";
		
		$str.="<tr><td  colspan=\"4\">NESSUNA NOTA NEL DATABASE</td></tr>";
	}	
	
	if ($r) {
		$str.="<div class=\"clienti\">";
		$str.="	<TABLE id=\"immobili_index\">";
	    $str.="<THEAD class=\"thead\">";
		$str.="<TR class=\"clienti_header\">";
		$str.="<TD>";
		$str.="IdNota";
		$str.=" </TD>";
		$str.="<TD>";
		$str.="Testo";
		$str.="</TD>";
		
		 $str.="<TD>";
		$str.="Opzioni";
		$str.="</TD>";
		
		
		
		$str.="</THEAD>";
	    $str.="<TBODY>";
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD class=\"clienti_rif\">\n";
			$str.= $ro['id_nota']."\n</TD>\n";
		    $str.= "<TD class=\"clienti\">\n";
		    $testo=$ro['testo'];
		    $testoOK=$ro['testo'];
			
			if (strlen($testo)>200) {
				$testoOK=substr($testo,0,200);
			}else{
				$testoOK=$testoOK;
			}
			$str.= $testoOK."\n</TD>\n";
			
			$str.= "<TD class=\"clienti\">\n";
			
			$str.= opzioni_nota($ro['id_nota'])."\n</TD>\n";
			
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		$str.="<script type=\"text/javascript\">";
		$str.="addTableRolloverEffect('immobili_index','tableRollOverEffect1','tableRowClickEffect1');";
		$str.="</script>";
		$str.="<script type=\"text/javascript\">";
		$str.="initSortTable('immobili_index',Array('S','S','S','N',";
		
		$str.="));";
		$str.="</script>";

	}	
	
	return $str;
	
}


//----------------- This function prints calendar---------------------
function  print_calendar($mon,$year)
	{
		global $dates, $first_day, $start_day;
			$cellWidth ="150";
		$first_day = mktime(0,0,0,$mon,1,$year);
		$start_day = date("w",$first_day);
		$res = getdate($first_day);
		$month_name = $res["month"];
		$no_days_in_month = date("t",$first_day);
		
		//If month's first day does not start with first Sunday, fill table cell with a space
		for ($i = 1; $i <= $start_day;$i++)
			$dates[1][$i] = " ";

		$row = 1;
		$col = $start_day+1;
		$num = 1;
		while($num<=31)
			{
				if ($num > $no_days_in_month)
					 break;
				else
					{
						$dates[$row][$col] = $num;
						if (($col + 1) > 7)
							{
								$row++;
								$col = 1;
							}
						else
							$col++;
						$num++;
					}//if-else
			}//while
		$mon_num = date("n",$first_day);
		$temp_yr = $next_yr = $prev_yr = $year;

		$prev = $mon_num - 1;
		$next = $mon_num + 1;

		//If January is currently displayed, month previous is December of previous year
		if ($mon_num == 1)
			{
				$prev_yr = $year - 1;
				$prev = 12;
			}
    
		//If December is currently displayed, month next is January of next year
		if ($mon_num == 12)
			{
				$next_yr = $year + 1;
				$next = 1;
			}

		echo "<DIV ALIGN='center'><TABLE BORDER=1 WIDTH=1600px CELLSPACING=0 BORDERCOLOR='silver'>";

		echo 	"\n<TR ALIGN='center'><TD BGCOLOR='white'> ".
			 "<A HREF='index.php?month=$prev&year=$prev_yr' STYLE=\"text-decoration: none\"><B><<</B></A> </TD>".
			 "<TD COLSPAN=5 BGCOLOR='#99CCFF'><B>".date("F",$first_day)." ".$temp_yr."</B></TD>".
			 "<TD BGCOLOR='white'> ".
			 "<A HREF='index.php?month=$next&year=$next_yr' STYLE=\"text-decoration: none\"><B>>></B></A> </TD></TR>";

		echo "\n<TR ALIGN='center'><TD width='$cellWidth'><B>Domenica</B></TD><TD width='$cellWidth'><B>Lunedi</B></TD><TD width='$cellWidth'><B>Martedi</B></TD>";
		echo "<TD width='$cellWidth'><B>Mercoledi</B></TD><TD width='$cellWidth'><B>Giovedi</B></TD><TD width='$cellWidth'><B>Venerdi</B></TD><TD width='$cellWidth'><B>Sabato</B></TD></TR>";
		echo "<TR><TD COLSPAN=7> </TR><TR height='100px;' ALIGN='center'>";
				
		$end = ($start_day > 4)? 6:5;
		for ($row=1;$row<=$end;$row++)
			{
				for ($col=1;$col<=7;$col++)
					{
						if ($dates[$row][$col] == "")
						$dates[$row][$col] = " ";
						
						if (!strcmp($dates[$row][$col]," "))
							$count++;
						
						$t = $dates[$row][$col];	
						
						//If date is today, highlight it
						if (($t == date("j")) && ($mon == date("n")) && ($year == date("Y"))){
							echo "\n<TD valign='top' BGCOLOR='aqua'><a onclick=\"NewWindow(this.href,'pg_center','780','670','no');return false;\" href='calendar_add_event.php?azione=add&gg=$t&mm=$mon&yyyy=$year'>".$t."</a>";
              echo '<div align="left">';
              echo stampa_appuntamenti($t,$mon,$year,$_SESSION['id_utente']);
              echo '</div>';
              echo "</TD>";
            }
						else{
							//If the date is absent ie after 31, print space
							echo "\n<TD valign='top'>".(($t == " " )? "&nbsp;" : "<a onclick=\"NewWindow(this.href,'pg_center','780','670','no');return false;\" href='calendar_add_event.php?azione=add&gg=$t&mm=$mon&yyyy=$year'>".$t."</a>");
               echo '<div align="left">';
              echo stampa_appuntamenti($t,$mon,$year,$_SESSION['id_utente']);
              echo '</div>';
              echo "</TD>";
					 }
          }// for -col
				
				if (($row + 1) != ($end+1))
					echo "</TR>\n<TR ALIGN='center' height='100px;'>";
				else
					echo "</TR>";
			}// for - row
		echo "\n</TABLE><BR><BR><A HREF=\"index.php\">Visualizza mese corrente</A>      </DIV>";
	}


function stampa_appuntamenti($gg,$mm,$yyyy,$id_user){

if($gg==" ") return;
$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="<div style=' font-size: 11px;'>";
	
	
		/*
		selezione tutti gli appuntamenti del giorno se l'appuntamento i ha l'utente uguale a quello corrente lo stampo
		se l'appuntamento i non appartiene all'utente corrente ma � pubblico va indicato
		
		
		*/
		$q_mod="SELECT * FROM cal_appuntamento WHERE  gg=$gg and mm=$mm and yyyy=$yyyy order by ora_inizio";

		$r_mod=$db->query($q_mod);
		if($r_mod)
		while($ro_mod=mysql_fetch_array($r_mod)){
      if($ro_mod['id_user']==$_SESSION['id_utente']){
        // lo stampo xche � il mio
        $id_evento= $ro_mod['id_app'];
      
        $str.= '<br>';
        $str.="<a onclick=\"NewWindow(this.href,'pg_center','780','670','no');return false;\" href='calendar_add_event.php?azione=mod&id_app=$id_evento'>";
        $str.='M';
        $str.='</a>';
        $str.= ' ';
        $str.="<a onclick=\"NewWindow(this.href,'pg_center','780','670','no');return false;\" href='calendar_del_event.php?id_app=$id_evento'>";
        $str.=' D';
        $str.='</a>';
        
        $str.='[';
        $str.=$ro_mod['ora_inizio'];
        $str.= ':';
        
        $str.= $ro_mod['ora_fine'];
        $str.= '][';
        $str.= idUtenteToNome($ro_mod['id_user']);
        $str.= ']';
      
      
        
      }	else{
      
        if($ro_mod['privato'] ==0 ){
          // non � il mio ma � pubblico
           $str.= '<br>';
          if($_SESSION['id_utente']==$ro_mod['inserito_da']){
            //se lo ho inserito io lo posso modificare
             $str.="<a onclick=\"NewWindow(this.href,'pg_center','500','350','no');return false;\" href='calendar_add_event.php?azione=mod&id_app=$id_evento'>";
             $str.='M';
             $str.='</a>';
          }
          $str.='[';
        $str.=$ro_mod['ora_inizio'];
        $str.= ':';
        
        $str.= $ro_mod['ora_fine'];
        $str.= '][';
        $str.= idUtenteToNome($ro_mod['id_user']);
        $str.= ']';
      
        }else{
          // non lo stampo
        
        }  
      
      
      }

  }
  $str.='<div>';
	return $str;


}

    function xHeader($pdf)
    {
        // Logo
        $pdf->Image('./images/scheda_pdf/header.png',0,0,220);
        // Arial bold 15
       // $pdf->SetFont('Arial','B',15);
        // Move to the right
       // $pdf->Cell(80);
        // Title
       // $pdf->Cell(30,10,'Title',1,0,'C');
        // Line break
        //$pdf->Ln(20);
    }
 // Page footer
    function xFooter($pdf)
    {
        // Position at 1.5 cm from bottom
        $pdf->SetY(-15);

        // Arial italic 8
      //  $pdf->SetFont('Arial','I',8);
        // Page number
        //$pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');
    }
function imm_genera_scheda($id_imm,$to_file=false){
    
    

   

    if (!isset($id_imm)) {
            return "0";
    }
  

    $pdf =new FPDF(); 
    $pdf -> AddPage(); 
    xHeader($pdf);

    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

    $query="SELECT * FROM immobile WHERE  id_imm=$id_imm";
    $result=$db->query($query);
    $ro=mysql_fetch_array($result);

    $q_foto="SELECT * FROM imm_img JOIN immagine on immagine.id_img=imm_img.id_img WHERE imm_img.id_imm =$id_imm LIMIT 3";

    $r_foto=$db->query($q_foto);

    if (!$r_foto) {

    }else {
        $a=20;
        $b=50;
        while ($ro_foto=mysql_fetch_array($r_foto)) {

            $q_img="SELECT low_res, med_res FROM immagine WHERE id_img=".$ro_foto['id_img'];
            $r_img=$db->query($q_img);
            $ro_img=mysql_fetch_array($r_img);
            $x =0+$a;
            $y=0+$b;
            $w=50;
            $pdf->Image($ro_img['med_res'],$x,$y,$w); 
            $a=$w+$x+10;

          // $b+=70;



        }
    }


    $pdf->Ln(80);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Rif. Imm.:',0,0 ); 
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$id_imm,0,1);

    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Tipo Locazione:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,tipo_locazione($ro['id_tipo_locazione']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Tipo Immobile:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,tipo_immobile($ro['id_tipo_immobile']),0,1);

    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Provincia:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,provincia_stampa($ro['id_provincia']),0,1);



    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Citta\':',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,citta_stampa($ro['id_comune']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Zona:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,zona_stampa($ro['id_zona']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Via:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$ro['via'],0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Mq:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,mq_stampa($ro['id_imm']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Prezzo:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,stampa_prezzo($ro['prezzo']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Garage:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,garage_stampa($ro['id_garage']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Numero camere:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$ro['num_camere'],0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Numero Bagni:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$ro['num_bagni'],0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Stato:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,stato_stampa($ro['id_stato']),0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Classe energetica:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$ro['classe_en'],0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Spese condominiali:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$ro['spese_cond'],0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Numero Vani:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    $pdf->cell(10,8,$ro['vani'],0,1);


    $pdf -> SetFont('Arial', 'B', 12 ); 
    $pdf -> Cell(50, 8, 'Descrizione:',0,0 );
    $pdf -> SetFont('Arial', '', 13 ); 
    //$pdf->cell(10,8,$ro['note'],0,1);
    $pdf->MultiCell(0,10,$ro['note_sito']);

    $pdf->Image('./images/scheda_pdf/footer.png',30,275,150);
    $filename="./immobili/".$id_imm."/scheda_rif_".$id_imm.".pdf";
    if($to_file){                         
        $pdf->Output($filename,'F');
    }else{
        $pdf->Output();
    }

    
    
    
}
?>