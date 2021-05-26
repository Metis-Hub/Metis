<?php
global $position;
$position = 0;
include("./../header.inc.php");
?>
	<h1>
		Willkommen bei Metis, <?php echo $_SESSION["user"]["name"] . "\n";?>
	</h1>

	<p> Metis ist der Lernplaner deines Vertrauens! Du kannst unter <a href="../grades">Noten</a> deinen Notendurchschnitt berechnen.
	<br> Weiterhin kannst du dir im <a href="../tasks">Aufgabenplaner</a> deinen Stundenplan und deine Hausaufgaben ansehen. </p>
	<p> Falls du mit deinen Schulaufgaben fertig bist und noch ein wenig lernen möchtest ist <a href="../learn">Lernen</a> dein Ziel! 
	<br> Dort kannst du dein Wissen durch Vokabeln, Quizze, und Kopfrechnen trainieren und erweitern. </p>
	<p> Worauf wartest du noch? Los gehts! </p>
<?php
include("./../footer.inc.php");
?>