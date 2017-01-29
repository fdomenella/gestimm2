<?php
include_once("./framework/framework.php");

$user = strtolower(trim($_POST['username']));
$pass = strtolower(trim($_POST['password']));



$query="select * from utente where username= '$user' and password = '$pass'";
//error_log("user: ".$user);
$result=$db->query($query);
//error_log("pass: ".$pass);     

if (!$result) {
	header("location: index2.htm");
	exit;
}
else{
	$row=mysql_fetch_array($result);
	$_SESSION['type_user'] = "admin";
	$_SESSION['id_utente'] = $row['id_utente'];
	$_SESSION['username']=$row['username'];
	$_SESSION['ip']=$_SERVER["REMOTE_ADDR"];

	$query="INSERT INTO accessi_utente VALUES(null,$_SESSION[id_utente],now(),'$_SESSION[ip]')";
	$result=$db->queryInsert($query);

	header("location: index.php");
	exit;
}

	header("location: index.htm");

?>