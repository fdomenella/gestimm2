<?php
include_once("./framework/framework.php");


if (isset($_GET['id_img'])) {
	$id_img = $_GET['id_img'];
	$id_imm = $_GET['id_imm'];
}
else {
	echo "<script> window.close(); </script>";
	exit;
}





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Cancella Foto</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Cancella Immagine $id_img";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
			$str.= "<TD class=\"foto_gest_header\">\n";
			$str.= immagine_stampa_low($id_img);
			$str.= "</TD>\n";
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di volerla cancellare?\n";
			$str.="<br><br>";
			$str.="<a href=\"immagine_del.php?azione=del&id_imm=$id_imm&id_img=";
			$str.= $id_img;
			$str.="\">";
			$str.= "-> Si";
			$str.="</a>";
			$str.="<br><br>";
			$str.="<a href=\"#\" onclick=\"window.close();\">";
			$str.="-> No";
			$str.="</a>";
			$str.= "</TD>\n";
	
			$str.= "</TR>\n";
		
		$str.= "</TABLE>";
		
		$str.="</div>";



?>
<body>
<?php
if ($_GET['azione']=="del") {
	/**
	 * recupero il percorso del file
	 */
	$query="SELECT * FROM immagine WHERE id_img= $_GET[id_img]";
	$result=$db->query($query);
	$ro=mysql_fetch_array($result);
	
	$path_high= $ro['high_res'];
	$path_med = $ro['med_res'];
	$path_low = $ro['low_res'];
	
	
	$query="delete from immagine where id_img = $_GET[id_img]";
	$result=$db->queryDelete($query);
	/**
	 * cancello fisicamente il file
	 */
	
		
	
	if (!file_exists($path_high)) {
		echo "<SCRIPT>\n\n";
		echo "alert(\"Impossibile trovare l'immagine ad alta risoluzione da cancellare. Se l'errore persiste contattare l'amministratore\");\n";
		echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\"\n";
		echo "self.close();";
		echo "</SCRIPT>";		
		

	} else {
		if (!unlink($path_high)) {
			echo "<SCRIPT>\n\n";
			echo "alert(\"Impossibile Cancellare l'immagine ad alta risoluzione. Se l'errore persiste contattare l'amministratore\");\n";
			echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\"\n";
			echo "self.close();";
			echo "</SCRIPT>";
		} 
	}
		if (!file_exists($path_med)) {
		echo "<SCRIPT>\n\n";
		echo "alert(\"Impossibile trovare l'immagine a media risoluzione da cancellare. Se l'errore persiste contattare l'amministratore\");\n";
		echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\"\n";
		echo "self.close();";
		echo "</SCRIPT>";		
		

	} else {
		if (!unlink($path_med)) {
			echo "<SCRIPT>\n\n";
			echo "alert(\"Impossibile Cancellare l'immagine a media risoluzione. Se l'errore persiste contattare l'amministratore\");\n";
			echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\"\n";
			echo "self.close();";
			echo "</SCRIPT>";
		} 
	}
		if (!file_exists($path_low)) {
		echo "<SCRIPT>\n\n";
		echo "alert(\"Impossibile trovare l'immagine a bassa risoluzione da cancellare. Se l'errore persiste contattare l'amministratore\");\n";
		echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\"\n";
		echo "self.close();";
		echo "</SCRIPT>";		
		

	} else {
		if (!unlink($path_low)) {
			echo "<SCRIPT>\n\n";
			echo "alert(\"Impossibile Cancellare l'immagine a bassa risoluzione. Se l'errore persiste contattare l'amministratore\");\n";
			echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\"\n";
			echo "self.close();";
			echo "</SCRIPT>";
		} 
	}
	
	$query="delete from imm_img where id_img = $_GET[id_img]";
	$result=$db->queryDelete($query);
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Immagine Cancellato correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"immagine_gest.php?id_imm=$id_imm\";\n";
	echo "self.close();";
	echo "</SCRIPT>";
	

}
else{
	echo $str;
}
?>

</body>

</html>
