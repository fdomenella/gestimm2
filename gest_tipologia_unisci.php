<?php

include_once("./framework/framework.php");

$layout = new Layout("");

 
 

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
        	
        	$query= "select * from tipo_immobile order by nome asc";
        	$r=$db->query($query);
                echo ' <form action="gest_tipologia_unisci_save.php" method="POST">';
                 	echo '<select multiple size="10" style=" height: 350px; width:200px;" name="id_tipo_immobile[]">';
        	while($row=mysql_fetch_array($r)){
         
                echo '<option value="';
                echo $row['id_tipo_immobile'];
                echo '">';
                echo $row['nome'];
                echo '</option>';


         
   
         
          
          }
          echo '</select> ';
          echo '<input type="submit" value="Unisci"/>';
          echo '</form>';	
        	
   
   ?>
     

</div>

</body>
</html>