<?php
	// TODO username bei Cookies verwenden
	global $position;
	$position = 1;
	include("./../header.php");
	
	$time = time() + (3600*24*360);
	if(!isset($_COOKIE["nSubjekts"])) setcookie("nSubjekts", 0, $time);

	if(!isset($_COOKIE["grades_calc"]) && isset($_SESSION["grades_instruction_ok"])) {
		$_SESSION["grades_first"] = true;
		setcookie("nSubjekts", 0, $time);
		header("Location: ./first.php");
	}
	else {
		if(isset($_SESSION["grades_instruction_ok"])) {
			unset($_SESSION["grades_instruction_ok"]);
		}
		setcookie("grades_calc", true, $time);
	}

	if(isset($_GET["newSubjekt"]) && $_GET["newSubjekt"] != null && isset($_GET["addSubjekt"])) {
		setcookie("nSubj".$_COOKIE["nSubjekts"], $_GET["newSubjekt"], $time);
		setcookie("nSubjekts", $_COOKIE["nSubjekts"]+1, $time);
		header("location: ./../grades");	// Dadurch wird die URL zurückgesetzt
	}
	if(isset($_GET["reset"])) {
		for($i = 0; $i < $_COOKIE["nSubjekts"]; $i++) {	// Dei Cookies werden zurückgesetzt
			setcookie("nSubj".$_COOKIE["nSubjekts"], $_GET["newSubjekt"], 1);
		}
		setcookie("nSubjekts", 0, $time);
		header("location: ./../grades");	// Dadurch wird die URL zurückgesetzt
	}
?>

<div>
	<form action="index.php" methode="get">
		<table <!--border = 1-->
			<tr>
				<td></td>
				<td>Fach</td>
				<td>Durchschnitt<td>
			</tr><?php echo "\n";
			for($i = 0; $i < $_COOKIE["nSubjekts"]; $i++) {
				echo "\t\t\t<tr>\n\t\t\t\t<td><input type=\"submit\" name=\"remove\" value=\"&minus;\"</td>\n";
				echo "\t\t\t\t<td>" . $_COOKIE["nSubj".$i] . ": </td>\n";
				echo "\t\t\t\t<td id=\"" . $i . "\"></td>\n";
				echo "\t\t\t\t<td><input type=\"submit\" name=\"subj".$i."\" value=\"Durchschnitt berechnen\" /></td>\n";
				echo "\t\t\t</tr>\n";
			}
			?>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td></td>
			</tr>
		</table>
		<table>
			<tr>
				<td><input type="text" name="newSubjekt" placeholder="Fachname/-bezeichnung" width="600" /></td>
				<td><input type="submit" name="addSubjekt" value="Fach hinzuf&uuml;gen" /></td>
			</tr>
			<tr><td><br /><br /></td></tr>
			<tr>
				<td></td>
				<td><input type="submit" name="reset" value="zur&uuml;cksetzten" /></td>
			</tr>
		</table>
	</form>
</div>

<?php
	include("./../footer.php");
?>