<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




include_once("./framework/framework.php");
include_once("./framework/funzioni_web.php");
include_once("./framework/dbSito.php");
$layout = new Layout("");
$debug=false;

 if(isset($_POST['submit'])){
 
    
     $newName=$_POST["new_name"];
     $array_id_old =$_POST['id_citta'];
     echo "new name: ".$newName . "<br>";
     
      $id_provincia_new = inserisci_provincia($newName);
      echo '$id_provincia_new '.  $id_provincia_new . " <br>";
      $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="SELECT * FROM immobile ";
    $r=$db->query($query);
    while($row=  mysql_fetch_array($r)){
        if(in_array($row['id_provincia'], $array_id_old)){
            //SOSTITUISCO
            echo "id del db: ".$row['id_provincia'];
            echo " - trovato nell'array";
            echo "<br>";
            if(!$debug){
             $db2 = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
             $query2="UPDATE immobile SET id_provincia = $id_provincia_new  WHERE id_imm =".$row['id_imm'];
            $db2->queryInsert($query2);
            }else{
                
             }
            
        }
        
    }
    
    foreach ($array_id_old as $id_to_delete){
        if(!$debug){
           $db3 = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
             $query3="DELETE FROM provincia WHERE id_provincia =". $id_to_delete;
            $db3->queryInsert($query3);
        }else{
            
            
        }
    }
     
    // SITO
    
     header("location: gest_provincia_unisci.php");
 
 
 
 
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




<div id="body">
	<div id="head">
		<?php
		
		echo $layout->getHeader();
		echo $layout->getMenu();
		?>
	</div>
	
	
	<div id="center">
		<div id="sx">
		
		
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Gestione provincia: </h2>
	   <p>Attenzione tutte le modifiche saranno applicate a tutti gli immobili e clienti agganciati con la rispettiva citta</p>
			<?php
        	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
        	
        	echo '<form method="post">';
                echo "id selezionati: ";
                echo '<ul>';
                $new_name ="";
foreach ($_POST["id_provincia"] as $selectedOption){
    $query= "select * from provincia where id_provincia = ".$selectedOption;
    $r=$db->query($query);
    $ro=  mysql_fetch_array($r);
    echo '<li>';
    echo $selectedOption ." " . $ro["nome"];
    echo '<input type="hidden" name="id_provincia[]" value="'.$selectedOption.'"/>';
    echo '</li>';
    $new_name=$ro["nome"];
    
   
}

echo '</ul>';
  
        
echo "<br>Nuovo Nome: ";
echo '<input type="text" name="new_name" value="'.$new_name.'"/>';
          echo '<input type="submit" name="submit" value="Unisci"/>';
          echo '</form>';	
        	
   
   ?>
     

</div>

</body>
</html>