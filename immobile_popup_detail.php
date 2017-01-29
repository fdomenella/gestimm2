<?php

include_once("./framework/framework.php");

$layout = new Layout("");

if (isset($_GET['id_imm'])) {
	$id_imm = $_GET['id_imm'];
}
else {
	header("location: immobili_index.php");
	exit;
}

echo scheda_immobile($id_imm);


?>