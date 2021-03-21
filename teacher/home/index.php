<?php
global $position;
$position = 0;
include("./../header.php");
?>
	<p>
		Wilkommen bei Metis, <?php echo $_SESSION["user"]["salutation"]." ".$_SESSION["user"]["name"] . "\n";?>
	</p>
		<!--Nun für alle, deine erhältlich Daten: *Hu Har har!*
		< ?php
			foreach($_SESSION["user"] as $data) {
				echo "\n<p>\n". $data . "\n</p>\n";
			}
		?>
		-->
<?php
include("./../footer.php");
?>