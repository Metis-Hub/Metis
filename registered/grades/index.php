<?php
	global $position;
	$position = 1;
	include("./../header.php");

	if(!isset($_COOKIE["grades_calc"])) {
		$_SESSION["grades_first"] = true;
		header("Location: ./first.php");
	}
	else {
	setcookie("grades_calc", true, time() * 100);
	}	

?>



<?php
	include("./../footer.php");
?>