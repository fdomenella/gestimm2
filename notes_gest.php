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
        $id_imm=$_GET['id_imm'];
        if($method == 'addnotes')
        {
                $data = $_GET['data'];
                $status = addnotes($data,$id_imm);
                if($status != '')
                        $output = array('status'=>'success','id'=>$status);
                else
                        $output = array('status'=>'error');	
                echo json_encode($output);
        }
        if($method == 'delnotes')
        {
                $id = $_GET['id'];
                
                $status = delnotes($id);
                if($status == 'success')
                        $output = array('status'=>'success');
                else
                        $output = array('status'=>'error');	
                echo json_encode($output);
        }

}

function addnotes($data,$id_imm)
{
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $date_time = date('d/m/Y', time());
    $id_autore=$_SESSION["id_utente"];
    $query="insert into notes(descrizione,id_imm,autore,data) values('$data',$id_imm,$id_autore,'$date_time')";
    $insert = $db->queryInsert($query);
    if($insert)
    return mysql_insert_id();
}

function delnotes($id)
{
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="delete from notes where id='$id'";
	$delete = $db->queryInsert($query);
	if($delete)
	return 'success';
}

function loadnotes($id_imm)
{       
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="select * from notes where id_imm=$id_imm order by id desc";
      $result=$db->query($query);
	
	
	while($fetch = mysql_fetch_array($result))
	{
echo '<li id="'.$fetch['id'].'" > ';
echo "<strong>chi " . idUtenteToNome($fetch['autore']);
echo " ";
echo "data: " .$fetch['data'];
echo " </strong><br>";
echo $fetch['descrizione'];
if($fetch['autore']==$_SESSION["id_utente"])
echo '<a href="#"class="event-close"> &#10005; </a>';
echo '</li>';
	
	}
}
?>