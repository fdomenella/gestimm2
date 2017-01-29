<?php
include_once("./framework/framework.php");


if (isset($_GET['id_imm'])) {
	
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
<title>Cancella Immobile</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Cancella Immobile $id_imm";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di voler Cancellare l'immobile e tutti i suoi documenti?\n";
			$str.="<br><br>";
			$str.="<a href=\"immobile_del.php?azione=del&id_imm=$id_imm\">";
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
	$id_imm =$_GET['id_imm'];
	/**
	 * rimuovo tutti i file dell'immobile
	 */
	remove_dir("./immobili/$id_imm");
	
	/**
	 * recupero le foto associate all'immobile
	 */
	
	$query="SELECT * FROM imm_img WHERE id_imm =$id_imm";
	$result=$db->query($query);
	
	/**
	 * cancello i dati in immagine
	 */
	if ($result) {
		while ($row=mysql_fetch_array($result)) {
			$id_img=$row['id_img'];
			$q="DELETE FROM immagine WHERE id_img=$id_img";
			$db->queryDelete($q);
		}
	}
	
	
	
	/**
	 * cancello i dati in imm_img
	 */
	$query="DELETE FROM imm_img WHERE id_imm = $id_imm";
	$db->queryDelete($query);
	
	/**
	 * recupero i documenti
	 */
	
	$query="SELECT * FROM imm_doc WHERE id_imm =$id_imm";
	$result=$db->query($query);
	
	/**
	 * cancello i dati in documenti
	 */
	if ($result) {
		while ($row=mysql_fetch_array($result)) {
			$q="DELETE FROM documento WHERE id_doc=$row[id_doc]";
			$r=$db->queryDelete($q);
		}
	}
	
	
	/**
	 * cancello i dati imm_doc
	 */
	$query="DELETE FROM imm_doc WHERE id_imm = $id_imm";
	$result=$db->queryDelete($query);
	
	
	/**
	 * cancello l'associazione col cliente in cli_imm
	 */
	
	
	
	$query="delete from immobile where id_imm = $id_imm";
	$result=$db->queryDelete($query);
	
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Immobile Cancellato correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"index.php\";\n";
	echo "self.close();";
	echo "</SCRIPT>";

	
	
	
}
else{
	echo $str;
}
?>

</body>

</html>
