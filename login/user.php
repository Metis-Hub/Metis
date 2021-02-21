<?php
if(session_status() != 2) {
    session_start();
}

/* 
 * Sendet eine Request an den Backendserver an den Pfan $path mit den Parametern $params
 * gibt false zurück, wenn der Nutzer nicht angemeldet ist, ansonsten gibt er das promise zurück
 */
function sendRequest($path, $params) {
    if (!isLoggedIn()) {
        return false;
    }
    $user = getUserData();

    $ch = curl_init("localhost:8080/".$path."?".http_build_query(array_merge($user, $params)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $promise = json_decode(curl_exec($ch), true);
    curl_close($ch);

    return $promise;
}

/*
 * Testet anhand der Session-Variablen ob der Nutzer angemeldet ist
 */
function isLoggedIn() {
    if(session_status() == 2) {
        //echo isset($_SESSION["uid"]) && isset($_SESSION["pwd"]) ? "Ja" : "Nö";
        return isset($_SESSION["user"]["uid"]) && isset($_SESSION["user"]["pwd"]);
    } else {
        return false;
    }
}

/*
 * Gibt die User-Eigenschaften zurück
 * wenn nicht angemeldet wird false zurückgegeben
 */
function getUserData() {
    return session_status() != 2 || !isset($_SESSION["uid"]) || !isset($_SESSION["pwd"]) ? false : array("uid" => $_SESSION["uid"], "pwd" => $_SESSION["pwd"]);
}

/*
 * Meldet den Nutzer an
 */
function logIn($username, $password) {
    if(isLoggedIn()) {
        return;
    }

    //hier hashen oder so ka
    $password = $password;

    $ch = curl_init("localhost:8080/loginRequest?".http_build_query(array("uname" => $username, "pwd" => $password)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $promise = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if($promise["success"] == true) {
        $_SESSION["uid"] = $promise["uid"];
        $_SESSION["pwd"] = $password;
        $_SESSION["uname"] = $username;

        return true;
    } else return false;
}

/*
 * Meldet den User ab
 */
function logOut() {
    session_destroy();
}

?>