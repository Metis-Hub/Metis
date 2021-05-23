<nav>
<?php
	echo "<a ".(($position2 == 0) ? 'class="active"' : 'href="./"').">Klassen</a>";
	echo "<a ".(($position2 == 1) ? 'class="active"' : 'href="./courses.php"').">Kurse</a>";
	echo "<a ".(($position2 == 2) ? 'class="active"' : 'href="./subjects.php"').">F&auml;cher</a>";
	echo "<a ".(($position2 == 3) ? 'class="active"' : 'href="./languages.php"').">Sprachen</a>";
	echo "<a ".(($position2 == 4) ? 'class="active"' : 'href="./days.php"').">Tage</a>";
?>
</nav>