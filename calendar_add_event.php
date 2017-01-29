<?php

include_once("./framework/framework.php");

$layout = new Layout("");

if(!isset($_GET['id_app'])){
  $gg=$_GET['gg'];
  $mm=$_GET['mm'];
  $yyyy=$_GET['yyyy'];
  
  $azione=$_GET['azione'];
  if(isset($_GET['id_app'])){
  
    $id_app=$_GET['id_app'];
  }
  else{
    $id_app="";
    $azione=$_GET['azione'];
  }
}
else{
$id_app=$_GET['id_app'];
$azione=$_GET['azione'];
}



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Aggiungi evento</title>

<link rel="stylesheet" type="text/css" href="gestimm2_.css">
</head>
<body>

<?php
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	
	if ($azione=="mod") {
		
		$q_mod="SELECT * FROM cal_appuntamento WHERE id_app = $_GET[id_app]";
		$r_mod=$db->query($q_mod);
		$ro_mod=mysql_fetch_array($r_mod);
	}	
	$str.= "<div class=\"clienti\">\n";
	$str.="<form name=\"mainForm\" method=\"POST\" action=\"calendar_add_event_save.php\" >\n";
  $str.="<input type=\"hidden\" name=\"id_app\" value=\"";
	$str.= $id_app;
	$str.= "\">\n";
	
	
	$str.="<input type=\"hidden\" name=\"azione\" value=\"";
	$str.= $azione;
	$str.= "\">\n";
	$str.= "<TABLE id=\"clienti\">\n";
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Cliente:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_cli\">\n";
		$str.="<option value=\"\">Scegli</option>\n";
		$q_tipi="SELECT * FROM tipo_cliente";
		$r_tipi=$db->query($q_tipi);
		$i=1;
			
		while ($ro_tipi=mysql_fetch_array($r_tipi)) {
			
			$str.="<optgroup class=\"opt$i\" label=\"";
			$str.=$ro_tipi['nome'];
			$str.="\">";
			$i++;
			$q = "SELECT * FROM cliente WHERE id_tipo_cliente=$ro_tipi[id_tipo_cliente]";	
			$r = $db->query($q);
			if($r){
				while($ro = mysql_fetch_array($r)){
					if ($azione=="mod" AND $ro['id_cli']==$ro_mod['id_cli']) {
						$sel="Selected";
					}
					else {
						$sel=" ";
					}
				
				$str.="<option $sel value=\"";
				$str.= $ro['id_cli'];
				$str.="\">";
				$str.= $ro['nominativo'];
				$str.="</option>\n";
				}	
			}
		$str.="</optgroup>";	
		}
		
		$str.="</select>\n";
	
	
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Immobile:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_imm\">\n";
		
		$q = "SELECT * FROM immobile ";	
		$r = $db->query($q);
		if($r){
			while($ro = mysql_fetch_array($r)){
  			if($ro['id_imm']==$ro_mod['id_imm']){
          $sel = "selected";
        }else{
          $sel ="";
        }
  			$str.="<option $sel value=\"";
  			$str.= $ro['id_imm'];
  			$str.="\">";
  			$str.= $ro['id_imm'];
  			$str.="</option>\n";
			}
    }	
		
		$str.="</select>\n";
	
	
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "<TR>\n";
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "data:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input class=\"\" type=\"text\" name=\"gg\" value=\"";
	if($azione=="mod"){
    $gg=$ro_mod['gg'];
  }
  $str.= $gg;
  $str.="\" size=\"2\"/>";
	$str.= "/";
	$str.= "<input class=\"\" type=\"text\" name=\"mm\" value=\"";
	if($azione=="mod"){
    $mm=$ro_mod['mm'];
  }
  $str.=$mm;
  $str.="\" size=\"2\"/>";
	$str.= "/";
	$str.= "<input class=\"\" type=\"text\" name=\"yyyy\" value=\"";
	if($azione=="mod"){
    $yyyy=$ro_mod['yyyy'];
  }
  $str.=$yyyy;
  $str.="\" size=\"4\"/>";
	$str.= " formato: gg/mm/yyyy";
	$str.= "</TD>";
	$str.= "</TR>";
	
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Ora Inizio:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input class=\"\" type=\"text\" name=\"ora_inizio\" value=\"";
	if ($azione=="mod") {
	 $str.=$ro_mod['ora_inizio'];
	}
	else {
		
	}
	$str.="\" size=\"10\"/> formato: hh:mm\n";
	$str.= "</TD>";
	$str.= "</TR>";

	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Ora Fine:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input class=\"\" type=\"text\" name=\"ora_fine\" value=\"";
	if ($azione=="mod") {
	 $str.=$ro_mod['ora_fine'];
	}
	else {
		
	}

	$str.="\" size=\"10\"/> formato: hh:mm\n";
	$str.= "</TD>";
	$str.= "</TR>";
	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Luogo:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<input class=\"\" type=\"text\" name=\"luogo\" value=\"";
	if ($azione=="mod") {
	 $str.=$ro_mod['luogo'];
	}
	else {
		
	}
	$str.="\" /> \n";
	$str.= "</TD>";
	$str.= "</TR>";

	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Assegnato a:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"id_user\">\n"; 
/*
$q = "SELECT * FROM immobile ";	
		$r = $db->query($q);
		if($r){
			while($ro = mysql_fetch_array($r)){
  			if($ro['id_imm']==$ro_mod['id_imm']){
          $sel = "selected";
        }else{
          $sel ="";
        }
  			$str.="<option $sel value=\"";
  			$str.= $ro['id_imm'];
  			$str.="\">";
  			$str.= $ro['id_imm'];
  			$str.="</option>\n";
			}
    }	
*/	
  	$str.="<option ";
    if($ro_mod['id_user']==1){
      $str.="selected";
    }
    
    $str.=" value=\"1\">Vittorio</option>\n";
  	$str.="<option ";
     if($ro_mod['id_user']==3){
      $str.="selected";
    }
    $str.=" value=\"3\">Katiuscia</option>\n";	
	$str.="</select>\n";
	
	
	$str.= "</TD>";
	$str.= "</TR>";


	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Privato:\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.="<select size=\"1\" name=\"privato\">\n";
	$str.="<option ";
   if($ro_mod['privato']==0){
      $str.="selected";
    }
  $str.=" value=\"0\">Pubblico</option>\n";
	$str.="<option ";
   if($ro_mod['privato']==1){
      $str.="selected";
    }
  $str.=" value=\"1\">Privato</option>\n";	
	$str.="</select>\n";
	
	
	$str.= "</TD>";
	$str.= "</TR>";



	
	$str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Note\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<textarea cols=\"80\" rows=\"10\" name=\"note\">\n";
	if ($azione=="mod") {
		$str.=$ro_mod['note'];
	}
	$str.="</textarea>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";


  $str.= "<TR>\n";
	$str.= "<TD class=\"clienti_show_header\">\n";
	$str.= "Esito\n";
	$str.= "</TD>\n";
	$str.= " <TD class=\"clienti_show\">\n";
	$str.= "<textarea cols=\"80\" rows=\"10\" name=\"esito\">\n";
	if ($azione=="mod") {
		$str.=$ro_mod['esito'];
	}
	$str.="</textarea>\n";
	$str.= "</TD>\n";
	$str.= "</TR>\n";


	$str.= "<TR>";
	$str.= "<TD colspan=\"2\"  align=\"center\">";
	$str.= "<input type=\"submit\" value=\"Submit\" class=\"buttonSubmit\" />";
	$str.= "</TD>";
	$str.= "</TR>";
	$str.= "</TABLE>";
	$str.="</form>";
	$str.="</div>";

	echo $str;

?>
</body>

</html>
