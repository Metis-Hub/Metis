<?php
session_start();
include("../DbAccess.php");

function tryLogin($type, $email, $password, $conn) {
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, "SELECT * FROM $type WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) < 1) {
        return false;
    }

    if($rows = mysqli_fetch_assoc($result)) {
	    if(password_verify($password, $rows["password"])) {
            $_SESSION["user"] = array_merge($rows, array("usertype" => $type));
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$header = "location: ./../../";

if(isset($_SESSION["user"])) {
    header($header . "student/home/");
}

if(isset($_POST["email"]) && $_POST["email"] != null && isset($_POST["pwd"]) && $_POST["pwd"] != null) {
    $email = $_POST["email"];
    $password = $_POST["pwd"];

    if(!tryLogin("teacher", $email, $password, $conn)) {
        if(!tryLogin("student", $email, $password, $conn)) {

            if(!isset($_SESSION["wrong_logins"])) {
                $_SESSION["wrong_logins"] = 1;
            }
            else {
                if($_SESSION["wrong_logins"] >= 10) {   // Nun wird 3 Minuten gewartet.
                    unset($_SESSION["wrong_logins"]);
                    $_SESSION["to_much_wrong_logins"] = true;
                    header($header . "index/index.php?error=to_much_wrong_logins");
                }
                else {
                    $_SESSION["wrong_logins"] = $_SESSION["wrong_logins"] + 1;
                }
            }

            header($header . "index/index.php?error=no_account_found");

        } else {
            if(isset($_SESSION["wrong_logins"])) {  // Wenn Anmeldung richtig ist wird ggf. zurückgesetzt
                unset($_SESSION["wrong_logins"]);
            }
            header($header . "student/home/");    // Schüler
        }
    } else {
        if(isset($_SESSION["wrong_logins"])) {  // Wenn Anmeldung richtig ist wird ggf. zurückgesetzt
            unset($_SESSION["wrong_logins"]);
        }
        header($header . "teacher/home/");    // Lehrer
    }
} else {
    if(isset($_POST["email"]) && !$_POST["email"] != null && isset($_POST["pwd"]) && !$_POST["pwd"] != null)
    header($header . "index/index.php?error=fields_are_empty");
    elseif(isset($_POST["email"]) && $_POST["email"] != null)
    header($header . "index/index.php?error=email_field_are_empty");
    elseif(isset($_POST["pwd"]) && $_POST["pwd"] != null)
    header($header . "index/index.php?error=password_fields_are_empty");
}

?>
