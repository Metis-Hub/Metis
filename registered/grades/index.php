<?php
	global $position;
	$position = 1;
	include("./../header.php");

	if(!isset($_COOKIE["grades_calc"]) && isset($_SESSION["grades_instruction_ok"])) {
		$_SESSION["grades_first"] = true;
		header("Location: ./first.php");
	}
	else {
		if(isset($_SESSION["grades_instruction_ok"])) {
			unset($_SESSION["grades_instruction_ok"]);
		}
		setcookie("grades_calc", true, time() * 100);
		header("Location: ./grade_in_subjekt.php");
	}

?>



<?php
	include("./../footer.php");
?>