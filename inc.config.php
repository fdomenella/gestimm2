<?php
	define("QUERY_DEBUG", 1); //debug delle query mysql disabilitato

//database

if(QUERY_DEBUG == 0){ //se query debug = 1 debug errori attivato
	$db = mysql_connect("localhost", "", "") or die("Impossibile connettersi al database: contattare amministratore");
	mysql_select_db("gestimm2", $db) or die("Impossibile selezionare il database: contattare amministratore");
}
else {//solo se debug == 1
	$db = mysql_connect("localhost", "", "") or die("Impossibile connettersi al database: "
														 ."<li>errorno=".mysql_errno()
			  											 ."<li>error=".mysql_error()
														 );
	mysql_select_db("gestimm2", $db) or die("Impossibile connettersi al database "
														 ."<li>errorno=".mysql_errno()
			  											 ."<li>error=".mysql_error()
														 );
}


?>
