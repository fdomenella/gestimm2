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
<!-- Add jQuery library -->

<script type="text/javascript" src="chromejs/chrome.js">

<?php 
echo $menu_fix; 

include_once("inc.js_sortTable.php"); 
include_once("inc.js_popup.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.1.2/css/autoFill.dataTables.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.3.2/css/colReorder.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.1.2/css/rowReorder.dataTables.min.css"/>

 

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.1.2/js/dataTables.autoFill.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.3.2/js/dataTables.colReorder.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    $('#example').DataTable();

} );            
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
			$opz='<a href="email_add.php?azione=add" onclick="NewWindow(this.href,\'pg_center\',\'800\',\'550\',\'yes\');return false;"><img src="images/add.gif" class="img_menu_sx">Invia Email</a><br/>';
			$menu_sx = new Menu_Sx($opz);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
	<h2>Email inviate da me</h2>
			
	<table width="100%" class="display" id="example" cellspacing="0">
        <thead>
            <tr>
                <th>Destinatario</th>
                <th>Inviato da</th>
                <th>Oggetto</th>
                <th>corpo</th>
                <th>id_imm</th>
                <th>id_cli</th>
                <th>id_ric</th>
                <th>data Invio</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Destinatario</th>
                <th>Inviato da</th>
                <th>Oggetto</th>
                <th>corpo</th>
                <th>id_imm</th>
                <th>id_cli</th>
                <th>id_ric</th>
                <th>data Invio</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            if($_SESSION["id_utente"]==1){
                $q="SELECT * FROM email ";
            }else{
                $q="SELECT * FROM email WHERE inviata_da =".$_SESSION["id_utente"];
            }
            
	$r=$db->query($q);
	while($ro=mysql_fetch_array($r)){
            echo '<tr>';
                
            echo '<td>';
            echo $ro["inviata_a"];
            echo '</td>';
            echo '<td>'; 
            echo idUtenteToNome($ro['inviata_da']);
            echo '</td>';
            echo '<td>';
            echo $ro['oggetto'];
            echo '</td>';
            echo '<td>';
            echo $ro['corpo'];
            echo '</td>';
            echo '<td>';
            if($ro['id_imm']!=0){
            echo '<a target="_blank"  href="immobile_show.php?id_imm='.$ro['id_imm'].'">';
            echo $ro['id_imm'];
            echo '</a>';
            echo " - ";
            echo '<a target="_blank"  href="cliente_show.php?id_cli='.id_imm_to_id_cli($ro['id_imm']).'">';
            echo nominativo_stampa(id_imm_to_id_cli($ro['id_imm']));
             echo '</a>';
            }else{
                echo "-";
            }
            echo '</td>';
            echo '<td>';
            echo '<a target="_blank" href="cliente_show.php?id_cli='.$ro['id_cli'].'">';
            if(!is_null($ro["id_cli"]))
                echo nominativo_stampa($ro['id_cli']);
            
            echo '</a>';
            echo '</td>';
            echo '<td>';
            echo '<a target="_blank"  href="richiesta_show.php?id_ric='.$ro['id_ric'].'">';
            echo $ro['id_ric'];
            echo '</a>';
            echo '</td>';
            echo '<td>';
            echo date('d-m-Y',$ro["inviata_il"]);
            echo '</td>';
            echo '</tr>';
        }
        
        ?>
            
        </tbody>
    </table>
		  
	
	</div>
		


</div>

</body>
</html>