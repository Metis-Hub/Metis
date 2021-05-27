<?php
session_start();
if(!isset($_SESSION["FIRST_SESSION"]))
header("location: index_first.php");
unlink("index_first.php");
header("location: admin/")
?>