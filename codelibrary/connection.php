<?php
session_start();
include("dbconfig.php");

$conn = mysqli_connect("DB_SERVER","DB_USER","DB_PASS") or die("Unable to connect to MySQL");
$status = mysqli_select_db("DB_NAME") or die("Failed to select database!");

 ?>