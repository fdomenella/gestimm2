<?php
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/favicon.html">
<title>Notes app using jQuery, Ajax and PHP - jQuery Ajax PHP</title>
 
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<script src="http://code.jquery.com/jquery-latest.js"></script>
<!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="demo-header"></div>
<center><h2>I bet you will love this easy interface.</h2></center>
<div class="col-md-4" style="margin:0 auto;float:none !important; margin-top:50px;margin-bottom:60px">
<div class="col-md-12 event-list-block">
<div class="cal-day">
<span>Today</span>
<?php echo date('l');?>
</div>
<ul class="event-list">
<?php loadnotes(); ?>
</ul>
<input type="text" class="form-control evnt-input" placeholder="NOTES">
</div>
</div>
<footer>
<a href="http://www.jqueryajaxphp.com/simple-notes-app-using-jquery-ajax-php">Tutorial: Simple notes app using jQuery, Ajax and PHP</a>
</footer>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/script.js"></script>
</body>
</html>