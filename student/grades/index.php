<?php
	// TODO username bei Cookies verwenden
	global $position;
	$position = 1;
	$time = time() + (3600*24*360);	// Die Cookies bleiben ein Jahr gespeichert.
	include("./../header.php");
	
	if(!isset($_COOKIE["nSubjekts"])) {	// Anzahl der Fächer wird auf 0 gesetzt.
		setcookie("nSubjekts", 0, $time);
		header("location: ./../grades");	// Dadurch wird die URL zurückgesetzt.
	}

	$remove = null;

	if(isset($_SESSION["must_reload"])) {	// Diese Neulademöglichkeit ermöglicht die Verwendung von neugesetzten Cookies.
		unset($_SESSION["must_reload"]);
		header("Location:".$_SERVER['REQUEST_URI']);
	}

	if(isset($_SESSION["subj"]) && isset($_SESSION["average".$_SESSION["subj"]])) {	// Empfängt die Daten von der Berechnung des Durchschnittes.
		$grades = array();
		for($i = 0; $i < $_SESSION["average".$_SESSION["subj"]]["n"]; $i++) {
			array_push($grades, $_SESSION["average".$_SESSION["subj"]][$i]);
		}
		setcookie("grades".$_SESSION["subj"], serialize($grades), $time);
		setcookie("average".$_SESSION["subj"], $_SESSION["average".$_SESSION["subj"]]["num"], $time);
		unset($_SESSION["average".$_SESSION["subj"]]);
		unset($_SESSION["subj"]);
		unset($_SESSION["subjekt"]);
		$_SESSION["must_reload"] = true;
		header("Location: ./../grades/");
	}

	for($i = 0; $i < $_COOKIE["nSubjekts"]; $i++) {	// Überpruft, ob ein Fach entfernt werden soll.
		if(isset($_GET["remove".$i])) {
			$remove = $i+1;
		}
	}

	for($i = 0; $i < $_COOKIE["nSubjekts"]; $i++) {	// Überpruft, ob der Durchschnitt berechnet werden soll.
		if(isset($_GET["subj".$i])) {
			$_SESSION["subjekt"] = $_COOKIE["nSubj".$i];
			$_SESSION["subj"] = $i;
			header("Location: calc.php");
		}
	}

	if(isset($_GET["newSubjekt"]) && $_GET["newSubjekt"] != null && isset($_GET["addSubjekt"])) {	// Fügt neues Fach hinzu.
		setcookie("nSubj".$_COOKIE["nSubjekts"], $_GET["newSubjekt"], $time);
		setcookie("average".$_COOKIE["nSubjekts"], 0.0, $time);
		setcookie("grades".$_COOKIE["nSubjekts"], 0.0, $time);
		setcookie("nSubjekts", $_COOKIE["nSubjekts"]+1, $time);
		$_SESSION["must_reload"] = true;
		header("location: ./../grades");	// Dadurch wird die URL zurückgesetzt.
	}
	elseif(isset($_GET["reset"])) {
		for($i = 0; $i < $_COOKIE["nSubjekts"]; $i++) {	// Die Cookies werden zurückgesetzt.
			if(isset($_COOKIE["nSubj".$i]))
				setcookie("nSubj".$i, $_COOKIE["nSubj".$i], 1);
		}
		setcookie("nSubjekts", 0, $time);
		header("location: ./../grades");	// Dadurch wird die URL zurückgesetzt.
	}
	elseif($remove != null) {
		$remove--;
		for($i = $remove; $i < $_COOKIE["nSubjekts"]-1; $i++) {
			if(isset($_COOKIE["nSubj".($i+1)])) {
				setcookie("nSubj".$i, $_COOKIE["nSubj".($i+1)], $time);
				setcookie("average".$i, $_COOKIE["average".($i+1)], $time);	// Übernimmt das Array
				setcookie("grades".$i, $_COOKIE["grades".($i+1)], $time);
			}
		}
		setcookie("nSubj".$_COOKIE["nSubjekts"], false, 1);	// Das Cookie wird entfernt
		setcookie("nSubjekts", $_COOKIE["nSubjekts"]-1, $time);
		$_SESSION["must_reload"] = true;
		header("location: ./../grades");	// Dadurch wird die URL zurückgesetzt
	}

?>

<div>
	<form action="index.php" methode="get">
		<table <!--border = 1-->
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>
					Fach
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td>Durchschnitt<td>
			</tr><?php echo "\n";
			for($i = 0; $i < $_COOKIE["nSubjekts"]; $i++) {	// Gibt die Buttons usw. aus.
				echo "\t\t\t<tr>\n\t\t\t\t<td><input type=\"submit\" name=\"remove" . $i . "\" value=\"&minus;\"</td>\n";
				echo "\t\t\t\t<td>" . $_COOKIE["nSubj".$i] . ": </td>\n";
				echo "\t\t\t\t<td>" . number_format($_COOKIE["average".$i], 2, ",", ".") . "</td>\n";
				echo "\t\t\t\t<td>&nbsp;&nbsp;<input type=\"submit\" name=\"subj".$i."\" value=\"Durchschnitt berechnen\" /></td>\n";
				echo "\t\t\t</tr>\n";
			}
			?>
		</table>
		<table>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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