		<header>
			<nav>
			<?php
				echo "<a ".(($position2 == 0) ? 'class="active"' : 'href="./students.php"').">Sch&uuml;ler</a>";
				echo "<a ".(($position2 == 1) ? 'class="active"' : 'href="./teachers.php"').">Lehrer</a>";
				if(!empty($_GET["backToClass"])) {
					echo "<a class='right' href='./../classes?select=".$_GET["backToClass"]."'>zur&uuml;ck zur Klasse</a>";
				}
			?>
			</nav>
		</header>