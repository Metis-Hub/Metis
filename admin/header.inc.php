<?php include "../../includes/set_link.php"; include "../../includes/std_session.php"; ?><!DOCTYPE html>
<html lang="de">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="./../style.css" />
		<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
		<title>Metis - Administration</title>
		<?php
			if(isset($_SESSION["ask_for_dbAccess_change"]) && $_SESSION["ask_for_dbAccess_change"] == true) {
				unset($_SESSION["ask_for_dbAccess_change"]);
				echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" .
					 "\tvar check = confirm(unescape(\"Wollen Sie die DB-Verbindung %28f%FCr php%29 wirklich %E4ndern%3F\\nDies k%F6nnte weitreichende Folgen haben%21\"));\n" .
					 "\tif(check == true) window.location.href = \"index.php?change_db_access=true\";\n" .
					 "\telse window.location.href = \"index.php?change_db_access=false\";\n" .
					 "</script>";
			}
			else if(!empty($_GET["editPwd"]) || $position == 3) {
				echo "<script language=\"JavaScript\" type=\"text/JavaScript\" src=\"../../includes/link98346.js\"></script>";
			}
		?>
	</head>

	<body>
		<header>
			<nav>
			<?php
				echo "<a ".(($position == 0) ? 'class="active"' : 'href="../index/"').">Home</a>";
				echo "<a ".(($position == 1) ? 'class="active"' : 'href="../accounts/"').">Accounts</a>";
				echo "<a ".(($position == 2) ? 'class="active"' : 'href="../classes/"').">Planeintr&auml;ge</a>";
				echo "<a ".(($position == 3) ? 'class="active"' : 'href="../configs/"').">Servereinstellungen</a>";
				
				#ersetzen um zum lehrer zu führen
				echo "<a class = 'right' href = './../../index/'> Zur&uuml;ck </a>";
			?>
			</nav>
		</header>