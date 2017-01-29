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

/*
echo "<pre>";
print_r($_POST["id_zona"]);
echo "</pre>";

foreach ($_POST["id_zona"] as $selectedOption){
    echo $selectedOption ."";
    
    
}
*/
 if(isset($_POST['submit'])){
 
     /*$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="UPDATE zona SET nome ='".$_GET['nome']."' where id_zona= ".$_GET['id_zona'];
    $r=$db->query($query);
 */
     $newName=$_POST["new_name"];
     $array_id_old =$_POST['id_zona'];
     echo "new name: ".$newName . "<br>";
     
      $id_zona_new = inserisci_zona($newName);
      echo '$id_zona_new '.  $id_zona_new . " <br>";
      $db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
    $query="SELECT * FROM immobile ";
    $r=$db->query($query);
    while($row=  mysql_fetch_array($r)){
        if(in_array($row['id_zona'], $array_id_old)){
            //SOSTITUISCO
            echo "id del db: ".$row['id_zona'];
            echo " - trovato nell'array";
            echo "<br>";
            if(!$debug){
             $db2 = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
             $query2="UPDATE immobile SET id_zona = $id_zona_new  WHERE id_imm =".$row['id_imm'];
            $db2->queryInsert($query2);
            }else{
              echo "<br>";
					$query2="UPDATE immobile SET id_zona = $id_zona_new  WHERE id_imm =".$row['id_imm'];
					echo $query2;
					
             }
            
        }
        
    }
    
    foreach ($array_id_old as $id_to_delete){
        if(!$debug){
           $db3 = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
             $query3="DELETE FROM zona WHERE id_zona =". $id_to_delete;
            $db3->queryInsert($query3);
        }else{
            
            
        }
    }
     
    // SITO
    if(!$debug){
     header("location: gest_zona_unisci.php");
	}else{
		exit;
		
	}
 
 
 
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
		<h2>Gestione zona: </h2>
	   <p>Attenzione tutte le modifiche saranno applicate a tutti gli immobili e clienti agganciati con la rispettiva zona</p>
			<?php
        	$db = new db(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
        	
        	echo '<form method="post">';
                echo "id selezionati: ";
                echo '<ul>';
                $new_name ="";
foreach ($_POST["id_zona"] as $selectedOption){
    $query= "select * from zona where id_zona = ".$selectedOption;
    $r=$db->query($query);
    $ro=  mysql_fetch_array($r);
    echo '<li>';
    echo $selectedOption ." " . $ro["nome"];
    echo '<input type="hidden" name="id_zona[]" value="'.$selectedOption.'"/>';
    echo '</li>';
    $new_name=$ro["nome"];
    
   
}

echo '</ul>';
   /*      
echo "SUL SITO <br>";
$db_sito = new dbSito(DB_USER_SITO,DB_PASSWORD_SITO,DB_NAME_SITO,DB_HOST_SITO);
  echo '<ul>';
foreach ($_POST["id_zona"] as $selectedOption){
    $query_sito ="SELECT * FROM zona WHERE id_zona = ".$selectedOption;
    $r_sito = $db_sito->query($query_sito);
    $ro_sito=  mysql_fetch_array($r_sito);
    echo '<li>';
    echo $selectedOption ." " . $ro_sito["nome"];
  
    echo '</li>';
 
}
  echo '</ul>';   
    * 
    * */
        
echo "<br>Nuovo Nome: ";
echo '<input type="text" name="new_name" value="'.$new_name.'"/>';
          echo '<input type="submit" name="submit" value="Unisci"/>';
          echo '</form>';	
        	
   
   ?>
     

</div>

</body>
</html>