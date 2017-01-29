<?php
include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");
$layout = new Layout("");

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
<title>immobili in home</title>

<link rel="stylesheet" type="text/css" href="areariservata.css">
</head>

<body>

<?php
if ($_GET['azione']=="rimuovi") {
		
$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$query="UPDATE immobile SET home = 0 WHERE id_imm=$id_imm";
	$result=$db->queryInsert($query);
	echo "ATTENDERE LA CHIUSURA DELLA PAGINA";
	echo "<SCRIPT>\n\n";
	echo "alert(\"Immobile rimosso dalla homepage correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"sito_home.php\";\n";
	echo "self.close();";
	echo "</SCRIPT>";
}
if ($_GET['azione']=="aggiungi") {
		
$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$query="UPDATE immobile SET home = 1 WHERE id_imm=$id_imm";
	$result=$db->queryInsert($query);
	echo "ATTENDERE LA CHIUSURA DELLA PAGINA";
	echo "<SCRIPT>\n\n";
	echo "alert(\"Immobile aggiunto alla homepage correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"sito_home.php\";\n";
	echo "self.close();";
	echo "</SCRIPT>";
}

?>

</body>

</html>
