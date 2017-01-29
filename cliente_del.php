<?php
include_once("./framework/framework.php");


if (isset($_GET['id_cli'])) {
	
	$id_cli = $_GET['id_cli'];
}
else {
	echo "<script> window.close(); </script>";
	exit;
}





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Cancella Cliente</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<?php
$str="";
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Cancella Cliente: ".nominativo_stampa($id_cli);
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		
			$str.= " <TD class=\"foto_opzioni\">\n";
			$str.= "Sei sicuro di voler Cancellare l'immobile e tutti i suoi documenti?\n";
			$str.="<br><br>";
			$str.="<a href=\"cliente_del.php?azione=del&id_cli=$id_cli\">";
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
	$id_cli =$_GET['id_cli'];

	
		
	/**
	 * cancello l'associazione col cliente in cli_imm
	 */
	
	
	
	$query="delete from cli_imm where id_cli=$id_cli";
	$result=$db->queryDelete($query);
	$query="delete from cliente where id_cli=$id_cli";
	$result=$db->queryDelete($query);
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Cliente Cancellato correttamente. Clicca ok per proseguire\");\n";
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
