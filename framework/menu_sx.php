<?php

class Menu_Sx{
	
	
	var $menu_sx;

	

	
	function __construct($cont1="Nessuna Disponibile"){
		$this->menu_sx='<div id="menu_sx">';
		$this->menu_sx.="<strong>Opzioni Disponibili</strong><br/><hr/>";
		$this->menu_sx.=$cont1;
		$this->menu_sx.='</div>';
		
	}
	
	function getMenuSx(){
		return $this->menu_sx;
	}


}


?>