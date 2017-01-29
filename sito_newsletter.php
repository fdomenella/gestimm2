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
<script>

function uno(){
	
	e = document.getElementById('destinatari');
	e.multiple = false;
    	for(var i=0;i<e.options.length;i++){
		e.options[i].selected=false;
	}    
	li = document.getElementById('1');
	li.style.fontWeight = "bold";
	li = document.getElementById('2');
	li.style.fontWeight = "normal";
	li = document.getElementById('3');
	li.style.fontWeight = "normal";
	
}

function tutti(){
	
	e = document.getElementById('destinatari');
	e.multiple = true;
    
	for(var i=0;i<e.options.length;i++){
		e.options[i].selected=true;
	}
	
	
	li = document.getElementById('2');
	li.style.fontWeight = "bold";

	
	li = document.getElementById('1');
	li.style.fontWeight = "normal";
	li = document.getElementById('3');
	li.style.fontWeight = "normal";
}
function alcuni(){
	
	e = document.getElementById('destinatari');
	e.multiple = true;
    	for(var i=0;i<e.options.length;i++){
		e.options[i].selected=false;
	}
	
	
	li = document.getElementById('3');

	li.style.fontWeight = "bold";
	li = document.getElementById('2');
	li.style.fontWeight = "normal";
	li = document.getElementById('1');
	li.style.fontWeight = "normal";
}
</script>
<script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>

<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	updateRTE('testo');
	
	
	//alert("rte = " + document.RTEDemo.testo.value);
	
	//change the following line to true to submit form
	return true;
}

//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("images/", "", "");
//-->
</script>
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
	<h2>Sito: NewsLetters</h2>
		
		<form target="_blank" action="http://www.immobiliarerinaldelli.com/admin/newsletter_send.php" method="POST" onsubmit="return submitForm();">
		
		
		<table>
		<tr>
			
			<td>Destinatari</td>
			<td><div style="float: left;"><ul>
		
		<li><a href="#" onclick="uno();"><span id="1">Spedisci ad uno</span></a></li>
		<li><a href="#" onclick="tutti();"><span id="2">Spedisci a tutti</span></a></li>
		<li><a href="#" onclick="alcuni();"><span id="3">Spedisci ad alcuni</span></a></li>
		
		</ul></div>
			<?php
			echo '<select id="destinatari" multiple size=10 name="destinatari[]">';
			$dbSito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
			$query = "SELECT * FROM utenti_esterni ";
			$result=$dbSito->query($query);
			while ($row=mysql_fetch_array($result)) {
				echo '<option value="';
				echo $row['id'];
				echo '">';
				echo $row['nominativo'];
				echo '('.$row['email'].')';
				echo '</option>';
			}
			
			
			echo '</select>';
			
			
			?>
			
			
			</td>
		
		</tr>
		<tr>
			<td>Comunicazione</td>
			
			<td>
			<?php
			echo '
			<script language="JavaScript" type="text/javascript">
				<!--
				//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
				writeRichText(\'testo\', \' \', 400, 200, true, false);
				
				//-->
				</script>'; ?>
			</td>
		
		</tr>
		<tr>
			<td></td>
			<td>
			
			<input type="submit" value="Invia" name="submit">
			</td>
		
		</tr>
		
		
		</table>
		
		
		
		
		
		</form>
		

		  
	
	</div>
		


</div>

</body>
</html>