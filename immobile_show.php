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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" > <!-- -->
<link rel="stylesheet" type="text/css" href="gestimm2_.css">

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
 	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="chromejs/chrome.js"/>
 <link href="notes/css/bootstrap.min.css" rel="stylesheet">
<link href="notes/css/bootstrap-reset.css" rel="stylesheet">
<link href="notes/css/style.css" rel="stylesheet">
	

<script src="http://code.jquery.com/jquery-latest.js"></script>
<!--[if lt IE 9]><script src="notes/js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
 $('#example2').DataTable();
} );            
 </script>
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
		
		$cont1="";
               // $cont1.='<a href="upload/index.php?id_imm='.$id_imm.'"><img src="images/mod.gif" class="img_menu_sx">Carica Immagini</a><br/>';
                $cont1.='<a href="immagine_add.php?azione=add&id_imm='.$id_imm.'"><img src="images/mod.gif" class="img_menu_sx">Carica Immagini</a><br/>';
		$cont1.='
                    <a href="documento_add.php?azione=add&id_imm='.$id_imm.'"><img src="images/doc_add.gif" class="img_menu_sx">Carica Documenti</a><br/>
                    <a href="immobile_add.php?azione=mod&id_imm='.$id_imm.'"><img src="images/mod.gif" class="img_menu_sx">Modifica Immobile</a><br/>
                    <a href="immobile_pdf.php?id_imm='.$id_imm.'"><img src="images/pdf.png" class="img_menu_sx">Stampa scheda</a><br/>    
                        <a href="immobile_pdf_email.php?id_imm='.$id_imm.'"><img src="images/pdf.png" class="img_menu_sx">Invia scheda</a><br/>    
                    <a href="immagine_gest.php?azione=mod&id_imm='.$id_imm.'"><img src="images/mod.gif" class="img_menu_sx">Gestisci Foto</a><br/>
                    <a href="documento_gest.php?azione=mod&id_imm='.$id_imm.'"><img src="images/mod.gif" class="img_menu_sx">Gestisci Documenti</a><br/>
                    <a href=""><img src="images/stampa.gif" class="img_menu_sx">Stampa l\'immobile</a><br/>
                    <a href="sito_carica_immobile.php?azione=mod&id_imm='.$id_imm.'"><img src="images/web.gif" class="img_menu_sx">carica su sito</a><br/>
                    <a href="immobile_del.php?id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'no\');return false;"><img src="images/cancella.gif" class="img_menu_sx">Cancella Immobile</a><br/>
                        <a href="email_add.php?azione=add&id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'800\',\'550\',\'yes\');return false;"><img src="images/add.gif" class="img_menu_sx">Invia Email</a><br/>';
                

                
if(immVenduto($id_imm)!=2){                
if(immArchiviato($id_imm)==1 ){            
       $cont1.='<a href="immobile_ripristina.php?id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'no\');return false;">Ripristina Immobile</a><br/>';
}else{

$cont1.='<a href="immobile_archivia.php?id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'no\');return false;"><img src="images/archivia.png" class="img_menu_sx">Archivia Immobile</a><br/>';
}
}
if(immVenduto($id_imm)==2){            
       $cont1.='<a href="immobile_venduto_ripristina.php?id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'no\');return false;">Ripristina Immobile Venduto</a><br/>';
}else{

$cont1.='<a href="immobile_vendi.php?id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'yes\');return false;"><img src="images/vendi.jpg" class="img_menu_sx">Vendi Immobile</a><br/>';
}
$cont1.='<a href="immobile_visitatori.php?id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'500\',\'350\',\'yes\');return false;"><img src="images/visitatori_clienti.png" class="img_menu_sx">Aggiungi visitatori</a><br/>';			
			
	$cont1.=' <a href="marketing_imm_add.php?azione=add&id_imm='.$id_imm.'" onclick="NewWindow(this.href,\'pg_center\',\'800\',\'550\',\'yes\');return false;"><img src="images/add.gif" class="img_menu_sx">Aggiungi Pubblicita</a><br/>';		
			
			$menu_sx = new Menu_Sx($cont1);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Scheda Immobile</h2>
			<?php 
			
			echo scheda_immobile($id_imm);
			echo "<br>";
			echo box_img_immobile($id_imm);
			echo "<br>";
			echo box_doc_immobile($id_imm);
			echo "<br>";
			$id_cli = id_imm_to_id_cli($id_imm);
			echo scheda_cliente($id_cli);	
                        
			                        
                        echo "<br>Venduto a";
                        $id_acquirente = id_acquirente($id_imm);
                        
                       echo scheda_cliente($id_acquirente);	
			?>
	
	</div>
		
	<div id="dx" style="width: 450px">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Note:</h2>
                <div class="col-md-4" style="margin:0 auto;float:none !important; margin-top:50px;margin-bottom:60px">
<div class="col-md-4 event-list-block">
			<ul class="event-list">
<?php 
include("notes_gest.php");
loadnotes($id_imm); ?>	
</ul>
    <input type="text" size="50"  class="form-control evnt-input" placeholder="NOTES">
<input type="hidden" id="id_imm" name="id_imm" value="<?php echo $id_imm; ?>"/>	
	</div>

</div></div>
        
        <div id="dx" style="width: 450px">
		
		<h2>Clienti Portati a visitare:</h2>
                <div class="col-md-4" style="margin:0 auto;float:none !important; margin-top:50px;margin-bottom:60px">
<div class="col-md-4 event-list-block">
			<ul class="event-list-">
<?php

 $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="select * from immobile_visite where id_imm=$id_imm order by id_visita desc";
      $result=$db->query($query);
	
	
	while($fetch = mysql_fetch_array($result))
	{
echo '<li id="'.$fetch['id_visita'].'" > ';
echo "<strong>chi " . nominativo_stampa($fetch['id_cli']);
echo " ";
echo "data: " .$fetch['data'];
echo " </strong><br>";
echo $fetch['note'];
if($fetch['inserito_da']==$_SESSION["id_utente"])
echo '<a href="#"class="visita-close"> &#10005; </a>';
echo '</li>';
	
	}


?>
                       
</ul>
    
	</div>

</div></div>    
       
        <div id="dx" style="width: 750px">
		
		<h2>Email legate all'immobile:</h2>
               
		
	<table width="100%" class="display" id="example" cellspacing="0">
        <thead>
            <tr>
                <th>Destinatario</th>
                <th>Inviato da</th>
                <th>Oggetto</th>
                <th>corpo</th>
                
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
               
                <th>id_cli</th>
                <th>id_ric</th>
                <th>data Invio</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            if($_SESSION["id_utente"]==1){
                $q="SELECT * FROM email WHERE id_imm=$id_imm ";
            }else{
                $q="SELECT * FROM email WHERE id_imm=$id_imm and inviata_da =".$_SESSION["id_utente"];
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
       <div id="dx" style="width: 450px">
		
		<h2>Richieste Immobile:</h2>
               

                 <?php
                
                  echo lista_ricerca_richieste_immobile($id_imm);
                  
                  echo lista_ricerca_richieste_immobile($id_imm,true);
                 ?>
                 

    
	</div> 
    <div id="dx" style="width: 750px">
		
		<h2>Immobili in pubblicità qui</h2>
               
		
	<table width="100%" class="display" id="example2" cellspacing="0">
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
            
                $q="SELECT * FROM pubblicita WHERE id_imm=$id_imm";
            
            
	$r=$db->query($q);
        if($r){
            while($ro=mysql_fetch_array($r)){
                echo '<tr>';



                echo '<td>';
              
                echo '<a target="_blank"  href="marketing_show.php?id_mrk='.$ro['id_mrk'].'">';
                echo marketing_nome_stampa($ro['id_mrk']);
                echo '</a>';
               
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

<script src="notes/js/bootstrap.min.js"></script>
<script src="notes/js/jquery.slimscroll.js"></script>
<script src="notes/js/script.js"></script>
<script src="immobile_visite.js"></script>
</body>
</html>