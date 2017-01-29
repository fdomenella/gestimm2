<?php

include_once("./framework/framework.php");

$layout = new Layout("");
include_once("inc.js_popup.php");




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
			<?php
			$opz='<a href="immobile_add.php?azione=add"><img src="images/add.gif" class="img_menu_sx">Inserisci Immobile</a><br/>
						<a href=""><img src="images/stampa.gif" class="img_menu_sx">Stampa Tutti Immobili</a><br/>';
			$menu_sx = new Menu_Sx($opz);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
	<h2>Visualizza Note</h2>
			
				<?php
					echo lista_note($_SESSION['id_utente']);
				?>
		  
	
	</div>
		


</div>

</body>
</html>