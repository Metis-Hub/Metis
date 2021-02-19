<?php
global $position;
$position = 0;
include("./../header.php");
?>
	<p>
		Wilkommen bei Metis,<?php echo $_SESSION["user"]["uname"] . "\n";?>
	</p>
<?php
include("./../footer.php");
?>