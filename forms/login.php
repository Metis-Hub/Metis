<?php
session_start();
session_regenerate_id(false);
include ("./../includes/DbAccess.php");
include ("crypt.inc.php");

function tryLogin($type, $email, $password, $conn) {
    $stmt = $conn -> prepare("SELECT * FROM $type WHERE email = ? LIMIT 1");
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if(mysqli_num_rows($result) < 1) {
        return false;
    }

    if($rows = $result -> fetch_assoc()) {
	    if(password_verify($password, $rows["password"])) {
            $_SESSION["user"] = array_merge($rows, array("usertype" => $type));
            $_SESSION["user"]["classes"] = getClasses();
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getClasses() {
    global $conn;

    $classes = array();
    $stmt = $conn -> prepare("SELECT `classId` FROM `studentsclass` WHERE `studentId` = ?");
    $stmt -> bind_param("s", $_SESSION["user"]["id"]);
    $stmt -> execute();
    $result = $stmt -> get_result();
    
    while($row = $result -> fetch_assoc()) {
        array_push($classes, $row["classId"]);
    }

    return $classes;
}

$header = "location: ./../";

if(isset($_SESSION["user"])) {
    header($header . "student/home/");
}

// Entschüsselung
if(isset($_POST["pw"]) && isset($_SESSION["safe_password_seed"])) $password = decrypt($_SESSION["safe_password_seed"], $_POST["pw"]); else $password = null;

if(isset($_POST["email"]) && $_POST["email"] != null && $password != null) {
    $email = $_POST["email"];
    // Nicht wundern, es wird zwei mal versucht anzumelden (einmal schüler, einmal lehrer)
    if(!tryLogin("student", $email, $password, $conn)) {
        if(!tryLogin("teacher", $email, $password, $conn)) {
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
            header($header . "teacher/home/");    // Lehrer
        }
    } else {
        if(isset($_SESSION["wrong_logins"])) {  // Wenn Anmeldung richtig ist wird ggf. zurückgesetzt
            unset($_SESSION["wrong_logins"]);
        }
        header($header . "student/home/");    // Schüler
    }
} else {
    if(!isset($_POST["email"]) || $_POST["email"] == null && $password == null) header($header . "index/index.php?error=fields_are_empty");
    elseif(!isset($_POST["email"]) || $_POST["email"] == null) header($header . "index/index.php?error=email_field_is_empty");
    elseif($password == null) header($header . "index/index.php?error=password_field_is_empty");
}

?>