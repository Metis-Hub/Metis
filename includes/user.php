<?php
if(session_status() != 2) {
    session_start();
}
include_once("DbAccess.php");

/* 
 * Sendet eine Request an den Backendserver an den Pfan $path mit den Parametern $params
 * gibt false zurück, wenn der Nutzer nicht angemeldet ist, ansonsten gibt er das promise zurück
 */
function sendRequest($path, $params) {
    if (!isLoggedIn()) {
        return false;
    }

    $user = array($id => $_SESSION["user"]["id"], $usertype => $_SESSION["user"]["usertype"]);

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
 * Meldet den User ab
 */
function logOut() {
    unset($_SESSION["user"]);
}

function changePassword($oldPassword, $newPassword) {
    global $conn;

    $user = $conn -> query("SELECT password FROM ".$_SESSION["user"]["usertype"]." WHERE id = ".$_SESSION["user"]["id"]);
    $dbPassword = $user -> fetch_array(MYSQLI_ASSOC)["password"];
    if(password_verify($oldPassword, $dbPassword)) {
        $pwd = password_hash($newPassword, PASSWORD_BCRYPT, array("cost" => 5));
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, "UPDATE ".$_SESSION["user"]["usertype"]." SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $pwd, $_SESSION["user"]["id"]);
        mysqli_stmt_execute($stmt);
        $_SESSION["user"]["password"] = $pwd;
        return true;
    } else {
        return false;
    }
    
}

?>