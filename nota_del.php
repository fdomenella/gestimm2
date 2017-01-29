<?php
include_once("./framework/framework.php");


if (isset($_GET['id_nota'])) {
	
	$id_nota= $_GET['id_nota'];
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
		$str.="Cancella nota $id_nota";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di voler Cancellare la nota ?\n";
			$str.="<br><br>";
			$str.="<a href=\"nota_del.php?azione=del&id_nota=$id_nota\">";
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
	$id_nota =$_GET['id_nota'];
	
	$q="DELETE FROM nota WHERE id_nota=$id_nota";
	$db->queryDelete($q);
	
	
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Nota Cancellata correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"nota_index.php\";\n";
	echo "self.close();";
	echo "</SCRIPT>";

	
	
	
}
else{
	echo $_GET['azione'];
	echo $str;
}
?>

</body>

</html>
