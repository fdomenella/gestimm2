<?php
include_once("./framework/framework.php");


if (isset($_GET['id_app'])) {
	
	$id_app= $_GET['id_app'];
}
else {
	echo "<script> window.close(); </script>";
	exit;
}





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Cancella Appuntamento</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Cancella appuntamento $id_app";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di voler Cancellare l'appuntamento ?\n";
			$str.="<br><br>";
			$str.="<a href=\"calendar_del_event.php?azione=del&id_app=$id_app\">";
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
	$id_app =$_GET['id_app'];
	
	$q="DELETE FROM cal_appuntamento WHERE id_app=$id_app";
	$db->queryDelete($q);
	
	
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Appuntamento cancellato correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"index.php\";\n";
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
