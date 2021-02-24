<?php
require ("../includes/DbAccess.php");

$result = $conn -> query("SELECT password FROM student WHERE id = 11");

$pwd = $result->fetch_assoc()["password"];
echo "$pwd";
echo "<br>".strlen($pwd);

echo "<br>";

$pwd = password_hash("password", PASSWORD_BCRYPT, array("cost" => 5));
echo "$pwd";
echo "<br>".strlen($pwd);