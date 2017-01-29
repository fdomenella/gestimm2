<?PHP 
include_once("inc.session.php");
include_once("inc.auth.php");
include_once("inc.auth_admin.php");
include_once("inc.config.php");
include_once("inc.function.php");
include_once("a_config.php");
include_once("a_upload.class.php");
$id_imm = $_POST['id_imm'];
$num = $_POST['num_img'];
$azione = $_POST['azione'];


    if(!isset($_FILES)) $_FILES = $HTTP_POST_FILES; 

    if(!isset($_SERVER)) $_FILES = $HTTP_POST_VARS; 
    $up = new FileUpload(TMP_DIR); 
	 $up->Upload($_FILES['file']); 

    //adesso ridimensiono l'img a 400 x 400 

include_once("a_image.class.php"); 

    $img = new Image(TMP_DIR . '/' . $up->filename); 

    $result = $img->CreateSourceImage(); 

    if($result){ 

        //salvo l'immagine con altezza 400 lasciandola proporzionata 
		$nome_foto = $id_imm . "_".$num;
        
        $nome_img_low= $nome_foto . "_S.jpg";
        $nome_img_high= $nome_foto . "_L.jpg";
        // tra .'/'. e $up->filename devo inserire il path della cartella della categoria
        $dest_high =IMAGE_DIR . '/'. $nome_img_high;
        $dest_low =THUMB_DIR . '/' . $nome_img_low;
        
        $img->SaveProportionateImage($dest_high, IMAGE_QUALITY, IMAGE_WIDTH); 

        //salvo l'immagine con altezza 75 lasciandola proporzionata 

        $img->SaveProportionateImage($dest_low, THUMB_QUALITY, THUMB_WIDTH); 

        //libero la memoria cancellando l'immagine sorgente 

        $img->Free(); 
        
        
        //salvo i dati nel db
        
       
        	$query = "update immobili set  foto$num ='$dest_low' where id_imm = $id_imm";
			$result=safe_query($query);
        
    } 

        else{
        	echo 'Immagine non valida<br/>'; 
        }

   $up->DeleteFile(); 
	

?> 
<html>
<script type="text/javascript"> 
window.opener.location.href='a_ins_img.php?id_imm=<?php echo $id_imm;?>&azione=<?php echo $azione; ?>'
self.close(); 
</script> 
</html>
