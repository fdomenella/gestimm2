<?php

include_once("./framework/framework.php");

if (isset($_GET['id_ric'])) {
	
	$id_imm = $_GET['id_ric'];
}
else {
	
	exit;
}

$azione = $_GET['azione'];

$query="UPDATE richiesta set azione=$azione where id_ric=".$_GET['id_ric'];
	$result=$db->queryInsert($query);
	
        
        
   
	echo "<SCRIPT>";
	echo "history.back()";
	echo "</SCRIPT>";
        
        ?>