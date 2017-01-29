<?php

include_once("./framework/framework.php");

$layout = new Layout("");

if (isset($_GET['id_nota'])) {
	$id_nota = $_GET['id_nota'];
}
else {
	header("location: nota_index.php");
	exit;
}



/**
 * controllo che l'utente abbia i privilegi per visualizzarla
 * 
 */
$alert="";
$id_utente=$_SESSION['id_utente'];
$query="SELECT * FROM nota JOIN nota_utente ON nota.id_nota=nota_utente.id_nota WHERE nota.id_nota=$id_nota AND id_utente=$id_utente";
$result=$db->query($query);
if (!$result) {
	$alert='<script>
	alert("Non sei autorizzato a visualizzare tale nota");
	location.href=\"nota_index.php";
	</script>';
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

<?php
if ($alert!="") {
	echo $alert;
	exit;
}

?>


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
		
			$cont1='<a href="nota_add.php?azione=mod&id_nota='.$id_nota.'"><img src="images/mod.gif" class="img_menu_sx">Modifica Nota</a><br/>';
			
			
			
			$menu_sx = new Menu_Sx($cont1);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Visualizza nota</h2>
			<?php 
			
			echo visualizza_nota($id_nota);
			
			?>
	
	</div>
		


</div>

</body>
</html>