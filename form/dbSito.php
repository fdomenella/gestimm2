<?php
	define("DB_USER_SITO", "immobili_prin");			// <-- mysql db user
	define("DB_PASSWORD_SITO", "immo_192.5");		// <-- mysql db password
	define("DB_NAME_SITO", "immobili_principale");		// <-- mysql db pname
	define("DB_HOST_SITO", "213.92.85.196");	// <-- mysql server host

class dbSito {

	var $objDb;


	function __construct($dbuser, $dbpassword, $dbname, $dbhost){
		$this->objDb = @mysql_connect($dbhost,$dbuser,$dbpassword);
		$this->selectDb($dbname);
	}

	function selectDb($dbname){
		mysql_select_db($dbname,$this->objDb);
	}
	/**
	 * Esegue una query
	 *
	 * @param La query $q
	 * @return se_va_a_buon_fine(righe>0)_ritorna_$result_altrimenti_false
	 */
	function query($query){
		$result = mysql_query($query) or die ("Query fallita : "
			."<li>errorno=".mysql_errno()
			."<li>error=".mysql_error()
			."<li>query=".$query
			);

		if ($result) {
			if (mysql_num_rows($result)>0) {

			    return $result;
			}
			else{
				return false;
			}
		}
		else {
			return false;
		}
	}

	/**
	 * Riceve una query di update-delete-insert e restituisce se � andata a buon fine
	 *
	 * @param unknown_type $q
	 * @return bool
	 */
	function queryInsert($query){
		$result = mysql_query($query) or die ("Query fallita : "
			."<li>errorno=".mysql_errno()
			."<li>error=".mysql_error()
			."<li>query=".$query
			);

		if (mysql_affected_rows()==0) {
			//maybe an error
			return false;
		}

		return true;
	}



	function queryDelete($query){
		$result = mysql_query($query) or die ("Query fallita : "
			."<li>errorno=".mysql_errno()
			."<li>error=".mysql_error()
			."<li>query=".$query
			);

		return true;
	}


}

$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);

?>