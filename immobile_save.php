<?php
include_once("./framework/framework.php");


/**
 * sempre settati xche passati corretti dalla pagina precedente
 */

$id_imm = $_POST['id_imm'];
$id_cli=$_POST['id_cli'];

/**
 * fine sempre settati xche passati corretti dalla pagina precedente
 */

/**
 * stringhe
 */
$via = sistemaTesto($_POST['via']);
$note=  sistemaTesto($_POST['note']);
$note_sito=  sistemaTesto($_POST['note_sito']);
/**
 * fine stringhe
 */

/**
 * valori numerici
 */

/*

$mq = $_POST['mq'];
$prezzo = $_POST['prezzo'];
$id_tipo_locazione = $_POST['id_tipo_locazione'];
$id_garage = $_POST['id_garage'];
$num_piani = $_POST['num_piani'];
$num_bagni = $_POST['$num_bagni'];
$num_camere = $_POST['num_camere'];
$id_stato = $_POST['id_stato'];
*/



if ($_POST['id_stato']!="") {
	$id_stato = "'".$_POST['id_stato']."'";

}
else {
	$id_stato = 'null';
}

if ($_POST['num_bagni']!="") {
	$num_bagni = "'".$_POST['num_bagni']."'";

}
else {
	$num_bagni = 'null';
}

if ($_POST['num_camere']!="") {
	$num_camere = "'".$_POST['num_camere']."'";

}
else {
	$num_camere = 'null';
}

if ($_POST['num_piani']!="") {
	$num_piani =  "'".$_POST['num_piani']."'";

}
else {
	$num_piani = 'null';
}

if ($_POST['id_garage']!="") {
	$id_garage = "'".$_POST['id_garage']."'";

}
else {
	$id_garage = 'null';
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
	$mq = 'null';
}

if ($_POST['mq_comm']!="") {
	$mq_comm = "'".$_POST['mq_comm']."'";

}
else {
	$mq_comm = 'null';
}


if ($_POST['prezzo']!="") {
	$prezzo ="'".$_POST['prezzo']."'";

}
else {
	$prezzo = 'null';
}

if ($_POST['new_tipo_immobile']!="") {
	$id_tipo_immobile = inserisci_tipo_immobile($_POST['new_tipo_immobile']);

}
else {
	if ($_POST['id_tipo_immobile']!="") {
		$id_tipo_immobile ="'".$_POST['id_tipo_immobile']."'";

	}
	else {
		$id_tipo_immobile = 'null';
	}


}

if ($_POST['new_provincia']!="") {
	$id_provincia = inserisci_provincia($_POST['new_provincia']);

}
else {
	if ($_POST['id_provincia']!="") {
		$id_provincia ="'".$_POST['id_provincia']."'";

	}
	else {
		$id_provincia = 'null';
	}

}

if ($_POST['new_citta']!="") {
	$id_citta = inserisci_citta($_POST['new_citta']);

}
else {

	if ($_POST['id_citta']!="") {
		$id_citta ="'".$_POST['id_citta']."'";

	}
	else {
		$id_citta = 'null';
	}

}

if ($_POST['new_zona']!="") {
	$id_zona = inserisci_zona($_POST['new_zona']);

}
else {

	if ($_POST['id_zona']!="") {
		$id_zona ="'".$_POST['id_zona']."'";

	}
	else {
		$id_zona = 'null';
	}

}

if ($_POST['classe_en']!="") {
	$classe_en = "'".$_POST['classe_en']."'";

}
else {
	$classe_en = 'null';
}

if ($_POST['vani']!="") {
	$vani = "'".$_POST['vani']."'";

}
else {
	$vani = 'null';
}

if ($_POST['anno_costruzione']!="") {
	$anno_costruzione = "'".$_POST['anno_costruzione']."'";

}
else {
	$anno_costruzione = 'null';
}

if ($_POST['al_piano']!="") {
	$al_piano = "'".$_POST['al_piano']."'";

}
else {
	$al_piano = 'null';
}

if ($_POST['id_ascensore']!="") {
	$id_ascensore = "'".$_POST['id_ascensore']."'";

}
else {
	$id_ascensore = 'null';
}

if ($_POST['id_chiavi']!="") {
	$id_chiavi = "'".$_POST['id_chiavi']."'";

}
else {
	$id_chiavi = 'null';
}

if ($_POST['spese_cond']!="") {
	$spese_cond = "'".$_POST['spese_cond']."'";

}
else {
	$spese_cond = 'null';
}
if ($_POST['esclusiva']!="") {
	$esclusiva= "'".$_POST['esclusiva']."'";

}
else {
	$esclusiva = '0';
}
if ($_POST['posto_auto']!="") {
	$posto_auto= "'".$_POST['posto_auto']."'";

}
else {
	$posto_auto = '0';
}
if ($_POST['esclusiva_durata']!="") {
	$esclusiva_durata = "'".$_POST['esclusiva_durata']."'";

}
else {
	$esclusiva_durata = 'null';
}
if ($_POST['azione']=="add") {

	/**
	 * creo la cartella
	 *
	 * se la cartella non viene creata correttamente non faccio inserire i dati ma rimando all'inserimento e mostro
	 * un alert di errore
	 */
	$path= "./immobili/".$id_imm;

	if (!mkdir($path)) {
		echo "<SCRIPT>";
		echo "alert(\"Attenzione errore fatale. Impossibile creare la cartella dell'immobile sul Server. Impossibile Inserire l'immobile. Se l'errore persiste contattare l'amministratore\"){";
		echo "location.href=\"immobile_add.php?azione=add\"";
		echo "}";
		echo "</SCRIPT>";
		exit;
	}



	$data_ins = date("Y-m-d");
	$query="INSERT INTO `immobile`
	( `id_imm` , `id_comune` , `id_provincia` , `id_tipo_locazione` , `id_tipo_immobile` , `via` , `mq` ,
	 `prezzo` , `id_garage` , `num_piani` , `num_camere` , `num_bagni` , `id_stato` , `note` , `id_utente_ins` ,
	  `data_ins` , `id_utente_last_mod` , `data_last_mod`, `id_zona`, `classe_en`, `spese_cond`, `vani`,
          `anno_costruzione`, `al_piano`, `id_chiavi`, `id_ascensore`, `esclusiva`, `esclusiva_durata`, `note_sito`,`mq_comm`,`posto_auto` )
	VALUES (
	'$id_imm', $id_citta , $id_provincia , $id_tipo_locazione, $id_tipo_immobile, '$via', $mq, $prezzo,
	 $id_garage, $num_piani, $num_camere, $num_bagni, $id_stato, '$note', '$_SESSION[id_utente]' , '$data_ins',"
                . " NULL , NULL, $id_zona, $classe_en, $spese_cond, $vani,"
                . "$anno_costruzione, $al_piano,$id_chiavi,$id_ascensore, $esclusiva, $esclusiva_durata, '$note_sito',$mq_comm, $posto_auto)";
       
	$result=$db->queryInsert($query);




	/**
	 * l'operatore non ha selezionato il cliente
	 */
	if ($id_cli=="") {

		/**
		 * echo di uno script js che informa il fatto che non � stato selezionato il cliente
		 */

		echo "<SCRIPT>";
		echo "if(confirm(\"Attenzione si ricorda l'immobile ".$id_imm." non � associato a nessun cliente\")){";
		echo "location.href=\"immobile_add.php?azione=mod&id_imm=$id_imm\"";
		echo "}";
		echo "</SCRIPT>";
		/**
		 * se al'operatore va bene che l'immobile sia inserito senza cliente
		 */
		echo "<SCRIPT>";
		echo "location.href=\"immobile_show.php?id_imm=$id_imm\"";
		echo "</SCRIPT>";
		exit;
	}else {
		/**
		 * collego l'immobile al cliente
		 */
		$query="INSERT INTO cli_imm VALUES('$id_cli','$id_imm')";
		$result=$db->queryInsert($query);
	}
	echo "<SCRIPT>";
	echo "location.href=\"immobile_show.php?id_imm=$id_imm\"";
	echo "</SCRIPT>";

}else {
	$id_imm=$_POST['id_imm'];
	$data_last_mod = date("d-m-y");
	$query="UPDATE immobile SET
		id_comune= $id_citta,
		id_provincia = $id_provincia,
		id_tipo_locazione=$id_tipo_locazione,
		id_tipo_immobile=$id_tipo_immobile,
		via='$via',
		mq=$mq,
		prezzo=$prezzo,
		id_garage=$id_garage,
		num_piani=$num_piani,
		num_camere=$num_camere,
		num_bagni=$num_bagni,
		id_stato=$id_stato,
		note='$note',
		id_utente_last_mod='$_SESSION[id_utente]',
		data_last_mod='$data_last_mod',
		id_zona=$id_zona,
		classe_en=$classe_en,
		spese_cond=$spese_cond,
		vani=$vani,
                anno_costruzione=$anno_costruzione,
                al_piano=$al_piano,
                id_chiavi=$id_chiavi,
                id_ascensore=$id_ascensore,
                esclusiva=$esclusiva,
                esclusiva_durata=$esclusiva_durata,
                note_sito='$note_sito',
                mq_comm=$mq_comm,
                posto_auto=$posto_auto
	WHERE id_imm = $id_imm";
      
	$result=$db->queryInsert($query);

	if ($id_cli=="") {

		/**
		 * echo di uno script js che informa il fatto che non � stato selezionato il cliente
		 */

		echo "<SCRIPT>";
		echo "if(confirm(\"Attenzione si ricorda l'immobile ".$id_imm." non � associato a nessun cliente\")){";
		echo "location.href=\"immobile_add.php?azione=mod&id_imm=$id_imm\"";
		echo "}";
		echo "</SCRIPT>";
		/**
		 * se al'operatore va bene che l'immobile sia inserito senza cliente
		 */
		echo "<SCRIPT>";
		echo "location.href=\"immobile_show.php?id_imm=$id_imm\"";
		echo "</SCRIPT>";
		exit;
	}else {

		/**
		 * collego l'immobile al cliente
		 */
		$query="DELETE FROM  cli_imm WHERE id_cli=$id_cli and id_imm=$id_imm";
		$result=$db->queryDelete($query);


		$query="INSERT INTO cli_imm VALUES('$id_cli','$id_imm')";
		$result=$db->queryInsert($query);
	}

	echo "<SCRIPT>";
	echo "location.href=\"immobile_show.php?id_imm=$id_imm\"";
	echo "</SCRIPT>";

}

?>


