<?php
	global $position;
	$position = 4;
	include("./../header.php");

    if(isset($_POST["visual_mode"])) {
        $_SESSION["visual_mode"] = $_POST["visual_mode"];
        setcookie("visual_mode", $_POST["visual_mode"], time() * 100);
        $_SESSION["change_setting"] = 1;
        header("Location: ./../../index");
        #header("Location: ./../settings");
    }
    elseif(isset($_SESSION["visual_mode"])) {
        if($_SESSION["visual_mode"] == 2) {
            $_SESSION = 2;
            header("Location: ./../home");
        }
    }

?>
	<form action="mySettings.php" method="post">
        <table width="100%">
            <tr>
                <td>
                    Darstellung
                </td>
                <td>
                    <select name="visual_mode">
                        <option value="bright">
                            Hell (Standart)
                        </option>
                        <option value="dark">
                            Darkmode
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Anwenden" />
                </td>
            </tr>
        </table>
    </form>
<?php
	include("./../footer.php");
?>