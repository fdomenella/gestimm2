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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="gestimm2_.css">

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
<link href="css/style_immagini_gest.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="chromejs/chrome.js">


<?php 
echo $menu_fix; 

include_once("inc.js_sortTable.php"); 
include_once("inc.js_popup.php");
?>
<script type="text/javascript" src="row_highLight.js"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('.reorder_link').on('click',function(){
		$("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
		$('.reorder_link').html('save reordering');
		$('.reorder_link').attr("id","save_reorder");
		$('#reorder-helper').slideDown('slow');
		$('.image_link').attr("href","javascript:void(0);");
		$('.image_link').css("cursor","move");
		$("#save_reorder").click(function( e ){
			if( !$("#save_reorder i").length )
			{
				$(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
				$("ul.reorder-photos-list").sortable('destroy');
				$("#reorder-helper").html( "Reordering Photos - This could take a moment. Please don't navigate away from this page." ).removeClass('light_box').addClass('notice notice_error');
	
				var h = [];
				$("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
				$.ajax({
					type: "POST",
					url: "immagine_gest_ordine_save.php",
					data: {ids: " " + h + ""},
					success: function(html) 
					{
						window.location.reload();
						/*$("#reorder-helper").html( "Reorder Completed - Image reorder have been successfully completed. Please reload the page for testing the reorder." ).removeClass('light_box').addClass('notice notice_success');
						$('.reorder_link').html('reorder photos');
						$('.reorder_link').attr("id","");
                                                */
					}
					
				});	
				return false;
			}	
			e.preventDefault();		
		});
	});
	
});
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
		
			
		$cont1='<a href="immagine_add.php?azione=add&id_imm='.$id_imm.'"><img src="images/mod.gif" class="img_menu_sx">Carica Immagini</a><br/>';
			
			
			
			
			$menu_sx = new Menu_Sx($cont1);
			echo $menu_sx->getMenuSx();
			?>
		</div>
		<div id="dx">
		<?php
		include("inc.tornaindietro.php");
		?>
		<h2>Immagini dell'immobile: <?php echo $id_imm; ?></h2>
                <div style="margin-top:50px;">
	<a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">reorder photos</a>
    <div id="reorder-helper" class="light_box" style="display:none;">1. Drag photos to reorder.<br>2. Click 'Save Reordering' when finished.</div>
    <div class="gallery">
        <ul class="reorder_ul reorder-photos-list">
        <?php 
			//Fetch all images from database
			$rows = immagini_get($id_imm);
			foreach($rows as $row): ?>
            <li id="image_li_<?php echo $row['id_img']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><img src="<?php echo $row['low_res']; ?>" alt=""></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
			<?php 
			echo "<h2>Gestisci Immagini</h2>";
			echo immagini_gest($id_imm);
			
			?>
	
	</div>
		


</div>

</body>
</html>