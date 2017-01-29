<?php

include_once("./framework/framework.php");
include_once("inc.js_popup.php");
$layout = new Layout("");
$month=$_GET['month'];
$year=$_GET['year'];


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
		<li><a href="gest_citta.php">Gestione Citta</a></li>
                <li><a href="gest_zona.php">Gestione zona</a></li>
               <li> <a href="gest_stato.php">Gestione Stato</a></li>
              <li>  <a href="gest_tipologia.php">Gestione Tipologia</a></li>
        </ul>
		</div>
	
	</div>
		


</div>

</body>
</html>