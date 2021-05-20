<?php
	global $position;
	$position = 4;
	include("./../header.php");
	echo '
	<header>
		<nav>
			<div><a href="vocRequestDefault.php">Vokabeltrainer</a></div>
			<div><a href="quizSearch.php">Quizze</a></div>
			<div><a href="trainCalc.php">Kopfrechnen</a></div>
		</nav>
	</header>';
	include("./../footer.php");
?>