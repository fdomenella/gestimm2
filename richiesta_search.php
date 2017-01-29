<?php
include_once("./framework/framework.php");

//creazione di un array vuoto
$return_arr[] = array();



//definisco la variabile di ricerca dell'utente
$term = $_GET["term"];

//se connesso
//$query="SELECT * FROM cliente WHERE MATCH(nominativo) AGAINST('".$term."*')";
$query ="SELECT id_ric FROM richiesta WHERE id_ric LIKE '%".$term."%'";
$result=$db->query($query);


//loop dei dati
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $row_array[] = array();
$row_array['value'] = $row['id_ric'];
$row_array['id']=$row['id_ric'];
array_push($return_arr,$row_array);
//array_push($return_arr,$row_array);
}
//restituisco l'array in formato json
echo json_encode($return_arr);

?>