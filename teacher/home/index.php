<?php
global $position;
$position = 0;
include("./../header.inc.php");
?>
	<h1>
		Wilkommen bei Metis, <?php echo $_SESSION["user"]["salutation"]." ".$_SESSION["user"]["name"] . "\n";?>
	</h1>
	<p> Metis ist der Lernplaner deines Vertrauens! Sie können unter <a href="../tasks">Aufgaben</a> Aufgaben für Ihre Kurse erstellen und ansehen.
	<br> Weiterhin können Sie in <a href="../learn">Lernen</a> Quizze und Vokabeln erstellen </p>
<?php
include("./../footer.inc.php");
?>