<?php
include_once("./framework/framework.php");

   
$id_utente = $_POST['id_utente'];
$azione=$_POST['azione'];
if (isset($_POST['private'])) {
	$private=$_POST['private'];
}else{
	$private=0;
}
$testo=sistemaTesto($_POST['testo']);
if ($azione=="add") {

	
    
    //salvo i dati nel db
    $query="INSERT INTO nota VALUES(null,'$testo',NOW(),$private)";
    $result=$db->queryInsert($query);
    $id_nota=mysql_insert_id();
  	$query = "INSERT INTO nota_utente VALUES($id_nota,$id_utente)";
	$result=$db->queryInsert($query);
   
	header("Location: nota_show.php?id_nota=$id_nota");
	
}else {
	$id_nota=$_POST['id_nota'];
	
	
	$query="UPDATE nota SET testo='$testo',  data_ins=NOW(), private=$private WHERE id_nota=$id_nota";
	$result=$db->queryInsert($query);
	
	
	
	header("Location: nota_show.php?id_nota=$id_nota");
}

?>
