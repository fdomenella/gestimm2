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

<script type="text/javascript" src="chromejs/chrome.js">


<?php 
echo $menu_fix; 

include_once("inc.js_sortTable.php"); 
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

    $('#example').DataTable({
  "pageLength": 50,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
});

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
			$menu_sx = new Menu_Sx();
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Lista Marketing</h2>
	<?php
		
        $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
	$str="";
	$q="select * from marketing  ";
	
	
	$q.=" order by nome asc";
	$r=$db->query($q);
	if (!$r) {
  		echo "<SCRIPT>";
		echo "alert(\"Nessun marketing nel database\")";
		echo "</SCRIPT>";
		
		$str.="<tr><td  colspan=\"4\">NESSUN MARKETING NEL DATABASE</td></tr>";
	}	
	
	if ($r) {
		$str.='<table width="1000px" class="display" id="example" cellspacing="0">
        <thead>
            <tr>
                 <th width="300px">Nominativo</th>
                <th width="300px">Nota</th>
               
               
                <th>Opzioni</th>
          
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nominativo</th>
                <th>Nota</th>
           
               
                <th>Opzioni</th>
                
                
            </tr>
        </tfoot>
        <tbody>';
                
  		while ($ro=mysql_fetch_array($r)) {
  			$str.= "<TR>\n";
			$str.= "<TD >\n";
			$str.= $ro['nome']."\n</TD>\n";
		    $str.= "<TD>\n";
			$str.= $ro['note']."\n</TD>\n";
			
			$str.= "<TD >\n";
			//$str.= opzioni_cliente($id_tipo_cliente,$ro['id_cli'])."\n</TD>\n";
                        
                        $str.='<a href="marketing_show.php?id_mrk='.$ro['id_mrk'].'"><img src="images/view.png"></a>';
                        
			$str.="<TD>";
		    $str.= "</TR>\n\n\n";
		}
		$str.="</TBODY>";
		$str.="</TABLE>";
		
		
	}
        echo $str;
				?>
	
	</div>
		


</div>

</body>
</html>