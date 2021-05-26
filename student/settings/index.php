<?php
	global $position;
	$position = 5;
	include("./../header.inc.php");
?>
	<form action="ChangeSettings.php" method="post">
        <table border="0" width="40%" style="margin-left: 10rem; margin-top: 5rem;">
            <tr><td colspan="3"><u><b>Darstellung</b></u></td></tr>
            <tr><td colspan="3"><div style="padding:1.5%;"></div></td></tr>
            <tr>
                <td colspan="3" width="10%">
                    <select name="visual_mode">
                        <option value="bright"<?php if($_SESSION["cookies"]["visual_mode_cookie"] == "bright")echo "selected";?>>bright (Standart)</option>
                        <option value="dark"<?php if($_SESSION["cookies"]["visual_mode_cookie"] == "dark")echo "selected";?>>dark</option>
                    </select>
                    <div style="display:inline;width:7%;padding:5%;"></div>
                    <input type="submit" name="change_visual_mode"value="Anwenden"></input>
                </td>
            </tr>
            <tr><td colspan="3"><div style="padding:3%;"></div></td></tr>
            <tr><td colspan="3"><u><b>Passwort &auml;ndern</b></u></td></tr>
            <tr><td colspan="3"><div style="padding:1.5%;"></div></td></tr>
            <tr>
                <td width="50%">Klicken Sie hier um Ihr Passwort zu &auml;ndern:</td>
                <td colspan="2" align="left"><input type="submit" name="change_password" value="Passwort &auml;ndern"></input></td>
            </tr>
        </table>
    </form>
<?php
	include("./../footer.inc.php");
?>