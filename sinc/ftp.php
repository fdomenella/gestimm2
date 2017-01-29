<?php


$stream = ftp_connect("213.92.85.196", "21");


$login = ftp_login($stream, "immobili", "pok82mea");


if ($login == "1") {
// Fai il resto delle operazioni
	$system = ftp_systype($stream);
	$directory = ftp_pwd($stream);
	echo $directory;
	echo "<br>";
	$newdir = ftp_chdir($stream, "/public_html/img_up");
	echo "nuova dir: ";
	$directory = ftp_pwd($stream);
	echo $directory;

} else {
echo "Autorizzazione non riuscita\n";
}

?>