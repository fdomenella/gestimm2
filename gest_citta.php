<?php

include_once("./framework/framework.php");

$layout = new Layout("");

 if(isset($_GET['modifica'])){
    $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="UPDATE citta SET nome ='".$_GET['nome']."' where id_citta= ".$_GET['id_citta'];
    $r=$db->query($query);
 
 
 
 
 
 
 }
 
if(isset($_GET['rimuovi'])){
     $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
     $query="DELETE FROM citta where id_citta=".$_GET['id_citta'];
     $r=$db->queryDelete($query); 
     
     $query="UPDATE immobile SET id_comune='null' where id_comune= ".$_GET['id_citta'];
     $r=$db->queryInsert($query);
 



} 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $title_html . " - " . $nome_azienda; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="gestimm2_.css">

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />

<script type="text/javascript" src="chromejs/chrome.js">


<?php 
echo $menu_fix; 

include_once("inc.js_sortTable.php"); 
include_once("inc.js_popup.php");
?>
<script type="text/javascript" src="row_highLight.js"></script>
</head>

<body>




<div id="body">
	<div id="head">
		<?php
		
		echo $layout->getHeader();
		echo $layout->getMenu();
		?>
	</div>
	
	
	<div id="center">
		<div id="sx">
		
		
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Gestione Citta: </h2>
	   <p>Attenzione tutte le modifiche saranno applicate a tutti gli immobili e clienti agganciati con la rispettiva citta</p>
			<?php
        	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
        	
        	$query= "select * from citta order by nome asc";
        	$r=$db->query($query);
        	while($row=mysql_fetch_array($r)){
        	echo ' <form action="gest_citta.php" method="get">';
          echo '<input type="text" name="nome" value="'.$row['nome'].'">';
          echo '<input type="hidden" name="id_citta" value="'.$row['id_citta'].'">';   
          echo '<input type="submit" name="modifica" value="modifica">';
           echo '<input type="submit" name="rimuovi" value="Rimuovi">';
          echo "<br>";
          echo '</form>';
          }
        	
        	
   
   ?>
     

</div>

</body>
</html>