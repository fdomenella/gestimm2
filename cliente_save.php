<?php
include_once("./framework/framework.php");


$nominativo= ucfirst(sistemaTesto($_POST['nominativo']));
$nota= ucfirst(sistemaTesto($_POST['nota']));
$email = strtolower(sistemaTesto($_POST['email']));
$codfis = strtoupper(sistemaTesto($_POST['codfis']));
$id_tipo_cliente = $_POST['id_tipo_cliente'];

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

$via = ucfirst(sistemaTesto($_POST['via']));
$mobile = trim($_POST['mobile']);
$fisso = trim($_POST['fisso']);
if ($_POST['azione']=="add") {
		
	
	$data_ins = date("d-m-y");
	$query="INSERT INTO `cliente` 
			( `id_cli` , `nominativo` , `codfisc` , `email` , `id_citta` , `via` , `tel_fisso` ,
			 `tel_mobile` , `data_ins` , `id_tipo_cliente` , `id_utente_ins` , `id_utente_last_mod`, `nota`) 
		    VALUES (
		    NULL , '$nominativo', '$codfis' , '$email' , $id_citta , '$via' , '$fisso' , 
		    '$mobile' , '$data_ins' , $id_tipo_cliente , $_SESSION[id_utente] , NULL ,'$nota')";
	$result=$db->queryInsert($query);
	$id_cli = mysql_insert_id();

	
}else {
	
	$id_cli=$_POST['id_cli'];
	$data_last_mod = date("d-m-y");
	$query="UPDATE cliente SET 
	nominativo='$nominativo',
	codfisc='$codfis',
	email='$email',
	id_citta=$id_citta,
	via='$via',
	tel_fisso='$fisso',
	tel_mobile='$mobile',
	id_tipo_cliente='$id_tipo_cliente',
	id_utente_last_mod='$_SESSION[id_utente]',
	data_last_mod='$data_last_mod'
	,nota='$nota'
	WHERE id_cli = $id_cli";
	$result=$db->queryInsert($query);

}


echo "<html>
<body><SCRIPT>";
	echo "location.href=\"cliente_show.php?id_cli=$id_cli\";";
	
	echo "</SCRIPT></body></html>";
	exit;
?>
