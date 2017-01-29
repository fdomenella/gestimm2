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
<title>Ripristina Immobile</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Ripristina Immobile $id_imm";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di archiviare l'immobile?\n";
			$str.="<br><br>";
			$str.="<a href=\"immobile_ripristina.php?azione=rip&id_imm=$id_imm";
			
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
if ($_GET['azione']=="rip") {
	/**
	 * recupero il percorso del file
	 */
	$query="UPDATE immobile set archiviato=null where id_imm=".$_GET['id_imm'];
	$result=$db->query($query);
	$ro=mysql_fetch_array($result);
	

	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Immobile ripristinato correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"immobile_show.php?id_imm=$id_imm\";\n";
	echo "self.close();";
	echo "</SCRIPT>";
	

}
else{
	echo $str;
}
?>

</body>

</html>
