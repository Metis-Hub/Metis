<?php
	$str = $_SERVER["REQUEST_URI"];
	$strl = strlen($str) - 9;
	if($strl == strpos($str, "index.php")) header("location: http://" . $_SERVER["SERVER_NAME"] . substr($str, 0, $strl));
?>