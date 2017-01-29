<?php
include_once("./framework/framework.php");

$id_imm="0";

if(isset($_GET["id_imm"])){
    $id_imm=$_GET["id_imm"];
}


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="it">
<head>
<meta http-equiv="Content-Language" content="it">
<title>Invia Email</title>
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
 
    $( "#pubblicita" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "marketing_search.php", {
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
          $( "#id_mrk" ).val( ui.item.id );
          $("#pubblicita").val(ui.item.nome);
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
  </script>
  
</head>
<body>

    <div>
        
        <form action="" method="POST">
            <table>
               
                <tr>
                    <td>Immobile</td>
                    <td>
                         <input id="immobile" name="immobile" size="50" value="<?php if(isset($_GET["id_imm"])) echo $id_imm; ?>">
                         <input type="hidden" readonly id="id_imm" name="id_imm" value="<?php if(isset($_GET["id_imm"])) echo $id_imm; else echo '0'; ?>" size="50">
                    </td>
                </tr>
                <tr>
                    <td>Pubblicita</td>
                    <td> <input id="pubblicita" name="pubblicita" size="50" value="">
                     <input type="hidden" id="id_mrk" name="id_mrk" value="" size="50"></td>
                </tr>
                
                <tr>
                    <td>note pubblicita </td>
                    <td><textarea name="valore" cols="70" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="submit" value="Invia">
                            
                    </td>
                </tr>
                    
            </table>
               
               
            
            
        </form>
        
    </div>
    

<?php
if ($_POST["submit"]=="Invia") {
    
$id_imm = $_POST['id_imm'];
$id_mrk = $_POST['id_mrk'];
$valore = $_POST['valore']; 
      
	$query="INSERT INTO pubblicita VALUES ($id_imm, $id_mrk, '$valore')";
        
                
	$result=$db->queryInsert($query);
	$ro=mysql_fetch_array($result);
        echo "<SCRIPT>\n\n";
	echo "alert(\"Email registrata correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.reload();\n";
	echo "self.close();";
	echo "</SCRIPT>";

	
	
        
	
	
	
	

}
else{
	
}
?>

</body>

</html>
