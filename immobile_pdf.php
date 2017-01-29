<?php

include_once("./framework/framework.php");
include_once("./framework/fpdf.php");
$layout = new Layout("");
imm_genera_scheda($_GET['id_imm'],false);


//echo scheda_immobile($id_imm);
//echo box_img_immobile($id_imm);
/*
echo scheda_immobile($id_imm);
echo "<br>";
echo box_img_immobile($id_imm);
echo "<br>";
echo box_doc_immobile($id_imm);
echo "<br>";
$id_cli = id_imm_to_id_cli($id_imm);
echo scheda_cliente($id_cli);	
 * 
 * 
 */
?>

