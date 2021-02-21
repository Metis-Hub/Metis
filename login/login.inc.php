<?php
session_start();
//Prefab-Accounts (uname|pwd): Bruno|bruno, Karl|karl, Jakob|jakob

if(isset($_SESSION["tmpLogin"]) && $_SESSION["tmpLogin"] == true) {
    $ch = curl_init("localhost:8080/loginRequest?".http_build_query(array("uname" => $_SESSION["username"], "pwd" => $_SESSION["pw"])));
    unset($_SESSION["tmpLogin"]);
    unset($_SESSION["username"]);
    unset($_SESSION["pw"]);
}
else
    $ch = curl_init("localhost:8080/loginRequest?".http_build_query(array("uname" => $_POST["username"], "pwd" => $_POST["pw"])));

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
    header("Location: ../index/loginFailed/datas_not_exsist.php");
    //Anmeldung fehlgeschlagen
}
?>
