<?php
include_once("./framework/framework.php");


/**
 * sempre settati xche passati corretti dalla pagina precedente
 */

$id_ric = $_GET['id_ric'];
$id_imm = $_GET['id_imm'];


	




	
	
	
	
	$data_ins = date("Y-m-d");

	$id_utente=$_SESSION['id_utente'];
	$query="INSERT INTO proposte VALUES($id_imm,$id_ric,'$data_ins',$id_utente)";
	$result=$db->queryInsert($query);
	
	
	/**
	 * collego la richiesta con i tipi di immobile
	 */
	
	
	
	
	
	
	
	echo "<SCRIPT>";
	echo "location.href=\"immobile_ricerca_trova.php?id_ric=$id_ric\"";
	echo "</SCRIPT>";




?>


