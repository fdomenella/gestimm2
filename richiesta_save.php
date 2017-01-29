<?php
include_once("./framework/framework.php");


/**
 * sempre settati xche passati corretti dalla pagina precedente
 */

$id_ric = $_POST['id_ric'];

$id_cli = $_POST['id_cli'];

/**
 * fine sempre settati xche passati corretti dalla pagina precedente
 */

/**
 * stringhe
 */

$note= sistemaTesto($_POST['note']);

/**
 * fine stringhe
 */

/**
 * valori numerici
 */



if ($_POST['id_stato']!="") {
	$id_stato = "'".$_POST['id_stato']."'";
	
}
else {
	$id_stato = 'null';
}

if ($_POST['num_bagni']!="") {
	$num_bagni = "'".$_POST['num_bagni']."'";
	
}
else {
	$num_bagni = 'null';
}

if ($_POST['num_camere']!="") {
	$num_camere = "'".$_POST['num_camere']."'";
	
}
else {
	$num_camere = 'null';
}

if ($_POST['num_piani']!="") {
	$num_piani =  "'".$_POST['num_piani']."'";
	
}
else {
	$num_piani = 'null';
}

if ($_POST['id_garage']!="") {
	$id_garage = "'".$_POST['id_garage']."'";
	
}
else {
	$id_garage = 'null';
}

if ($_POST['id_tipo_richiesta']!="") {
	$id_tipo_richiesta = "'".$_POST['id_tipo_richiesta']."'";
	
}
else {
	$id_tipo_richiesta = 'null';
}

if ($_POST['id_tipo_locazione']!="") {
	$id_tipo_locazione = "'".$_POST['id_tipo_locazione']."'";
	
}
else {
	$id_tipo_locazione = 'null';
}

if ($_POST['mq_min']!="") {
	$mq_min = "'".$_POST['mq_min']."'";
	
}
else {
	$mq_min = 'null';
}
if ($_POST['mq_max']!="") {
	$mq_max = "'".$_POST['mq_max']."'";
	
}
else {
	$mq_max = 'null';
}

if ($_POST['prezzo_min']!="") {
	$prezzo_min ="'".$_POST['prezzo_min']."'";
	
}
else {
	$prezzo_min = 'null';
}
if ($_POST['prezzo_max']!="") {
	$prezzo_max ="'".$_POST['prezzo_max']."'";
	
}
else {
	$prezzo_max = 'null';
}
	


if ($_POST['new_provincia']!="") {
	$id_provincia = inserisci_provincia($_POST['new_provincia']);
	
}
else {
	if ($_POST['id_provincia']!="") {
		$id_provincia ="'".$_POST['id_provincia']."'";
		
	}
	else {
		$id_provincia = 'null';
	}
	
}

if ($_POST['new_citta']!="") {
	$id_citta = inserisci_citta($_POST['new_citta']);
	
}
else {
	
	if ($_POST['id_citta']!="") {
		$id_citta ="'".$_POST['id_citta']."'";
		
	}
	else {
		$id_citta = 'null';
	}
	
}




if ($_POST['new_zona']!="") {
	$idzona= inserisci_citta($_POST['new_zona']);
	
}
else {
	
	if ($_POST['id_zona']!="") {
		$id_zona="'".$_POST['id_zona']."'";
		
	}
	else {
		$id_zona= 'null';
	}
	
}


/**
 * qui recupero l'array del tipo immobile
 */

if (isset($_POST['id_tipo_immobile'])) {
	$id_tipo_immobile=$_POST['id_tipo_immobile'];
	/**
	 * 
	 * poi lo scandisco cos�
	 * if ($id_tipo_immobile=$_POST['id_tipo_immobile']) {
	while( list($k, $v) = each($id_tipo_immobile)){
		// qui
	}
}

	 */

}else
{
	$id_tipo_immobile = 'null';
}

	

 	$now=time();



if ($_POST['azione']=="add") {

	  $data_last_mod = $now;
	
	
	
	$data_ins = date("Y-m-d");
	$query="INSERT INTO `richiesta`
	( `id_ric` , `id_comune` , `id_provincia` , `id_tipo_locazione` , `note` ,
	 `mq_min` , `mq_max` , `prezzo_min` , `prezzo_max` , `id_garage` , `num_piani` ,
	  `num_camere` , `num_bagni` , `id_stato` , `data_ins` ,`id_utente_ins` ,
	  `data_last_mod` , `id_utente_last_mod`, `id_zona`, `id_tipo_richiesta` ) 
	VALUES (
	'$id_ric', $id_citta , $id_provincia , $id_tipo_locazione, '$note',
	 $mq_min,  $mq_max, $prezzo_min, $prezzo_max, $id_garage, $num_piani,
	 $num_camere, $num_bagni, $id_stato,   '$data_ins', '$_SESSION[id_utente]' ,
	 	$data_last_mod , NULL,$id_zona,$id_tipo_richiesta)";
	$result=$db->queryInsert($query);

	
	/**
	 * collego la richiesta con la richiesta lavorando sulla tabella cli_imm
	 */
	
	$query="INSERT INTO cli_ric VALUES($id_cli,$id_ric)";
	$result=$db->queryInsert($query);
	
	
	/**
	 * collego la richiesta con i tipi di immobile
	 */
	
	
	if (is_array($id_tipo_immobile)) {
		while( list($posizione, $valore) = each($id_tipo_immobile)){
			$query="INSERT INTO ric_tipo_imm VALUES($id_ric,$valore)";
			$result=$db->queryInsert($query);
		}
	}
	
	
	
	
	echo "<SCRIPT>";
	echo "location.href=\"richiesta_show.php?id_ric=$id_ric\"";
	echo "</SCRIPT>";

}else {
	$id_ric=$_POST['id_ric'];

	
	$data_last_mod = $now;
	$query="UPDATE richiesta SET 
		id_comune= $id_citta,
		id_provincia = $id_provincia,
		id_tipo_locazione=$id_tipo_locazione,
		mq_min=$mq_min,
		mq_max=$mq_max,
		prezzo_min=$prezzo_min,
		prezzo_max=$prezzo_max,
		id_garage=$id_garage,
		num_piani=$num_piani,
		num_camere=$num_camere,
		num_bagni=$num_bagni,
		id_stato=$id_stato,
		note='$note',
		id_utente_last_mod='$_SESSION[id_utente]',
		data_last_mod='$data_last_mod',
                id_zona=$id_zona,
                id_tipo_richiesta=$id_tipo_richiesta
	WHERE id_ric = $id_ric";
	 
	$result=$db->queryInsert($query);
	
	
	
	$query="UPDATE cli_ric SET id_cli = $id_cli WHERE id_ric=$id_ric";
	$result=$db->queryInsert($query);
	
	/**
	 * prima ripulisco gli id_ immobili poi li riaggiungo
	 */
	
	$query="DELETE FROM ric_tipo_imm WHERE id_ric= $id_ric";
	$result=$db->QueryDelete($query);
	
	
	
	/**
	 * collego la richiesta con i tipi di immobile
	 */
	
	
	if (is_array($id_tipo_immobile)) {
		while( list($posizione, $valore) = each($id_tipo_immobile)){
			$query="INSERT INTO ric_tipo_imm VALUES($id_ric,$valore)";
			$result=$db->queryDelete($query);
		}
	}
	
	echo "<SCRIPT>";
	echo "location.href=\"richiesta_show.php?id_ric=$id_ric\"";
	echo "</SCRIPT>";

}


?>


