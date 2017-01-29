<?php

include_once("./framework/framework.php");

$layout = new Layout("");


if (isset($_GET['id_tipo_locazione'])) {
	$id_tipo_locazione = $_GET['id_tipo_locazione'];
}
else {
	header("Location: index.php");
	//$id_tipo_locazione = "all";
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
<script type="text/javascript" src="BubbleTooltips.js"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type=text/javascript" src="js/jquery-ui.js"></script>
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php 
echo $menu_fix; 

include_once("inc.js_sortTable.php"); 
?>
<script type="text/javascript" src="row_highLight.js"></script>
  <script>
  $( function() {
    $( document ).tooltip();
  } );
  </script>
  <style>
  label {
    display: inline-block;
    width: 400px;
  }
  </style>
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
<h2>Richieste 
			<?php 
			if ($id_tipo_locazione==1) {
				echo "Acquisti";
			}
			else {
				echo "Affitti";
			} 
			
			 ?></h2>
			
				<?php
					echo lista_richieste($id_tipo_locazione);
					
				?>
		  

		  
	
	</div>
		


</div>

</body>
</html>