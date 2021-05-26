<?php
global $position;
$position = 0;
include("./../header.inc.php");
?>
	<h1>
		Wilkommen bei Metis, <?php echo $_SESSION["user"]["salutation"]." ".$_SESSION["user"]["name"] . "\n";?>
	</h1>
	<p>
		
	</p>
<?php
include("./../footer.inc.php");
?>