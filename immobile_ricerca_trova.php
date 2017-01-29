<?php

include_once("./framework/framework.php");

$layout = new Layout("");

/**
 * 
 * CONFIGURAZIONI GLOBALI DEI CRITERI
 * 
 * 
 */
		$mq_inmeno=20; // i metri quadri che sottraggo ai dati dal db per la ricerca
		$mq_inpiu=20;
		$prezzo_inmeno = 20000;
		$prezzo_inpiu= 10000;
		
		$num_piani_inmeno=1;
		$num_piani_inpiu=1;
		$num_bagni_inmeno=1;
		$num_bagni_inpiu=1;
		$num_camere_inmeno=2;
		$num_camere_inpiu=2;

		$tipo_ricerca=1; // imposto il tipo di ricerca per la  RICERCA MANUALE
		

if (isset($_GET['id_ric'])) {
		
	/**
	 * 	 
	 * QUESTE OPERAZIONI VENGONO FATTE SOLO SE LA RICERCA � FATTA TRAMITE RICHIESTA DA DB
	 *
	 */
	
	/**
		 * 
		 * imposto la ricerca da db se mirata oppure no
		 * 1=> mirata
		 * 0=> non mirat
		 * 
		 */
		$tipo_ricerca=0;  // imposto il tipo di ricerca per la  RICERCA DAL DATABASE
	
	
	
	$id_ric=$_GET['id_ric'];
	
	$q="SELECT * FROM richiesta WHERE id_ric=$id_ric";
	$r=$db->query($q);
	$ro=mysql_fetch_array($r);
	
	
	if($ro['id_tipo_locazione']==null){
	
		$querylocazione = "";
	}
	else{
		$querylocazione = "id_tipo_locazione  = $ro[id_tipo_locazione] AND";
	}
	
	/**
	 * considerare nella query pi� tipologie 
	 */
	
	$q_tipo="SELECT * FROM ric_tipo_imm WHERE id_ric = $id_ric";
	$r_tipo=$db->query($q_tipo);
	if (mysql_num_rows($r_tipo)>0) {

		$querytipoimmobile= "";
		while ($ro_tipo=mysql_fetch_array($r_tipo)) {
			$querytipoimmobile .= "id_tipo_immobile = $ro_tipo[id_tipo_immobile] OR ";
		}
		
		
		
		/**
		 * devo rimuovere l'ultimo OR
		 */
		$querytipoimmobile=trim($querytipoimmobile);
		$l=strlen($querytipoimmobile);
		$querytipoimmobile = substr_replace($querytipoimmobile,"",$l-2);
		$querytipoimmobile.= " AND";
	
	}else {
		$querytipoimmobile="";
	}
	
	if($ro['id_provincia']==null){
		$queryprovincia = "";
	}
	else{
		$queryprovincia = "id_provincia  = $ro[id_provincia] AND";
	}
	
	if($ro['id_comune']==null){
		$querycitta = "";
	}
	else{
		$querycitta = "id_comune  = $ro[id_comune] AND";
	}
		
	
	if ($tipo_ricerca==1) {
			
		
		if($ro['mq_min']==null and $ro['mq_max']==null){
			$querymq = "";
		}
		elseif ($ro['mq_min']!="" and $ro['mq_max']!=""){
			$querymq = "mq  >= $ro[mq_min] and mq <= $ro[mq_max] AND";
		}
		elseif ($ro['mq_min']!=""){
			$querymq = "mq  >= $ro[mq_min] and";
			
		}else{
			$querymq = "mq <= $ro[mq_max] AND";
		}
		
		if($ro['prezzo_min']==null and $ro['prezzo_max']==null){
			$queryprezzo = "";
		}
		elseif ($ro['prezzo_min']!="" and $ro['prezzo_max']!=""){
			$queryprezzo = "prezzo  >= $ro[prezzo_min] and prezzo <= $ro[prezzo_max] AND";
		}
		elseif ($ro['prezzo_min']!=""){
			$queryprezzo = "prezzo  >= $ro[prezzo_min] and";
			
		}else{
			$queryprezzo = "prezzo <= $ro[prezzo_max] AND";
		}
		
		
		if($ro['id_garage']==null){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $ro[id_garage] AND";
		}
		
                if($ro['id_zona']==null){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $ro[id_zona] AND";
		}
                
		if($ro['num_piani']==null){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani = $ro[num_piani] AND";
		}
		if($ro['num_bagni']==null){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  = $ro[num_bagni] AND";
		}
		if($ro['num_camere']==null){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  = $ro[num_camere] AND";
		}
		
		if($ro['id_stato']==null){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $ro[id_stato] AND";
		}
	}else {
		/**
		 * ricerca sommaria
		 */
		if($ro['mq_min']==null and $ro['mq_max']==null){
			$querymq = "";
		}
		elseif ($ro['mq_min']!=null and $ro['mq_max']!=null){
			$querymq = "mq  >= $ro[mq_min]-$mq_inmeno and mq <= $ro[mq_max]+$mq_inpiu AND";
		}
		elseif ($ro['mq_min']!=null){
			$querymq = "mq  >= $ro[mq_min]-$mq_inmeno and";
			
		}else{
			$querymq = "mq <= $ro[mq_max]+$mq_inpiu AND";
		}
		
		if($ro['prezzo_min']==null and $ro['prezzo_max']==null){
			$queryprezzo = "";
		}
		elseif ($ro['prezzo_min']!=null and $ro['prezzo_max']!=null){
			$queryprezzo = "prezzo  >= $ro[prezzo_min]-$prezzo_inmeno and prezzo <= $ro[prezzo_max]+$prezzo_inpiu AND";
		}
		elseif ($ro['prezzo_min']!=null){
			$queryprezzo = "prezzo  >= $ro[prezzo_min]-$prezzo_inmeno and";
			
		}else{
			$queryprezzo = "prezzo <= $ro[prezzo_max]+$prezzo_inpiu AND";
		}
		
		
		if($ro['id_garage']==null){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $ro[id_garage] AND";
		}
                
                if($ro['id_zona']==null){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $ro[id_zona] AND";
		}
		if($ro['num_piani']==null){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani  >= $ro[num_piani]-$num_piani_inmeno and num_piani <= $ro[num_piani]+$num_piani_inpiu AND";
		}
		if($ro['num_bagni']==null){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  >= $ro[num_bagni]-$num_bagni_inmeno and num_bagni  <= $ro[num_bagni]+$num_bagni_inpiu AND";
		}
		if($ro['num_camere']==null){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  >= $ro[num_camere]-$num_camere_inmeno and num_camere  <= $ro[num_camere]+$num_camere_inpiu AND";
		}
		
		if($ro['id_stato']==null){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $ro[id_stato] AND";
		}
	}
	
	
}
/**
 * 
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 * ###################################################################################################
 */


else {
	
	/**
	 * 
	 *QUESTE OPERAZIONI VENGONO FATTE SOLO SE L'UTENTE HA EFFETTUATO UNA RICERCA MANUALE 
	 * 
	 */
	$id_ric="";
	

	
	if($_GET['id_tipo_locazione']=="all"){
	
		$querylocazione = "";
	}
	else{
		$querylocazione = "id_tipo_locazione  = $_GET[id_tipo_locazione] AND";
	}
	
	
	if($_GET['id_tipo_immobile']=="all"){
		$querytipoimmobile = "";
	}
	else{
		$querytipoimmobile = "id_tipo_immobile  = $_GET[id_tipo_immobile] AND";
	}
	
	if($_GET['id_provincia']=="all"){
		$queryprovincia = "";
	}
	else{
		$queryprovincia = "id_provincia  = $_GET[id_provincia] AND";
	}
	
	if($_GET['id_citta']=="all"){
		$querycitta = "";
	}
	else{
		$querycitta = "id_comune  = $_GET[id_citta] AND";
	}
		
	
	if ($_GET['tipo_ricerca']==1) {
			
		
		if($_GET['mq_min']=="" and $_GET['mq_max']==""){
			$querymq = "";
		}
		elseif ($_GET['mq_min']!="" and $_GET['mq_max']!=""){
			$querymq = "mq  >= $_GET[mq_min] and mq <= $_GET[mq_max] AND";
		}
		elseif ($_GET['mq_min']!=""){
			$querymq = "mq  >= $_GET[mq_min] and";
			
		}else{
			$querymq = "mq <= $_GET[mq_max] AND";
		}
		
		if($_GET['prezzo_min']=="" and $_GET['prezzo_max']==""){
			$queryprezzo = "";
		}
		elseif ($_GET['prezzo_min']!="" and $_GET['prezzo_max']!=""){
			$queryprezzo = "prezzo  >= $_GET[prezzo_min] and prezzo <= $_GET[prezzo_max] AND";
		}
		elseif ($_GET['prezzo_min']!=""){
			$queryprezzo = "prezzo  >= $_GET[prezzo_min] and";
			
		}else{
			$queryprezzo = "prezzo <= $_GET[prezzo_max] AND";
		}
		
		
		if($_GET['id_garage']=="all"){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $_GET[id_garage] AND";
		}
                
                if($_GET['id_zona']=="all"){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $_GET[id_zona] AND";
		}
		
		if($_GET['num_piani']==""){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani = $_GET[num_piani] AND";
		}
		if($_GET['num_bagni']==""){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  = $_GET[num_bagni] AND";
		}
		if($_GET['num_camere']==""){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  = $_GET[num_camere] AND";
		}
		
		if($_GET['id_stato']=="all"){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $_GET[id_stato] AND";
		}
                if($_GET['al_piano']==""){
			$queryal_piano = "";
		}
		else{
			$queryal_piano = "al_piano like '%$_GET[al_piano]%' AND";
		}
                  if($_GET['via']==""){
			$queryvia = "";
		}
		else{
			$queryvia = "via like '%$_GET[via]%' AND";
		}
	}else {
		/**
		 * ricerca sommaria
		 */
		if($_GET['mq_min']=="" and $_GET['mq_max']==""){
			$querymq = "";
		}
		elseif ($_GET['mq_min']!="" and $_GET['mq_max']!=""){
			$querymq = "mq  >= $_GET[mq_min]-$mq_inmeno and mq <= $_GET[mq_max]+$mq_inpiu AND";
		}
		elseif ($_GET['mq_min']!=""){
			$querymq = "mq  >= $_GET[mq_min]-$mq_inmeno and";
			
		}else{
			$querymq = "mq <= $_GET[mq_max]+$mq_inpiu AND";
		}
		
		if($_GET['prezzo_min']=="" and $_GET['prezzo_max']==""){
			$queryprezzo = "";
		}
		elseif ($_GET['prezzo_min']!="" and $_GET['prezzo_max']!=""){
			$queryprezzo = "prezzo  >= $_GET[prezzo_min]-$prezzo_inmeno and prezzo <= $_GET[prezzo_max]+$prezzo_inpiu AND";
		}
		elseif ($_GET['prezzo_min']!=""){
			$queryprezzo = "prezzo  >= $_GET[prezzo_min]-$prezzo_inmeno and";
			
		}else{
			$queryprezzo = "prezzo <= $_GET[prezzo_max]+$prezzo_inpiu AND";
		}
		
		
		if($_GET['id_garage']=="all"){
			$querygarage = "";
		}
		else{
			$querygarage = "id_garage  = $_GET[id_garage] AND";
		}
                
                if($_GET['id_zona']=="all"){
			$queryzona = "";
		}
		else{
			$queryzona = "id_zona  = $_GET[id_zona] AND";
		}
                
                
		if($_GET['num_piani']==""){
			$querynum_piani = "";
		}
		else{
			$querynum_piani = "num_piani  >= $_GET[num_piani]-$num_piani_inmeno and num_piani <= $_GET[num_piani]+$num_piani_inpiu AND";
		}
		if($_GET['num_bagni']==""){
			$querynum_bagni = "";
		}
		else{
			$querynum_bagni = "num_bagni  >= $_GET[num_bagni]-$num_bagni_inmeno and num_bagni  <= $_GET[num_bagni]+$num_bagni_inpiu AND";
		}
		if($_GET['num_camere']==""){
			$querynum_camere = "";
		}
		else{
			$querynum_camere = "num_camere  >= $_GET[num_camere]-$num_camere_inmeno and num_camere  <= $_GET[num_camere]+$num_camere_inpiu AND";
		}
		
		if($_GET['id_stato']=="all"){
			$queryid_stato = "";
		}
		else{
			$queryid_stato = "id_stato  = $_GET[id_stato] AND";
		}
                if($_GET['al_piano']==""){
			$queryal_piano = "";
		}
		else{
			$queryal_piano = "al_piano like '% $_GET[al_piano] %' AND";
		}
                 if($_GET['via']==""){
			$queryvia = "";
		}
		else{
			$queryvia = "via like '%$_GET[via]%' AND";
		}
	}
	
	
}












$query="SELECT * FROM immobile WHERE archiviato = 0 AND $querylocazione $querytipoimmobile $queryprovincia $querycitta $querymq
$querygarage $queryzona $queryprezzo $querynum_bagni $querynum_piani $queryal_piano $querynum_camere $queryid_stato $queryvia";
//echo $query;
$s=strlen(trim($query));

$query = substr_replace($query,"",$s-3);




/**
 * qui posso inserire un possibile ordinamento
 */

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $title_html . " - " . $nome_azienda; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="gestimm2_.css">

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />


<!-- Add jQuery library -->
	<script type="text/javascript" src="./francy/lib/jquery-1.9.0.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="./francy/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./francy/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="./francy/source/jquery.fancybox.css?v=2.1.4" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./francy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="./francy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./francy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="./francy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="./francy/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
        
<script type="text/javascript" src="chromejs/chrome.js">
<?php 
echo $menu_fix; 

include_once("inc.js_sortTable.php"); 
include_once("inc.js_popup.php");
?>
<script type="text/javascript" src="row_highLight.js"></script>

<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
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
		
			
		$cont='<a href="immobile_ricerca.php"><img src="images/add.gif" class="img_menu_sx">Nuova Ricerca</a><br/>';
			
			$menu_sx = new Menu_Sx($cont);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
			
			<h2>Ricerca Immobili</h2>
			
				<?php
				if ($id_ric!="") {
					echo scheda_richiesta($id_ric);
					
					echo scheda_cliente(id_ric_to_id_cli($id_ric));
				}
				
				
					echo lista_ricerca($query);
				?>
		  
	
	
	</div>
		


</div>

</body>
</html>