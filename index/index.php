<?php
include "../includes/std_session.php";
include "../includes/set_link.php";
if (!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false) {
	// Wenn keine Cookies gesetzt wurden, bzw. nicht zugestimmt wurde wird zu JavaScript-Meldung weitergeleitet.
	header("Location: ./../");
}
elseif(!isset($_SESSION["cookies"]["request_send"]) || $_SESSION["cookies"]["request_send"] == false) {
	$_SESSION["cookie_caller"] = "index/";
	$_SESSION["cookie_request_get"] = true;
	header("Location: ./../cookies.php");
}

include("header.inc.php");

?>
	<center>
		<div>
			
			<br />
			<div>
				<h1>
					Hallo und Herzlich Willkommen bei Metis!
				</h1>
			</div>

			<br />

			<div>
				<p>
					<h3>Was ist Metis?</h3>
				</p>
				<p>
					Metis, dies ist eine Schulplattform, welche Aufgabenplanung und Optimierung f&uuml;r Sie &uuml;bernimmt.
					<br />
					Zudem erm&ouml;glichen wir einen Stunden- und Vertretungsplaner in dem die Sch&uuml;ler ihre Aufgaben ansehen und l&ouml;sen k&ouml;nnen.
					Wir bieten den Lehrern die M&ouml;glichkeit, Aufgaben hier f&uuml;r die Sch&uuml;ler hochzuladen.
				</p>
				<p>
					Metis &uuml;berzeugt zudem mit den M&ouml;glichkeiten des Lernens, wie zum Beispiel	&uuml;ber Quizze, Vokabeltrainer und anderen Eastereggs.
				</p>
			</div>

			<div>
				<p>
					<h3>Wie kann ich Metis nutzen?</h3>
				</p>
				<p>
					Nutzt deine Schule immer noch nicht Metis?
					<br />
					Frag einfach deinen Klassenleiter, und zeige Ihm Metis. Metis muss n&auml;hmlich von der Schule aktiviert werden.
					<br />
					Ist dies getan, bekommst du dein Benutztername, und Passwort welches du bei der Ersten Anmeldung aufgefordert wirst zu &Auml;ndern.
					<br />
					<I>Und wage es ja nicht 123, passwort oder &auml;hnliches zu verwenden!</I> &#128544;
				</p>
			</div>
			<div>
				<a target="_blank" href="https://github.com/Metis-Git/Metis"> <i class="fa fa-github fa-5x"></i> </a>
			</div>
		</div>
	</center>

<?php
include("footer.inc.php");
?>