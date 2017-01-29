<?php

include_once("./framework/framework.php");
include_once("inc.js_popup.php");
$layout = new Layout("");
//$month=$_GET['month'];
//$year=$_GET['year'];


//header("Location: nota_index.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $title_html . " - " . $nome_azienda; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="gestimm2_.css">

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/datatables.min.js"></script>
<script type="text/javascript" src="chromejs/chrome.js">

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<?php 
echo $menu_fix; 
//include_once("./framework/inc.js_menu_sx.php"); 
?>
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
	
		<div id="dx">


<table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            
             </tbody>
    </table>


		<?php 
		//If $month is not present, set it to current month.
//$month = (empty($month)) ? date("n") : $month;

//If $year is not present, set it to current year.
//$year = (empty($year)) ? date("Y") : $year;

//print_calendar($month,$year);
		
		
		?>
		</div>
	
	</div>
		


</div>

</body>
</html>