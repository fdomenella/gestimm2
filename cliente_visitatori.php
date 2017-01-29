<?php
include_once("./framework/framework.php");

if (isset($_GET['id_cli'])) {
	
	$id_cli = $_GET['id_cli'];
}
else {
	echo "<script> window.close(); </script>";
	exit;
}





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Aggiungi Visitatori</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="ui.theme.css" type="text/css"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="gestimm2_.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

  <script>

  $( function() {

     $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();

  } );

  </script>


  <style>
  .ui-autocomplete-loading {
    background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  </style>
  <script>
  $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#birds" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "immobile_search.php", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
            
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
         terms.push( "" );
          $( "#id_imm" ).val( ui.item.id );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
  </script>
</head>

<?php
$str="";
$str.='<form action="" method="GET">';
		$str.= "<div class=\"clienti\">";
		$str.= "<TABLE id=\"clienti\">\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		//$str.="Vendi Immobile $id_imm";
                $str.="<input type=\"hidden\" id=\"id_cli\" name=\"id_cli\" value=\"".$id_cli."\" size=\"50\">";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Immobile:";
		$str.="</td>\n";
		$str.="</tr>\n";
                $str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="<input id=\"birds\" name=\"id_imm\" size=\"50\">"; //nominativo
              $str.="<input type=\"hidden\" id=\"id_imm\" name=\"id_imm\" value=\"\" size=\"50\">"; //id_cli
              
		$str.="</td>\n";
		$str.="</tr>\n";
                $str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="data visita";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.='<input type="text" name="data" id="datepicker"/>';
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
                 $str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
		$str.="Note";
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.="<tr>\n";
		$str.="<td colspan=\"2\" class=\"clienti_header\">\n";
                $str.='<textarea name="note" rows="5" cols="40">';
                $str.='</textarea>';
		
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.= "<TR>\n";
		$str.="<td>\n";
		$str.='<input type="submit" name="submit" value="visita"/>';
		$str.="</td>\n";
		$str.="</tr>\n";
		$str.="</form>";
		$str.= "</TABLE>";
		
		$str.="</div>";



?>
<body>
<?php
if ($_GET['submit']=="visita") {
    
    
        $inserito_da =$_SESSION["id_utente"];
        $id_imm = $_GET['id_imm'];
        $data_visita = $_GET['data'];
        $note = $_GET['note'];
	/**
	 * recupero il percorso del file
	 */
	$query="INSERT INTO immobile_visite VALUES (null,$id_imm,$id_cli,'$data_visita','$note',$inserito_da)";
     
	$result=$db->queryInsert($query);
	$ro=mysql_fetch_array($result);
	
        
	
	
	echo "<SCRIPT>\n\n";
	echo "alert(\"Visita registrata correttamente correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.href=\"cliente_show.php?id_cli=$id_cli\";\n";
	echo "self.close();";
	echo "</SCRIPT>";
	

}
else{
	echo $str;
}
?>

</body>

</html>
