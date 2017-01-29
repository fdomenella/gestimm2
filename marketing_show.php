<?php

include_once("./framework/framework.php");

$layout = new Layout("");

if (isset($_GET['id_mrk'])) {
	$id_mrk = $_GET['id_mrk'];
	
	
}
else {
	header("location: marketing_index.php");
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
		
			
		$cont1="";
			/**
			 * comuni a tutti
			 */
			
			$cont1="<a href=\"marketing_add.php?azione=mod&id_mrk=$id_mrk\"><img src=\"images/add.gif\" class=\"img_menu_sx\">Modifica</a><br/>";
			
			
			
			
			
			$menu_sx = new Menu_Sx($cont1);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Cliente: </h2>
			<?php 
			
			echo scheda_marketing($id_mrk);
		
			echo "<br>";
			
			/**
			 * per ogni richiesta del cliente mostro la scheda 
			 */
			//echo scheda_richiesta($id_ric);
			
			echo "<br>";
			
			echo '<br>';
			
			
			?>
	
	
	</div>
	<div id="dx" style="width: 750px">
		
		<h2>Immobili in pubblicità qui</h2>
               
		
	<table width="100%" class="display" id="example" cellspacing="0">
        <thead>
            <tr>
                
                
                <th>id_imm</th>
               
                <th>Nota pubblicità</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>id_imm</th>
               
                <th>Nota pubblicità</th>
                
            </tr>
        </tfoot>
        <tbody>
            <?php
            
                $q="SELECT * FROM pubblicita WHERE id_mrk=$id_mrk";
            
            
	$r=$db->query($q);
        if($r){
            while($ro=mysql_fetch_array($r)){
                echo '<tr>';



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

                echo $ro['valore'];
                echo '</a>';
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
            
        </tbody>
    </table>

    
	</div>	


</div>

</body>
</html>