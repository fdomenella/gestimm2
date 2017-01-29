<?php


set_time_limit(0);

$percorso_locale="immobili/4/";

$foto="4-3_M.jpg";

$path_locale=$percorso_locale.$foto;

$path_remoto="./img_up/".$foto;



/**
 * dati di connessione
 */
set_time_limit(0);
$remote_ip="213.92.85.196";
$remote_port="21";
$remote_user="devforwe";
$remote_pass="dem93sda";
$remote_directoryFoto="/public_html/immobiliare/img_up";






$stream = ftp_connect($remote_ip, $remote_port);


$login = ftp_login($stream, $remote_user, $remote_pass);

if ($login == "1") {
// Fai il resto delle operazioni
	$system = ftp_systype($stream);
	$directory = ftp_pwd($stream);
	echo $directory;
	echo "<br>";
	$newdir = ftp_chdir($stream, "/public_html/immobiliare");
	echo "nuova dir: ";
	$directory = ftp_pwd($stream);
	echo $directory;
	ftp_put($stream,$path_remoto,$path_locale,FTP_BINARY);
} else {
echo "Autorizzazione non riuscita\n";
}

?>