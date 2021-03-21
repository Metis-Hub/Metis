<?php
if(session_status() != 2) {
    session_start();
}
include_once("DbAccess.php");

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