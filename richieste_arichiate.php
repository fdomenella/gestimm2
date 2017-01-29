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
<script type="text/javascript" src="BubbleTooltips.js"></script>

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
			$opz='<a href="richiesta_add.php?azione=add"><img src="images/add.gif" class="img_menu_sx">Inserisci Richiesta</a><br/>
						<a href=""><img src="images/stampa.gif" class="img_menu_sx">Stampa Tutte le Richieste</a><br/>
						';
			$menu_sx = new Menu_Sx($opz);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
<h2>Richeste 
		
				<?php
					echo lista_richieste_archiviate();
					
				?>
		  

		  
	
	</div>
		


</div>

</body>
</html>