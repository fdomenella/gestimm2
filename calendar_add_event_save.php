<?php
include_once("./framework/framework.php");

   
$azione=$_POST['azione'];
$id_app=$_POST['id_app'];
error_log("id_app: ".$id_app);
$id_cli = $_POST['id_cli'];
$id_imm = $_POST['id_imm'];
$gg = sistemaTesto($_POST['gg']);
$mm = sistemaTesto($_POST['mm']);
$yyyy = sistemaTesto($_POST['yyyy']);
$ora_inizio = sistemaTesto($_POST['ora_inizio']);
$ora_fine = sistemaTesto($_POST['ora_fine']);
$luogo =sistemaTesto($_POST['luogo']);
$id_user= $_POST['id_user'];
$privato=$_POST['privato'];


$note = sistemaTesto($_POST['note']);
$esito = sistemaTesto($_POST['esito']);
if ($azione=="add") {

	
    
    //salvo i dati nel db
    $query="INSERT INTO cal_appuntamento VALUES(null,$id_user,'$note',$gg,$mm,$yyyy,'$ora_inizio','$ora_fine',$privato,$_SESSION[id_utente],'$luogo',$id_imm,'$esito',$id_cli)";
    $result=$db->queryInsert($query);
    
	
		echo "<SCRIPT>\n\n";
    //echo "alert(\"Immobile Cancellato correttamente. Clicca ok per proseguire\");\n";
    echo "window.opener.location.href=\"index.php\";\n";
    echo "self.close();";
    echo "</SCRIPT>";
    exit;
	
}else {
	$id_app=$_POST['id_app'];
	
	
	$query="UPDATE cal_appuntamento SET
   id_user=$id_user,
   note='$note',
   gg=$gg,
   mm=$mm,
   yyyy=$yyyy,
   ora_inizio='$ora_inizio',
   ora_fine='$ora_fine',
   privato=$privato,
   inserito_da=$_SESSION[id_utente],
   luogo='$luogo',
   id_imm=$id_imm,
   esito='$esito',
   id_cli=$id_cli
   WHERE id_app=$id_app";
	$result=$db->queryInsert($query);
	
		echo "<SCRIPT>\n\n";
    //echo "alert(\"Immobile Cancellato correttamente. Clicca ok per proseguire\");\n";
    echo "window.opener.location.href=\"index.php\";\n";
    echo "self.close();";
    echo "</SCRIPT>";
    exit;
}

?>
