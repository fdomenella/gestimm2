<?php
include_once("./framework/framework.php");


if (isset($_GET['id_doc'])) {
	$id_doc = $_GET['id_doc'];
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
<title>Cancella Documento</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Cancella Documento $id_doc";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di voler Cancellare il documento?\n";
			$str.="<br><br>";
			$str.="<a href=\"documento_del.php?azione=del&id_imm=$id_imm&id_doc=";
			$str.= $id_doc;
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
	$query="SELECT path FROM documento WHERE id_doc= $_GET[id_doc]";
	$result=$db->query($query);
	$ro=mysql_fetch_array($result);
	
	$path_doc= $ro['path'];
	
	$query="delete from documento where id_doc = $_GET[id_doc]";
	$result=$db->queryDelete($query);
	
	/**
	 * cancello fisicamente il file
	 */
	
		
	
	if (!file_exists($path_doc)) {
		echo "<SCRIPT>\n\n";
		echo "alert(\"Impossibile trovare il file da cancellare. Se l'errore persiste contattare l'amministratore\");\n";
		echo "window.opener.location.href=\"documento_gest.php?id_imm=$id_imm\"\n";
		echo "self.close();";
		echo "</SCRIPT>";		
		

	} else {
		if (!unlink($path_doc)) {
			echo "<SCRIPT>\n\n";
			echo "alert(\"Impossibile Cancellare il file. Se l'errore persiste contattare l'amministratore\");\n";
			echo "window.opener.location.href=\"documento_gest.php?id_imm=$id_imm\"\n";
			echo "self.close();";
			echo "</SCRIPT>";
			

			
		} 
	}

		
	$query="delete from imm_doc where id_doc = $_GET[id_doc]";
	$result=$db->queryDelete($query);
		echo "<SCRIPT>\n\n";
		echo "alert(\"File Cancellato correttamente. Clicca ok per proseguire\");\n";
		echo "window.opener.location.href=\"documento_gest.php?id_imm=$id_imm\";\n";
		echo "self.close();";
		echo "</SCRIPT>";

	
		
}
else{
	echo $str;
}
?>

</body>

</html>
