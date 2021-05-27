<?php
session_start();
if(!isset($_SESSION["FIRST_SESSION"])) header("location: index_first.php");
else {
	unset($_SESSION["FIRST_SESSION"]);
	unlink("index_first.php");
	header("location: admin/");
}
?>