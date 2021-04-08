<html>
<?php
	session_start();
	include("../includes/Random.php");
	Rand::SetSeed(time());
	$seed = Rand::Next();
	if(isset($_SESSION["seed"])) $_SESSION["last_seed"] = $_SESSION["seed"];
	$_SESSION["seed"] = $seed;
?>
<head>
	<script src="../includes/hash.js"></script>
</head>

<body>

	<input type="text" placeholder="Email" name="email" id="email" />
	<input type="password" placeholder="Passwort" name="pwd" id="pwd" />
	<button type="" name="login" onclick="hash(<?php echo "'" . $seed . "'";?>);">Anmelden</button>
	<form id="password" method="POST" action="tmpTest.php" enctype="multipart/mixed">
		<input type="hidden" name="pw" id="pw" value="" />
	</form>
	<code id="out"></code>
	<p>
		<p><b>seed:</b><?php echo $seed;?></p>
		<p><b>seed davor:</b><?php echo $_SESSION["last_seed"];?></p>
		<?php
			echo $_POST["pw"];
			echo "<br />";
			if(isset($_SESSION["last_seed"]) && isset($_POST["pw"])) {
				$hash = $_SESSION["last_seed"];
				$out = "";
				for($i = 0; $i < strlen($_POST["pw"]); $i++) {
					$hash = $hash * 271 % 99999 + 1;
					$tmp = "";

					while($_POST["pw"][$i] != ';') {
						$tmp .= $_POST["pw"][$i];
						$i++;
					}

					$tmp = intval($tmp);
					if(($tmp ^ $hash) != 3141)$out .= chr($tmp ^ $hash);
				}
				echo "<br />\"" . $out . "\"";
			}
		?>
	</p>
</body>

</html>