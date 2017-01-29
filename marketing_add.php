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

<script type="text/javascript" src="chromejs/chrome.js"></script>

<script>

function checkForm(){
	  var e = document.getElementById("id_tipo_cliente");
      var item = e.options[e.selectedIndex].value;
		if(item==""){
			alert("Seleziona che tipo di cliente e'!");
			e.focus();
			return false;
		}
      
}

</script>


<?php 
echo $menu_fix; 

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
				$id_cli=$_GET['id_mrk'];
				echo "<h2>Modifica Marketing</h2>";
				echo marketing_form($azione,$id_cli);
			}
			else {
				echo "<h2>Aggiungi Marketing</h2>";
				echo marketing_form($azione);
			}
			
			?>	
	
	</div>
		


</div>

</body>
</html>