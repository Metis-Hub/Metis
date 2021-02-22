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
        return isset($_SESSION["user"]);
    } else {
        return false;
    }
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
        unset($promise["success"]);
        $_SESSION["user"] = $promise;
        return true;

        return true;
    } else return false;
}

function isPasswordOk($username, $password) {
    
    $password = $password;

    $ch = curl_init("localhost:8080/loginRequest?".http_build_query(array("uname" => $username, "pwd" => $password)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $promise = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if($promise["success"] == true) {
        unset($promise["success"]);
        return true;
    } else return false;
}

/*
 * Meldet den User ab
 */
function logOut() {
    unset($_SESSION["user"]);
}

?>