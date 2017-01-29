<?php

include_once("./framework/framework.php");
include_once("./a_upload.class.php");

define('TMP_DIR', './img_temp');
define('IMAGE_DIR', './immobili');
define('HIGH_QUALITY', 100);
define('MED_QUALITY', 100);
define('LOW_QUALITY', 100);
define('MED_WIDTH', 1024);
define('LOW_WIDTH', 500);

if(!isset($_FILES)) $_FILES = $HTTP_POST_FILES;
if(!isset($_SERVER)) $_FILES = $HTTP_POST_VARS;

$id_imm = $_POST['id_imm'];
$azione=$_POST['azione'];

$up = new FileUpload(TMP_DIR);
$up->Upload($_FILES['file']);

include_once("a_image.class.php");

$img = new Image(TMP_DIR . '/' . $up->filename);

$result = $img->CreateSourceImage();

if($result){
	if ($azione=="add") {

		 //salvo l'immagine con altezza 400 lasciandola proporzionata
	    $id_img=crea_id_img();
    
		$nome_foto = $id_imm ."-" .$id_img;
         
	    $nome_img_low= $nome_foto . "_L.jpg";
	    $nome_img_med = $nome_foto ."_M.jpg";
	    $nome_img_high= $nome_foto . "_H.jpg";
	    $nome_img_sito_high= $nome_foto . "_sito_high.jpg";
	    $nome_img_sito_low= $nome_foto . "_sito_low.jpg";
	    
	    // tra .'/'. e $up->filename devo inserire il path della cartella della categoria
      mkdir(IMAGE_DIR . '/'.$id_imm, 0755);

	    $dest_high =IMAGE_DIR . '/'.$id_imm .'/' . $nome_img_high;
	    $dest_med =IMAGE_DIR . '/'.$id_imm .'/' . $nome_img_med;
	    $dest_low =IMAGE_DIR . '/'.$id_imm .'/' . $nome_img_low;
	    $dest_sito_high =IMAGE_DIR . '/'.$id_imm .'/' . $nome_img_sito_high;
	    $dest_sito_low =IMAGE_DIR . '/'.$id_imm .'/' . $nome_img_sito_low;

	    //test per lasciare le dim invariate

	    $img->SaveProportionateImage($dest_high, HIGH_QUALITY, "auto");

	    $img->SaveProportionateImage($dest_med, HIGH_QUALITY, MED_WIDTH);

	    $img->SaveProportionateImage($dest_low, HIGH_QUALITY, LOW_WIDTH);

         
	    $img->SaveProportionateImage($dest_sito_high, "100", "500");
	    $img->SaveProportionateImage($dest_sito_low, "80", "132");



	    //libero la memoria cancellando l'immagine sorgente

	    $img->Free();

		$data_ins = date("Y-m-d");

	    //salvo i dati nel db
	    $query="INSERT INTO immagine VALUES($id_img,'$dest_high','$dest_med','$dest_low','$data_ins','$_SESSION[id_utente]',NULL,NULL,0)";
	    $result=$db->queryInsert($query);

	  	$query = "INSERT INTO imm_img VALUES($id_imm,$id_img)";
		$result=$db->queryInsert($query);
  
		echo "<SCRIPT>";

		echo "location.href=\"immobile_show.php?id_imm=$id_imm\"";

		echo "</SCRIPT>";
		exit;

	}else {
		$id_img=$_POST['id_img'];

		/**
		 * recupero i dati dell'iummagine con l'id passato per poi creare i file
		 */

		$query="SELECT * FROM immagine WHERE id_img=$id_img";
		$result=$db->query($query);
		$row=mysql_fetch_array($result);


		$dest_high = $row['high_res'];
	    $dest_med  = $row['med_res'];
	    $dest_low  = $row['low_res'];
		$dest_sito_high =str_replace("_L","_sito_high",$dest_low);
		$dest_sito_low =str_replace("_L","_sito_low",$dest_low);




		$img->SaveProportionateImage($dest_high, HIGH_QUALITY, "auto");
	    $img->SaveProportionateImage($dest_med, HIGH_QUALITY, MED_WIDTH);
	    $img->SaveProportionateImage($dest_low, HIGH_QUALITY, LOW_WIDTH);
	    $img->SaveProportionateImage($dest_sito_high, "100", "500");
	    $img->SaveProportionateImage($dest_sito_low, "80", "132");
		//libero la memoria cancellando l'immagine sorgente




	    $img->Free();
		$data_mod = date("Y-m-d");
		$query="UPDATE immagine SET high_res= '$dest_high', med_res='$dest_med',
			     low_res='$dest_low', data_last_mod ='$data_mod', id_utente_last_mod='$_SESSION[id_utente]'  WHERE id_img=$id_img";
		$result=$db->queryInsert($query);

		echo "<SCRIPT>";

		echo "location.href=\"immobile_show.php?id_imm=$id_imm\"";

		echo "</SCRIPT>";
		exit;
	}




}
else{
	echo "<SCRIPT>";
	echo "alert(\"Attenzione IMMAGINE non valida \"){";
	echo "location.href=\"immagine_add.php?azione=add?id_imm=$id_imm\"";
	echo "}";
	echo "</SCRIPT>";
	exit;
}

$up->DeleteFile();


?>
