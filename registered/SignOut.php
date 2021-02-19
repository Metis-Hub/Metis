<?php
session_start();
unset($_SESSION["user"]);
$_SESSION["called"] = true;
header("Location: ./../index/");
?>