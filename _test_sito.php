<?php
      error_reporting(E_ALL);
      ini_set('error_reporting', E_ALL);
include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
//include_once("./framework/dbSito.php");

      /*

   	define("DB_USER_SITO", "immobili_1");			// <-- mysql db user
	define("DB_PASSWORD_SITO", "1");		// <-- mysql db password
	define("DB_NAME_SITO", "immobili_new20");		// <-- mysql db pname
	define("DB_HOST_SITO", "93.95.218.14");	// <-- mysql server host
     */

   mysql_select_db("immobili_new20",mysql_connect("immobiliarerinaldelli.com","immobili_1","1"));
    $query="SELECT * FROM img WHERE id_img=1092";
   $result = mysql_query($query) or die ("Query fallita : "
			."<li>errorno=".mysql_errno()
			."<li>error=".mysql_error()
			."<li>query=".$query
			);

	//$result=$dbSito->query($query);
while($row=mysql_fetch_array($result)){
          echo $row['id_imm'];

}

?>