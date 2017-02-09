<?php session_start();
$_SESSION['sess_admin']="";
session_destroy();
header("location:login.php");
exit();