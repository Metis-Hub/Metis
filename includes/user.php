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

function changePassword0($newPassword, $userId, $userType, $session = false, $oldPassword = "") {

    global $conn;
    $user = $conn -> query("SELECT password FROM " . $userType . " WHERE id = " . $userId);
    $dbPassword = $user -> fetch_array(MYSQLI_ASSOC)["password"];

    if(!$session || password_verify($oldPassword, $dbPassword)) {

        $pwd = password_hash($newPassword, PASSWORD_BCRYPT, array("cost" => 5));
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, "UPDATE " . $userType . " SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $pwd, $userId);
        mysqli_stmt_execute($stmt);

        if($session) {
            $_SESSION["user"]["password"] = $pwd;
            return true;
        }

        return $pwd;
    }

    return false; 
}

function changePassword($oldPassword, $newPassword) {
    return changePassword0($newPassword, $_SESSION["user"]["id"], $_SESSION["user"]["usertype"], true, $oldPassword); 
}

?>