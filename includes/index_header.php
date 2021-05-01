<?php
	include "std_session.php";
	include("user.php");
	if(!isLoggedIn()) header("Location: ./../index/index.php?error=you_not_logged_in");
	header("location: home/");
?>