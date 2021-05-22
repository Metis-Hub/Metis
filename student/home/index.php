<?php
global $position;
$position = 0;
include("./../header.inc.php");
?>
	<p>
		Wilkommen bei Metis, <?php echo $_SESSION["user"]["name"] . "\n";?>
	</p>
		<?php
			echo "ICH BIN ZURÜCK <br>";
			foreach($_SESSION["user"] as $data) {
				var_dump($data);
				echo "<br>";
			}
		?>
<?php
include("./../footer.inc.php");
?>