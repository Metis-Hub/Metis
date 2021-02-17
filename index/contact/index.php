<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		session_start();
		if($_SESSION["cookies_set"] == false)
			header("Location: ./../../index.php");
		if($_SESSION["visual_mode"] == "bright")
			echo "<link rel=\"stylesheet\" href=\"../style.css\" />\n";
		elseif($_SESSION["visual_mode"] == "dark")
			echo "<link rel=\"stylesheet\" href=\"../style_dark.css\" />\n";
	?>
	<link rel="icon" href="../../faviconMetis.ico" type="image/x-icon" />
	<title>
		Metis - Impressum
	</title>
</head>

<body>

	<header>
		<!--div id="headLine"><b>Impressum - Metis</b></div-->
		<nav>
			<a href="../../index">zur&uuml;ck</a>
		</nav>
	</header>

	<center>
		<div>
			
			<br />
			<div>
				<h1>
					Impressum - Was wei&szlig; ich . . . 
				</h1>
			</div>

			<br />

			<div>
				<p>
					<h3>Cookies</h3>
				</p>
				<p>
					Irgendwas
				</p>
				<p>
					BlaBlaBlub . . .. . . . .. . .. . . .. . .. .. . .. . .
				</p>
			</div>
		</div>
	</center>
	
</body>

</html>
