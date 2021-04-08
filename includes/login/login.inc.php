<?php
session_start();
include("./../DbAccess.php");

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

function decrypt() {
	if(isset($_SESSION["safe_passwort_seed"]) && isset($_POST["pw"])) {
		$hash = $_SESSION["safe_passwort_seed"];
		$out = "";
		for($i = 0; $i < strlen($_POST["pw"]); $i++) {
			$hash = $hash * 271 % 99999 + 1;
			$tmp = "";

			while($_POST["pw"][$i] != ';') {
				$tmp .= $_POST["pw"][$i];
				$i++;
			}

			$tmp = intval($tmp);
			if(($tmp ^ $hash) != 3141) $out .= chr($tmp ^ $hash);
		}
	}
    return $out;
}

$header = "location: ./../../";

if(isset($_SESSION["user"])) {
    header($header . "student/home/");
}

if(isset($_POST["pw"])) $password = decrypt(); else $password = null;
echo "1";

if(isset($_POST["email"]) && $_POST["email"] != null && $password != null) {
    $email = $_POST["email"];
    echo "1";
    if(!tryLogin("teacher", $email, $password, $conn)) {
        if(!tryLogin("student", $email, $password, $conn)) {
            echo "1";
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
    if(!isset($_POST["email"]) || $_POST["email"] == null && $password == null) header($header . "index/index.php?error=fields_are_empty");
    elseif(!isset($_POST["email"]) || $_POST["email"] == null) header($header . "index/index.php?error=email_field_are_empty");
    elseif($password == null) header($header . "index/index.php?error=password_fields_are_empty");
}

?>