<?php

include_once("./framework/framework.php");


if (isset($_GET['id_ric'])) {
	
	$id_ric = $_GET['id_ric'];
}
else {
	echo "<script> window.close(); </script>";
	exit;
}





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Cancella Richiesta</title>

<link rel="stylesheet" type="text/css" href="gestimm2.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Cancella Richiesta $id_ric";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di voler Cancellare la richiesta?\n";
			$str.="<br><br>";
			$str.="<a href=\"richiesta_del.php?azione=del&id_ric=$id_ric\">";
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
	
	
	
	
	$query="delete from richiesta where id_ric = $id_ric";
	$result=$db->queryDelete($query);
	$query="delete from cli_ric where id_ric = $id_ric";
	$result=$db->queryDelete($query);
	$query="delete from ric_tipo_imm where id_ric = $id_ric";
	$result=$db->queryDelete($query);
	
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Richiesta Cancellata correttamente. Clicca ok per proseguire\");\n";
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
