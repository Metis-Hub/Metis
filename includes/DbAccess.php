<?php
$conn  = new mysqli("localhost", "root", "", "Metis");

if ($conn->connect_errno) {
	//keine DB-Verbindung
	exit();
}

?>