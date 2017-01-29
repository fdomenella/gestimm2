<?php

include_once("./framework/framework.php");
include_once("./framework/fpdf.php");
$layout = new Layout("");

if (isset($_GET['id_imm'])) {
	$id_imm = $_GET['id_imm'];
}
else {
	header("location: immobili_index.php");
	exit;
}

$pdf =new FPDF(); 
$pdf -> AddPage(); 


$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

$query="SELECT * FROM immobile WHERE  id_imm=$id_imm";
$result=$db->query($query);
$ro=mysql_fetch_array($result);

$q_foto="SELECT * FROM imm_img JOIN immagine on immagine.id_img=imm_img.id_img WHERE imm_img.id_imm =$id_imm";
$r_foto=$db->query($q_foto);

if (!$r_foto) {
       
}else {
    $i=0;
    while ($ro_foto=mysql_fetch_array($r_foto)) {
        
        $q_img="SELECT low_res, med_res FROM immagine WHERE id_img=".$ro_foto['id_img'];
        $r_img=$db->query($q_img);
        $ro_img=mysql_fetch_array($r_img);
        $num = 0+$i;
        $pdf->Image($ro_img['med_res'],$num,6,70);
       $i+=70;
        
        
       
    }
}
$pdf->Ln(50);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Rif. Imm.:',0,0 ); 
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$id_imm,0,1);

$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Tipo Locazione:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,tipo_locazione($ro['id_tipo_locazione']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Tipo Immobile:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,tipo_immobile($ro['id_tipo_immobile']),0,1);

$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Provincia:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,provincia_stampa($ro['id_provincia']),0,1);



$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Citta\':',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,citta_stampa($ro['id_comune']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Zona:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,zona_stampa($ro['id_zona']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Via:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$ro['via'],0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Mq:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,mq_stampa($ro['id_imm']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Prezzo:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,stampa_prezzo($ro['prezzo']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Garage:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,garage_stampa($ro['id_garage']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Numero camere:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$ro['num_camere'],0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Numero Bagni:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$ro['num_bagni'],0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Stato:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,stato_stampa($ro['id_stato']),0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Classe energetica:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$ro['classe_en'],0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Spese condominiali:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$ro['spese_cond'],0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Numero Vani:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
$pdf->cell(10,10,$ro['vani'],0,1);


$pdf -> SetFont('Arial', 'B', 16 ); 
$pdf -> Cell(65, 10, 'Descrizione:',0,0 );
$pdf -> SetFont('Arial', '', 13 ); 
//$pdf->cell(10,10,$ro['note'],0,1);
$pdf->MultiCell(0,10,$ro['note']);
$filename="immobili/".$id_imm."/".$id_imm.".pdf";
$pdf -> Output($filename,"D"); 


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

<html>
    <body>
        <a href="mailto:##?subject=my report&body=see attachment&attachment=<?php echo "http://127.0.0.1/gestimm2/".$filename; ?>">apri outlook</a>
        
    </body>
</html>

