<!DOCTYPE html>
<html lang="de">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="./../style.css" />
		<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
		<title>Metis - Administration</title>
		<?php
			session_start();
			session_regenerate_id(false);
			if(isset($_SESSION["ask_for_dbAccess_change"]) && $_SESSION["ask_for_dbAccess_change"] == true) {
				unset($_SESSION["ask_for_dbAccess_change"]);
				echo "<script type=\"text/javascript\">\n" .
					 "\tvar check = confirm(unescape(\"Wollen Sie die DB-Verbindung %28f%FCr php%29 wirklich %E4ndern%3F\\nDies k%F6nnte weitreichende Folgen haben%21\"));\n" .
					 "\tif(check == true) window.location.href = \"index.php?change_db_access=true\";\n" .
					 "\telse window.location.href = \"index.php?change_db_access=false\";\n" .
					 "</script>";
			}
		?>
	</head>

	<body>
		<header>
			<nav>
			<?php
				echo "<a ".(($position == 0) ? 'class="active"' : 'href="../index/"').">Home</a>";
				echo "<a ".(($position == 1) ? 'class="active"' : 'href="../accounts/"').">Accounts</a>";
				echo "<a ".(($position == 2) ? 'class="active"' : 'href="../classes/"').">Klassen</a>";
				echo "<a ".(($position == 3) ? 'class="active"' : 'href="../configs/"').">Servereinstellungen</a>";
				
				#ersetzen um zum lehrer zu führen
				echo "<a class = 'right' href = './../../index/'> Zur&uuml;ck </a>";
			?>
			</nav>
		</header>