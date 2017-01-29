<?php

include_once("./framework/framework.php");
$idArray = explode(",",$_POST['ids']);  

  $count = 1;
        foreach ($idArray as $id){
            
            
            $query="UPDATE `immagine` SET `ordine` = $count WHERE id_img = $id";
            $update= $db->queryInsert($query);
            //$update = mysqli_query($this->connect,"UPDATE `images` SET `order` = $count WHERE id = $id");
            $count ++;    
        }
        return true;

?>