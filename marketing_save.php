<?php
include_once("./framework/framework.php");


$nominativo= ucfirst(sistemaTesto($_POST['nominativo']));
$nota= ucfirst(sistemaTesto($_POST['nota']));

if ($_POST['azione']=="add") {
		
	
	$data_ins = date("d-m-y");
	$query="INSERT INTO marketing 
		    VALUES (
		    NULL , '$nominativo','$nota')";
	$result=$db->queryInsert($query);
	$id_mrk = mysql_insert_id();

	
}else {
	
	$id_mrk=$_POST['id_mrk'];
	
	$query="UPDATE marketing SET 
	nome='$nominativo'
	,note='$nota'
	WHERE id_mrk = $id_mrk";
	$result=$db->queryInsert($query);

}


echo "<html>
<body><SCRIPT>";
	echo "location.href=\"marketing_show.php?id_mrk=$id_mrk\";";
	
	echo "</SCRIPT></body></html>";
	exit;
?>
