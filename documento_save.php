<?php
include_once("./framework/framework.php");
include_once("a_upload.class.php");

define('TMP_DIR', './img_temp'); 
define('IMAGE_DIR', './immobili'); 


if(!isset($_FILES)) $_FILES = $HTTP_POST_FILES; 
if(!isset($_SERVER)) $_FILES = $HTTP_POST_VARS; 
   
$id_imm = $_POST['id_imm'];
$azione=$_POST['azione'];



if ($azione=="add") {
	$note=sistemaTesto($_POST['note']);
	$id_doc=crea_id_doc(); 
	
	/**
	 * ora cerco di recuperare il nome del file
	 */
	

	$nome_doc_caricato = $_FILES['file']['name'];
		

	
	$tipo_file= substr($nome_doc_caricato,-3);
	
	
	
	$nome_doc = $id_imm ."-" .$id_doc.".".$tipo_file;
	 
  
    // tra .'/'. e $up->filename devo inserire il path della cartella della categoria

    $path =IMAGE_DIR . '/'.$id_imm .'/';
	
	
	$up = new FileUpload($path); 
	$up->RenameFile($nome_doc);
	
	$up->Upload($_FILES['file']); 
	
    
	 
	$path_completo = $path.$nome_doc;
   
    
	$data_ins = date("Y-m-d");
    
    //salvo i dati nel db
    $query="INSERT INTO documento VALUES($id_doc,'$nome_doc','$note','$tipo_file', '$path_completo','$data_ins','$_SESSION[id_utente]',NULL,NULL)";
    $result=$db->queryInsert($query);
    
  	$query = "INSERT INTO imm_doc VALUES($id_imm,$id_doc)";
	$result=$db->queryInsert($query);
   
	header("Location: immobile_show.php?id_imm=$id_imm");
	
}else {
	$id_doc=$_POST['id_doc'];
	
	/**
	 * recupero i dati dell documento con l'id passato per poi creare i file
	 */
	
	$query="SELECT * FROM documento WHERE id_doc=$id_doc";
	$result=$db->query($query);
	$row=mysql_fetch_array($result);
	$note=$_POST['note'];

	
    
    
	$nome_doc_caricato = $_FILES['file']['name'];
	$tipo_file= substr($nome_doc_caricato,-3);
		
	$nome_doc = $id_imm ."-" .$id_doc.".".$tipo_file;


 $path =IMAGE_DIR . '/'.$id_imm .'/';
   	
	
	$up = new FileUpload($path); 
	$up->RenameFile($nome_doc);

	$up->Upload($_FILES['file']); 

	$data_mod = date("Y-m-d");
	$query="UPDATE documento SET nome_file='$nome_doc', note = '$note', tipo_file='$tipo_file', data_last_mod ='$data_mod', id_utente_last_mod='$_SESSION[id_utente]'  WHERE id_doc=$id_doc";
	$result=$db->queryInsert($query);
	header("Location: immobile_show.php?id_imm=$id_imm");
}
   
	
	
	




?>
