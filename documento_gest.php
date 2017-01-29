<?php

include_once("./framework/framework.php");

$layout = new Layout("");
if (isset($_GET['id_imm'])) {
	$id_imm = $_GET['id_imm'];
}
else {
	header("location: immobili_index.php");
	exit;
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
			<?php
		
			
		$cont1='<a href="documento_add.php?azione=add&id_imm='.$id_imm.'"><img src="images/doc_add.gif" class="img_menu_sx">Carica Documenti</a><br/>';
			
			
			
			
			$menu_sx = new Menu_Sx($cont1);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Documenti dell'immobile: <?php echo $id_imm; ?></h2>
			<?php 
			
			echo documenti_gest($id_imm);
			
			?>
	
	</div>
		


</div>

</body>
</html>