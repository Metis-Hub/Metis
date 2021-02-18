<?php
session_start();
$_SESSION["called"] = true;
header("Location: ./../index/");
?>