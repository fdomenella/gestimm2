<?php

include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");
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
	
		<h3>Immobili nei box piccoli</h3>
		<form method="POST" action="sito_home_save.php">
		<table>
		<tr>
			<td>
			Posizione
			</td>
			<td>
			Riferimenti
			</td>		
		</tr>
		<tr>
			<td>
			<img src="./images/sito_home/tipo_vetrina2.png"/>
			</td>
			<td>
			
			<?php
			$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
			$q="select * from immobile WHERE tipo_vetrina = 2  ORDER BY id_imm LIMIT 2";
			$r=$dbSito->query($q);
			if (!$r) {
				echo '<input type="text" name="vetrina2_0" value="" /> sx';
				echo '<br>';
				echo '<input type="text" name="vetrina2_1" value="" /> dx';
			}
			else {
				$i=0;
				while($row=mysql_fetch_array($r)){
					
					echo '<br>';
					echo '<input type="text" name="vetrina2_'.$i.'" value="';
					echo $row['id_imm'];
					echo '" />';
					
					$i++;
				}
			}
			?>
			</td>		
		</tr>
		<tr>
		<td>
		<img src="./images/sito_home/tipo_vetrina1.png"/>
		</td>
		<td>
		<?php
			$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
			$q="select * from immobile WHERE tipo_vetrina = 1 ORDER BY id_imm LIMIT 6";
			$r=$dbSito->query($q);
			
			
			for($i=0; $i<6; $i++){
			
				
					
				echo '<br>';
				echo '<input type="text" name="vetrina1_'.$i.'" value="';
				if($r){
				$row=mysql_fetch_array($r);
				echo $row['id_imm'];
				}
				echo '" /> Rif'.$i.'';
			
			}
			
			?>
		</td>
		
		</tr>
		<tr>
		<td colspan="2">
		<input type="submit" name="submit" value="Aggiorna">
		</td>
		</tr>
		
		</table>
		</form>
		

		  
	
	</div>
		


</div>

</body>
</html>