<?php

include_once("./framework/framework.php");

$layout = new Layout("");
$azione=$_GET['azione'];


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
			<?php
		
			
		
			
			
			
			
			$menu_sx = new Menu_Sx();
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<?php
			if ($azione=="mod") {

				$id_doc=$_GET['id_doc'];
					
				$id_imm=""; //l'id dell'immobile non è necessario per la modifica
				echo "<h2>Modifica Documento</h2>";
				echo documento_form($azione,$id_imm,$id_doc);
			}
			else {
				echo "<h2>Aggiungi Documento</h2>";
				$id_imm=$_GET['id_imm'];
		
				$id_doc=""; //l'id dell'immagine non è necessario per l'inserimento
				echo documento_form($azione,$id_imm,$id_doc);
			}
			
			?>
	</div>
		


</div>

</body>
</html>