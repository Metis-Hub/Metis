<?php
	session_start();
	if(!isset($_SESSION["grades_first"])) {
		header("Location: ./../grades/");
	}
	if(isset($_POST["ok"])) {
		$_SESSION["grades_instruction_ok"] = true;
		header("Location: ./../grades/");
	}
	global $position;
	$position = 1;
	include("./../header.inc.php");
?>
	<p>
		Erkl&auml;rung
	</p>
	<p>
		usw.
		<br />
		bla, bla, blub
	</p>
	<form action="first.php" method="POST">
		<input type="submit" name="ok" value="Jaja verstanden"/>
	</form>
<?php
	include("./../footer.inc.php");
?>