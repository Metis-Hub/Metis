<?php
session_start();
//Prefab-Accounts (uname|pwd): Bruno|bruno, Karl|karl, Jakob|jakob

$ch = curl_init("localhost:8080/loginRequest?".http_build_query(array("name" => $_POST["username"], "pw" => $_POST["pw"])));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$promise = json_decode(curl_exec($ch), true);
curl_close($ch);

if($promise["success"]) {
    unset($promise["success"]);
    $_SESSION["user"] = $promise;

    header("Location: ../registered/home");
} else {
    $_SESSION["login_failed"] = true;
    if(!isset($_SESSION["times_login_failed"]))
        $_SESSION["times_login_failed"] = 0;
    $_SESSION["times_login_failed"]++;
    header("Location: ../index/loginFailed.php");
    //Anmeldung fehlgeschlagen
}
?>
