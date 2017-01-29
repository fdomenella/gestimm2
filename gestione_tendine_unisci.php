<?php

include_once("./framework/framework.php");
include_once("inc.js_popup.php");
$layout = new Layout("");


//header("Location: nota_index.php");

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
include_once("./framework/inc.js_menu_sx.php"); 
?>
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
	
		<div id="dx">
                <ul>
		<li><a href="gest_citta_unisci.php">Unisci Citta</a></li>
                <li><a href="gest_provincia_unisci.php">Unisci Provincia</a></li>
                <li><a href="gest_zona_unisci.php">Unisci zona</a></li>
               
              <li>  <a href="gest_tipologia_unisci.php">Unisci Tipologia</a></li>
        </ul>
		</div>
	
	</div>
		


</div>

</body>
</html>