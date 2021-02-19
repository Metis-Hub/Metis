<?php
session_start();
$data = array("uname" => false, "pwd" => false);
$_SESSION["user"] = $data;
$_SESSION["called"] = true;
header("Location: ./../index/");
?>