<?php
include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");


/**
 * dati di connessione
 */
set_time_limit(0);

//$remote_ip="93.95.218.14";
$remote_ip="immobiliarerinaldelli.com";
$remote_port="21";
$remote_user="immobili";
$remote_pass="immo_192.5";
$remote_directoryFoto="/public_html/img_up";





$stream = ftp_connect($remote_ip, $remote_port);
 
$login = ftp_login($stream, $remote_user, $remote_pass);
  
ftp_pasv($stream, true); 
 
/*if ((!$stream) || (!$login)) {*/
if (!$login) {
		echo "<html><head></head><body><script>";
		echo "alert(\"Connessione al server remoto fallita! riprovare più tardi\");";
		echo "location.href=\"sito_immobili.php\";\n";

		echo "</script></body></html>";
		exit;
}  else{

echo "ok";
}

?>