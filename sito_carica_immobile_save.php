<?php
include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");


/**
 * dati di connessione
 */
set_time_limit(0);

$remote_ip="immobiliarerinaldelli.com";
$remote_port="21";
$remote_user="immobili";
$remote_pass="immo_192.5";
$remote_directoryFoto="/public_html/img_up";

/// cancellare in produzione
  /*
$remote_ip="127.0.0.1";
$remote_port="21";
$remote_user="vittorio";
$remote_pass="vittorio";

$remote_directoryFoto="/img_up";
 */

/**
 * sempre settati xche passati corretti dalla pagina precedente
 */

$id_imm = $_POST['id_imm'];


/**
 * fine sempre settati xche passati corretti dalla pagina precedente
 */

/**
 * stringhe
 */
//$via = sistemaTesto($_POST['via']);
$note=  sistemaTesto($_POST['note']);



$arr_id_img=$_POST['id_img'];



$stream = ftp_connect($remote_ip, $remote_port);
 
$login = ftp_login($stream, $remote_user, $remote_pass);
  
ftp_pasv($stream, true); 
 
/*if ((!$stream) || (!$login)) {*/
if (!$login) {
		echo "<html><head></head><body><script>";
		echo "alert(\"Connessione al server remoto fallita! riprovare pi� tardi\");";
		echo "location.href=\"sito_immobili.php\";\n";

		echo "</script></body></html>";
		exit;
}else{

	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);

	$query="DELETE FROM imm_img WHERE id_imm=$id_imm";
	$result=$dbSito->queryDelete($query);
	ftp_chdir($stream, $remote_directoryFoto); // imposto la directory remota dove caricare le foto
	
	for ($i=0; $i<count($arr_id_img); $i++){
	
		$id_img=$arr_id_img[$i];
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
		$query="SELECT * FROM immagine WHERE id_img=$id_img";
		$result=$db->query($query);
		$row=mysql_fetch_array($result);

		/**
		 * carico le miniature
		*/

		//$path_locale_low=str_replace("_M","_sito_low",$row['med_res']);

                $path_locale_low=$row['med_res'];
		$path_remoto_low=str_replace("immobili/$id_imm","",$path_locale_low);
		$path_remoto_low=str_replace("_sito_low","_L",$path_remoto_low);
//echo $path_locale_low . " <br>";
//echo $path_remoto_low. "<br>";
		$path_low = str_replace("./immobili/$id_imm","./img_up",$path_locale_low);
		$path_low = str_replace("_sito_low","_L",$path_low);
//echo $path_low ."<br>";
 
		if (!ftp_put($stream,$path_remoto_low,$path_locale_low,FTP_BINARY)) {
			//echo $path_remoto_low ." Non Caricato<br/><br/>";
		}else{
			//echo $path_remoto_low ." Non Caricato<br/><br/>";
			}
		
		// carico gli ingrandimenti

	//	$path_locale_high=str_replace("_M","_sito_high",$row['med_res']);
                $path_locale_high=$row['high_res'];
                
               // echo $path_locale_high; exit;


		$path_remoto_high=str_replace("immobili/$id_imm","",$path_locale_high);
		$path_remoto_high=str_replace("_sito_high","_H",$path_remoto_high);
                
		$path_high = str_replace("./immobili/$id_imm","./img_up",$path_locale_high);
		$path_high = str_replace("_sito_high","_H",$path_high);


		if (!ftp_put($stream,$path_remoto_high,$path_locale_high,FTP_BINARY)) {
			//echo $path_locale_high ." Non Caricato<br/><br/>";
		}

 

		$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);

		/**
		 * cancello le possibili presenze nel db
		 */
		$query="DELETE FROM img WHERE id_img=$id_img";
		$result=$dbSito->queryDelete($query);



		/**
		 * reinsiresco i vari collegamenti
		 */


    $primaria= "null";
    /*
    echo $_POST["primaria"];
    echo " - ";
    echo $id_img;
    echo "<br>";
    */
    if($_POST["primaria"]==$id_img){
      $primaria=1;
    }
    

		$query="INSERT INTO img VALUES($id_img,'$path_low','$path_high',null,$primaria)";
		//echo $query ."<br>";
		$result=$dbSito->queryInsert($query);

		$query="INSERT INTO imm_img VALUES($id_imm,$id_img)";
		$result=$dbSito->queryInsert($query);


	}


}











if ($_POST['id_tipo_locazione']!="") {
	$id_tipo_locazione = "'".$_POST['id_tipo_locazione']."'";

}
else {
	$id_tipo_locazione = 'null';
}

if ($_POST['mq']!="") {
	$mq = "'".$_POST['mq']."'";

}
else {
	$mq = '0';
}


if ($_POST['prezzo']!="") {
	$prezzo ="'".$_POST['prezzo']."'";

}
else {
	$prezzo = 'null';
}

if ($_POST['new_tipo_immobile']!="") {
	$id_tipo_immobile = inserisci_tipo_immobile_web($_POST['new_tipo_immobile']);

}
else {
	if ($_POST['id_tipo_immobile']!="") {
		$id_tipo_immobile=check_tipo_immobile_web($_POST['id_tipo_immobile']);
		$id_tipo_immobile ="'".$id_tipo_immobile."'";


	}
	else {
		$id_tipo_immobile = 'null';
	}


}

if ($_POST['new_provincia']!="") {
	$id_provincia = inserisci_provincia_web($_POST['new_provincia']);

}
else {
	if ($_POST['id_provincia']!="") {
		$id_provincia=check_provincia_web($_POST['id_provincia']);
		$id_provincia ="'".$id_provincia."'";


	}
	else {
		$id_provincia = 'null';
	}

}

if ($_POST['new_citta']!="") {
	$id_citta = inserisci_citta_web($_POST['new_citta']);

}
else {

	if ($_POST['id_citta']!="") {
		$id_citta=check_comune_web($_POST['id_citta']);
		$id_citta ="'".$id_citta."'";


	}
	else {
		$id_citta = 'null';
	}

}

if ($_POST['new_zona']!="") {
	$id_zona = inserisci_zona_web($_POST['new_zona']);

}
else {

	if ($_POST['id_zona']!="") {
		// qui devo controllare se esiste nella tabella corrispettiva il dato altrimenti lo inserisco
		$id_zona=check_zona_web($_POST['id_zona']);
		$id_zona ="'".$id_zona."'";

	}
	else {
		$id_zona = 'null';
	}

}
$home=1;
$tipo_vetrina=1;



if ($_POST['classe_en']!="") {
	$classe_en = "'".$_POST['classe_en']."'";

}
else {
	$classe_en = 'In fase di richiesta';
}



if ($_POST['spese_cond']!="") {
	$spese_cond = "'".$_POST['spese_cond']."'";

}
else {
	$spese_cond = '0';
}


if ($_POST['vani']!="") {
	$vani = "'".$_POST['vani']."'";

}
else {
	$vani = '0';
}











if ($_POST['azione']=="mod") {

	/**
	 * creo la cartella
	 *
	 * se la cartella non viene creata correttamente non faccio inserire i dati ma rimando all'inserimento e mostro
	 * un alert di errore
	 */
	$data_ins = date("Y-m-d");

	/**
	 * prima cancello quello remoto
	 */
	$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
	$query="DELETE FROM immobile WHERE id_imm =$id_imm";
	$result=$dbSito->queryDelete($query);

	/**
	 * poi salvo quello locale
	 */
  
	$query="INSERT INTO `immobile`

	VALUES (
	'$id_imm', $id_citta , $id_provincia , $id_tipo_immobile, $mq, $id_tipo_locazione, '$note', $prezzo, $home, $tipo_vetrina,
	NOW(), NOW(), '$_SESSION[id_utente]', '',$id_zona,$classe_en,$spese_cond,$vani)";



	$result=$dbSito->queryInsert($query);



	echo "<SCRIPT>";
	echo "location.href=\"sito_immobili.php\"";
	echo "</SCRIPT>";
	exit;

}

?>


