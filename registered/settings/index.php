<?php
	global $position;
	$position = 4;
	include("./../header.php");
?>
	<form action="ChangeSettings.php" method="post">
        <table width="100%">
            <tr>
                <td>
                    Darstellung
                </td>
                <td>
                    <select name="visual_mode">
                        <option value="bright"<?php if($_SESSION["visual_mode"] == "bright")echo "selected";?>>
                            Hell (Standart)
                        </option>
                        <option value="dark"<?php if($_SESSION["visual_mode"] == "dark")echo "selected";?>>
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