<?php
session_start();
session_regenerate_id(false);
unset($_SESSION["user"]);
header('Location: ../index/');
?>