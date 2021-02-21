<?php
global $position;
$position = 0;
include("./../header.php");
?>
	<p>
		Wilkommen bei Metis, <?php echo $_SESSION["user"]["uname"] . "\n";?>
	</p>
	<!--p>
		Nun für alle deine Daten:
		<!?php
			foreach($_SESSION["user"] as $data) {
				echo "\n<p>\n". $data . "\n</p>\n";
			}
		?>
	</p-->
<?php
include("./../footer.php");
?>