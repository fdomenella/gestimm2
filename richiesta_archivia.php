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
<title>Archivia Richiesta</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Archivia richiesta $id_iric";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di archiviare la richiesta?\n";
			$str.="<br><br>";
			$str.="<a href=\"richiesta_archivia.php?azione=arc&id_ric=$id_ric";
			
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
if ($_GET['azione']=="arc") {
	/**
	 * recupero il percorso del file
	 */
	$query="UPDATE richiesta set archiviato=1 where id_ric=".$_GET['id_ric'];
	$result=$db->query($query);
	$ro=mysql_fetch_array($result);
	

	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Richiesta archiviata correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"richiesta_show.php?id_ric=$id_ric\";\n";
	echo "self.close();";
	echo "</SCRIPT>";
	

}
else{
	echo $str;
}
?>

</body>

</html>
