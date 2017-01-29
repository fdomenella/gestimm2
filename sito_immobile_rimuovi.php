<?php
include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");
$layout = new Layout("");


$id_imm=$_GET['id_imm'];
echo $id_imm; exit;
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>immobili rimuovi</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>

<body>

<?php

	
$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$query="DELETE FROM imm_img WHERE id_imm = $id_imm";
	$result=$dbSito->queryInsert($query);
	$query="DELETE FROM immobile WHERE id_imm=$id_imm";
	$result=$dbSito->queryInsert($query);
	header("location: sito_immobili.php");
?>

</body>

</html>
