<?php
	global $position;
	$position = 5;
	include("./../header.php");
?>
	<form action="ChangeSettings.php" method="post">
        <table width="40%">
            <tr><td><u><b>Darstellung</b></u></td></tr>
            <tr><td><br /></td></tr>
            <tr>
                <td>
                    <select name="visual_mode">
                        <option value="bright"<?php if($_SESSION["visual_mode"] == "bright")echo "selected";?>>bright (Standart)</option>
                        <option value="dark"<?php if($_SESSION["visual_mode"] == "dark")echo "selected";?>>dark</option>
                    </select>
                    &nbsp;&nbsp;
                    <input type="submit" name="change_visual_mode"value="Anwenden" />
                </td>
            </tr>
            <tr><td><br /></td></tr>
            <tr><td><br /></td></tr>
            <tr><td><u><b>Passwort &auml;ndern</b></u></td></tr>
            <tr><td><br /></td></tr>
            <tr>
                <td>
                    Klicken Sie hier um Ihr Passwort zu &auml;ndern:
                    <input type="submit" name="change_password" value="Passwort &auml;ndern" />
                </td>
            </tr>
        </table>
    </form>
<?php
	include("./../footer.php");
?>