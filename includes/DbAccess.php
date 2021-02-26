<?php
$conn  = new mysqli("localhost", "Metis", "", "Metis");

if ($conn->connect_errno) {
	//keine DB-Verbindung
	exit();
}

?>