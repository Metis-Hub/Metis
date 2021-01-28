<?php

		
	$data = array("name" => $_POST["username"], "password" => $_POST["psw"]);
			
	$pw = password_hash($_Post["psw"], algo:PASSWORD_BCRYPT)	;
		
	$curl = curl_init();
	$url = sprintf("%s?%s", "localhost:8080/users/exists", http_build_query($data));

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
		

			
	if ($result) {
		echo "Hallo ".$data["username"];
	}
	else {
		echo
		"
		<!DOCTYPE html>
		<html>

		<head>
			<link rel=\"icon\" href=\"../faviconMetis.ico\" type=\"image/x-icon\" />
			<title>Anmeldedaten nicht gefunden!</title>
			<meta http-equiv=\"refresh\" content=\"5; URL=../index/index.php\">
		</head>

		<body>
		";
		echo "
		<p>Die angegeben Anmeldedaten konnten nicht gefunden werden! Bitte versuchen Sie es "."<a href='../index/index.php'>erneut.</a></p>
		";
		echo "<p>Sie werden zur&uuml;ck zur "."<a href='../index/index.php'>Anmeldeseite</a>"." geleitet . . . </p>
		";
		echo "
		</body>
		
		</html>";
	}

?>