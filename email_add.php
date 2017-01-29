<?php
include_once("./framework/framework.php");

$id_imm="0";
$id_ric="0";
$id_cli="0";
if(isset($_GET["id_imm"])){
    $id_imm=$_GET["id_imm"];
}
if(isset($_GET["id_cli"])){
    $id_cli=$_GET["id_cli"];
    //id cli to email
    $cli_email = id_cli_to_email($id_cli);
}
if(isset($_GET["id_ric"])){
    $id_ric=$_GET["id_ric"];
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
 
    $( "#cliente" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "cliente_search.php", {
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
          $( "#id_cli" ).val( ui.item.id );
          $("#inviata_a").val(ui.item.email);
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
  </script>
  <script>
  $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#immobile" )
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
  <script>
  $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#richiesta" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "richiesta_search.php", {
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
          $( "#id_ric" ).val( ui.item.id );
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
                    <td>Cliente</td>
                    <td>
                        
                        <input id="cliente" name="nominativo" size="50" value="<?php if(isset($_GET["id_cli"])) echo $id_cli; ?>">
                        <input type="hidden" id="id_cli" name="id_cli" value="<?php if(isset($_GET["id_cli"])) echo $id_cli; else echo '0';?>" size="50">
                    </td>
                </tr>
                <tr>
                    <td>Immobile</td>
                    <td>
                         <input id="immobile" name="immobile" size="50" value="<?php if(isset($_GET["id_imm"])) echo $id_imm; ?>">
              <input type="hidden" id="id_imm" name="id_imm" value="<?php if(isset($_GET["id_imm"])) echo $id_imm; else echo '0'; ?>" size="50">
                    </td>
                </tr>
                <tr>
                    <td>Richiesta</td>
                    <td> <input id="richiesta" name="richiesta" size="50" value="<?php if(isset($_GET["id_ric"])) echo $id_ric; ?>">
              <input type="hidden" id="id_ric" name="id_ric" value="<?php if(isset($_GET["id_ric"])) echo $id_ric; else echo '0'; ?>" size="50"></td>
                </tr>
                <tr>
                    <td>Invia a</td>
                    <td><input type="text" name="inviata_a" id="inviata_a" value="<?php if(isset($_GET["id_cli"])) echo $cli_email; else echo ''; ?>" size="70" ></td>
                </tr>
                <tr>
                    <td>Oggetto</td>
                    <td><input type="text" name="oggetto" size="100" value=""></td>
                </tr>
                <tr>
                    <td>contenuto email</td>
                    <td><textarea name="corpo" cols="70" rows="10"></textarea></td>
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
    

        
        if(!is_null($_POST['id_cli']))
            $id_cli = $_POST['id_cli'];
        else
            $id_cli=0;
        if(!is_null($_POST['id_imm']))
            $id_imm = $_POST['id_imm'];
        else
            $id_imm=0;
         if(!is_null($_POST["id_ric"]))
            $id_ric = $_POST["id_ric"];
         else
             $id_ric=0;
         
         
        $inviata_da =$_SESSION["id_utente"];
        $inviata_a=$_POST["inviata_a"];
        $oggetto = $_POST["oggetto"];
        $corpo = $_POST["corpo"];
        $allegati ="no";
        $inviata_il = time();
       
         
        $email_replyto = idUtenteToEmail($_SESSION["id_utente"]);
        $email_replyto_name = idUtenteToNome($_SESSION["id_utente"]);
        
        
        
        
        
        
        
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require './PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "bellatrix.dnshigh.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->SMTPSecure = "ssl";

$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "gestionale@immobiliarerinaldelli.com";
//Password to use for SMTP authentication
$mail->Password = "Albertosordi1_";
//Set who the message is to be sent from
$mail->setFrom('info@immobiliarerinaldelli.com', 'Immobiliare Rinaldelli');
//Set an alternative reply-to address


$mail->addReplyTo($email_replyto, $email_replyto_name);
//Set who the message is to be sent to
$mail->addAddress($inviata_a, '');
//Set the subject line
$mail->Subject = $oggetto;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body



//$mail->msgHTML(file_get_contents('PHPMailer/examples/contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file




//$mail->addAttachment('PHPMailer/examples/images/phpmailer_mini.png');

$mail->Body =$corpo;
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
   /**
	 * recupero il percorso del file
	 */
	$query="INSERT INTO email VALUES (null,'$inviata_da','$inviata_a','$oggetto','$corpo','$allegati','$inviata_il',$id_imm,$id_cli,$id_ric)";
        
                
	$result=$db->queryInsert($query);
	$ro=mysql_fetch_array($result);
        echo "<SCRIPT>\n\n";
	echo "alert(\"Email registrata correttamente. Clicca ok per proseguire\");\n";
	echo "window.opener.location.reload();\n";
	echo "self.close();";
	echo "</SCRIPT>";
}

	
	
        
	
	
	
	

}
else{
	
}
?>

</body>

</html>
