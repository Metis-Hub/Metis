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
				<h1 style="font-size: 2cm;">
					Metis - school made easy.
				</h1>				
			</div>

			<br />

			<div>
				<p>
					<h2>Metis‘ Aufgabe lässt sich an unserem Motto gut erkennen: wir wollen Schule einfach machen.</h2>
				</p>
				<p style="font-size: 0.5cm;">
				Für dich – für euch – für alle. Dafür löst Metis all die Probleme, die den Schulalltag so anstrengend machen:
				<br/>
				kaum Organisation, unordentliche Aufgabenplanung, fehlende Kommunikation, Lernen für Tests und Arbeiten, … 
				<br/>
				Löst das Kopfschmerzen aus? Dann ist Metis der perfekte Service für dich! Hier kannst du deine Aufgaben verwalten, 
				<br/>
				mit Lehrern und Schülern kommunizieren und außerdem individuell Vokabeln, Rechnen und vieles mehr lernen und üben.
				</p>

				<p style="font-size: 0.5cm;">
				Melde dich jetzt oben links an und fang an, Schule endlich zu genießen!
				</p>
			</div>
		</div>
	</center>

<?php
include("footer.inc.php");
?>