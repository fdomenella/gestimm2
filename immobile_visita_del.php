<?php
include("./framework/framework.php");
$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
//$con = mysql_connect("localhost","root","password");
//$db = mysql_select_db("gestimm2",$con);
if($_GET)
{
        if(isset($_GET['method']))
	$method = $_GET['method'];
    else {
        $method="";
    }
        $id_visita=$_GET['id_visita'];
        if($method == 'addnotes')
        {
              
        }
        if($method == 'delnotes')
        {
                $id_visita = $_GET['id_visita'];
                
                $status = visita_del($id_visita);
                if($status == 'success')
                        $output = array('status'=>'success');
                else
                        $output = array('status'=>'error');	
                echo json_encode($output);
        }

}



function visita_del($id_visita)
{
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="delete from immobile_visite where id_visita='$id_visita'";
	$delete = $db->queryInsert($query);
	if($delete)
	return 'success';
}


?>