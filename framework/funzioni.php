<?php
include_once("db.php");


function getUrlSito(){
	return "http://www.devforweb.it/immobiliare/";
}





/**
 * Ritorna il path dell'immagine principale
 *
 * @param unknown_type $id_imm
 * @param Determina la scelta del path per la risoluzione 1==HIGH 0=LOW $risoluzione
 * @return unknown
 */
function pathImgPrincipale($id_imm,$risoluzione){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$q="SELECT * FROM imm_img JOIN img ON imm_img.id_img = img.id_img WHERE imm_img.id_imm = $id_imm";
	$r=$db->query($q);
	if (!$r) {
		/**
		 * qui deve tornare l'immagine vuota
		 */
		if ($risoluzione==0) {
			return "./images/img_vuota_low.jpg";
		}else{
			return "./images/img_vuota_high.jpg";
		}
		
	}else{
		$ro=mysql_fetch_array($r);
		if ($risoluzione==0) {
			return $ro['path_low'];
		}else{
			return $ro['path_high'];
		}
		
	}
	
}



function truncateString($stringa,$num_car=270){
	$str="";
	if (strlen($stringa)>$num_car) {
		$str.=substr($stringa,0,$num_car) ." ...." ;
	}else {
		$str.=$stringa;
	}
	return $str;
}



function stampa_comune($comune=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select nome from comune where id_comune = $comune";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		return $row['nome'];
	}

}

function stampa_provincia($provincia=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select nome from provincia where id_provincia =$provincia";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
	
		return $row['nome'];
	}

}

function stampa_tipologia($tipologia=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);

	$query="select nome from tipologia where id_tipologia=$tipologia";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		return $row['nome'];
	}
	
}

function stampa_zona($id_zona=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	if ($id_zona=="" or $id_zona==0) {
		return "Informazione assente";
	}
	$query="select nome from zona where id_zona = $id_zona";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		return ucfirst($row['nome']);
	}

}

function stampa_tipo($id_tipo){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query = "select nome from tipo where id_tipo = $id_tipo";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		return $row['nome'];
	}
	
}


function stampa_mq($mq="",$dato_non_conosciuto="Dato non conosciuto"){
	if($mq==0){
		return $dato_non_conosciuto;
	}
	else
		return $mq;
}

function suggerisci_rif(){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select max(id_imm) as max from immobile";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		return $row['max']+1;
	}
}

function stampa_prezzo($prezzo=""){
	return "€ " .number_format($prezzo,2,",",".");
}

function add_dato_db($tabella="", $valore=""){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$valore=sistemaTesto($valore);
	$query="INSERT INTO $tabella VALUES (null,'$valore','')";
	$result = $db->queryInsert($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		return mysql_insert_id();
	}
	
}


/**
 * La funzione ritorna l'immagine passatagli tramite l'id_img
 *
 * @param unknown_type $id_img
 * @param unknown_type $risoluzione
 * @return unknown
 */
function stampa_img($id_img,$risoluzione="low"){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select * from img where id_img = $id_img limit 1";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		if ($risoluzione=="low") {
			
			$img='<a href="'.$row['path_high'].'" rel="lightbox" title="">';
			$img .= '<img class="img" src="'.$row['path_low'].'" alt="Immagine dell\'immobile"/>';
			$img.="</a>";
		}else{
			
			$img = '<img src="'.$row['path_high'].'" alt="Immagine dell\'immobile"/>';
		
		}
		
		return $img;
	}

	
}


/**
 * la funzione conta quante immagini si hanno per l'immobile passato
 *
 * @param unknown_type $id_imm
 */
function countImg($id_imm){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select count(*) as totImg from img JOIN imm_img ON imm_img.id_img = img.id_img where id_imm = $id_imm";
	$result = $db->query($query);
	if (!$result) {
		return "qualcosa storto";
	}else{
		$row=mysql_fetch_array($result);
		return $row['totImg'];
	}
	
}


function stampa_box_img($id_imm){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select * from img JOIN imm_img ON imm_img.id_img = img.id_img where id_imm = $id_imm";
	$result = $db->query($query);
	if (!$result) {
		$str="";
		for ($i=0; $i<4; $i++)
			$str.= stampa_no_img("low");
	}else{

		$str="";
		//$totImg = countImg($id_imm);
		//$str.="totale immagini : " .$totImg;
		
		for ($i=0; $i<4; $i++)
		if ($row=mysql_fetch_array($result)) {
			$str.= stampa_img($row['id_img']);
		}else{
			$str.= stampa_no_img("low");
		}
	
			
		
		
		
	}
	return $str;
}


function stampa_no_img($risoluzione){
	if ($risoluzione=="low") {
		return '<img src="images/imgNoDisponibileSmall.jpg" alt="Immagine non disponibile"/>';
	}
	else{
		return '<img src="images/imgNoDisponibile.jpg" alt="Immagine non disponibile"/>';
	}
	
}

function stampa_img_principale($id_imm){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select * from img JOIN imm_img ON imm_img.id_img = img.id_img where id_imm = $id_imm LIMIT 1";
	$result = $db->query($query);
	$str="";
	if (!$result) {
		$str.= stampa_no_img("high");
	}else{
		$row=mysql_fetch_array($result);
		$str.= stampa_img($row['id_img'],"high");
	}
	return $str;

		
		
}


function boxInformazioni(){
	return '<div id="boxInformazioni">
		<form action="sendMailAPage.php" method="POST">
		
		<label for="nome">Nome e Cognome<br/>
		<input class="info"  type="text" name="nome" value=""/></label>
		<br/>
		<label for="email">E-Mail<br/>
		<input class="info" type="text" name="email" value=""/></label>
		<label for="testo">Messaggio<br/>
		<textarea  class="info" name="testo" cols="20" rows="20"></textarea></label>
		<div id="submitCerca">
		<input type="submit" class="submit" name="submit" value="Invia"/>
		</div>
			
		
		</form>
		
		
		
		</div>';
}


function idUtenteNewsLetterToNome($id){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select * from utenti_esterni WHERE id=$id";
	$result = $db->query($query);
	$str="";
	if ($result) {
		$row=mysql_fetch_array($result);
		return $row['nominativo'];
	}else{
		
		
	}
	
}


function idUtenteNewsLetterToMail($id){
		$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="select * from utenti_esterni WHERE id=$id";
	$result = $db->query($query);
	$str="";
	if ($result) {
		$row=mysql_fetch_array($result);
		return $row['email'];
	}else{
		
		
	}
}



/**
 * utilizzata per stampare le immagine per le newsletter e per l'immagine piccola nella lista riservata
 *
 */
function stampa_img_piccole($id_imm){
	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$query="SELECT *
FROM img
JOIN imm_img ON img.id_img = imm_img.id_img
WHERE id_imm =$id_imm";
	$result = $db->query($query);
	$str="";
echo $url_sito;
	if (!$result) {
		
		$str.= '<img src="'.getUrlSito().'images/imgNoDisponibileSmall.jpg" width="" height="50px;" alt="Immagine 3non disponibile"/>';
		
	}else{
		$row=mysql_fetch_array($result);
		$p = getUrlSito();
	
		$p.= leva_punto_da_path($row['path_low']);
		echo "<strong>".$path."</strong>";
		$str.= '<img src="'.$p.'" width="" height="50px;" alt="Immagine dell\'immobile"/>';
	}
	return $str;
	
}


function leva_punto_da_path($path){
	//$path="./img_up/pippo.jpg";
	$path = substr($path,1);
	return  $path;
	
	
}

function sistemaTesto($str){
	if(!get_magic_quotes_gpc()){  
		$str     = stripslashes($str);  
		
		
		$str      = mysql_real_escape_string($str);  
		
	} else{
		
		
	}
		
		
	return $str;
}

?>