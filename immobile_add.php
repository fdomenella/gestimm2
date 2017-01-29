<?php

include_once("./framework/framework.php");

$layout = new Layout("");


$azione=$_GET['azione'];

if (isset($_GET['id_cli'])) {
	$id_cli=$_GET['id_cli'];
}
else {
	$id_cli="";
}



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
				$id_imm=$_GET['id_imm'];
				$id_cli = "";
				$query="SELECT *
FROM cli_imm
JOIN cliente ON cliente.id_cli = cli_imm.id_cli
WHERE id_imm =".$id_imm;
$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
$result = $db->query($query);
$row= mysql_fetch_array($result);
$id_cli = $row['id_cli'];
				echo "<h2>Modifica Immobile</h2>";
				echo immobile_form($azione,$id_imm,$id_cli);
			}
			else {
				echo "<h2>Aggiungi Immobile</h2>";
				$id_imm="";
				
				echo immobile_form($azione,$id_imm,$id_cli);
			}
			
			?>
	
	</div>
		


</div>

</body>
</html>