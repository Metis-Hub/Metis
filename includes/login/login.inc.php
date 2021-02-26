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

if(isset($_SESSION["user"])) {
    header("Location: ./../../student/home/");
}

if(isset($_POST["email"]) && $_POST["email"] != null && isset($_POST["pwd"]) && $_POST["pwd"] != null) {
    $email = $_POST["email"];
    $password = $_POST["pwd"];

    if(!tryLogin("teacher", $email, $password, $conn)) {
        if(!tryLogin("student", $email, $password, $conn)) {
            header("Location: ../../index/index.php?error=no_account_found");
        } else {
            header("Location: ../../student/home/");
        }
    } else {
        header("Location: ../../teacher/home/");
    }
} else {
    if(isset($_POST["email"]) && !$_POST["email"] != null && isset($_POST["pwd"]) && !$_POST["pwd"] != null)
    header("Location: ../../index/index.php?error=fields_are_empty");
    elseif(isset($_POST["email"]) && $_POST["email"] != null)
    header("Location: ../../index/index.php?error=email_field_are_empty");
    elseif(isset($_POST["pwd"]) && $_POST["pwd"] != null)
    header("Location: ../../index/index.php?error=password_fields_are_empty");
}

?>
