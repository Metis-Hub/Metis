<?php
session_start();
//Prefab-Accounts (uname|pwd): Bruno|bruno, Karl|karl, Jakob|jakob
$data = array("uname" => $_POST["username"], "pwd" => $_POST["psw"]);

$ch = curl_init("localhost:8080/loginRequest?".http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$promise = json_decode(curl_exec($ch), true);
curl_close($ch);

if($promise["success"]) {
    unset($promise["success"]);
    $_SESSION["user"] = $promise;

    header("Location: ../registered/home");
} else {
    header("Location: ../index/index.php");
    //Anmeldung fehlgeschlagen
}
?>
