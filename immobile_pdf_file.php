<?php

include_once("./framework/framework.php");
include_once("./framework/fpdf.php");
$layout = new Layout("");


imm_genera_scheda($_GET['id_imm'],true);



?>

