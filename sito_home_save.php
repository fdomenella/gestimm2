<?php
include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");
$layout = new Layout("");







?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>immobili in home</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>

<body>

<?php

$vetrina2_0=$_POST['vetrina2_0'];
$vetrina2_1=$_POST['vetrina2_1'];

$vetrina2 = array();
$vetrina2[0] = $vetrina2_0;
$vetrina2[1] = $vetrina2_1;

$vetrina1 = array();
for($i=0;$i<6; $i++){
$vetrina1[$i]=$_POST['vetrina1_'.$i];


}
echo "<pre>";
print_r($vetrina1);

print_r($vetrina2);

echo "</pre>";




//verifico che i tipo_vetrina=2 non siano anche in tipo_vetrina=1

if(in_array($vetrina2_0,$vetrina1) OR in_array($vetrina2_1,$vetrina1)){
	echo "un immobile nn può essere sia in vetrina 1 e 2";

}
$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);


//resetto la home

$query="UPDATE immobile SET tipo_vetrina = 0 ";
$result=$dbSito->queryInsert($query);





//setto la tipo_vetrina =1
function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}
for($i=0; $i<6; $i++){

	if(IsNullOrEmptyString($vetrina1[$i])){

	}else{
		$query="UPDATE immobile SET tipo_vetrina = 1 WHERE id_imm = " . $vetrina1[$i];
		
		$result=$dbSito->queryInsert($query);
	}
}

//setto la tipo_vetrina = 2

for($i=0; $i<2; $i++){
	if(IsNullOrEmptyString($vetrina2[$i])){

	}else{
		$query="UPDATE immobile SET tipo_vetrina = 2 WHERE id_imm = " . $vetrina2[$i];
		$result=$dbSito->queryInsert($query);
	}
}


header("Location: sito_home.php");





	echo "ATTENDERE LA CHIUSURA DELLA PAGINA";
	echo "<SCRIPT>\n\n";
	echo "alert(\"Immobile aggiunto nel box Verde. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"sito_home.php\";\n";
	echo "self.close();";
	echo "</SCRIPT>";

?>

</body>

</html>
