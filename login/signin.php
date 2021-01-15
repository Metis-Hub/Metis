<?php

	if(isset($_POST["login"])) {
	
		echo "test";
		
		$data = array(
		"name" => $_POST["username"],
		"password" => $_POST["psw"],
		);
			
		
		/*
		$curl = curl_init();
		$url = sprintf("%s?%s", "localhost:8080/users/exists", http_build_query($data));

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		*/

		echo "Fehler @".$data["username"]."!";
		echo '<p style="font-family: Consolas; font-size: 50;"> <br>';
		echo "Oh, offensichtlich ist etwas falsch gelaufen.";
		echo "<a href='SigninSite.html'>Probiere es am Besten noch einmal.</a></p>";

			/*
			if ($result) {
			echo "Hallo ".$data["username"].", Willkommen zurück!";
			echo '</p>';
			echo '<p style="font-family: Consolas; font-size: 50;"> <br>';
			echo 'Was willst du zuerst tun?<br>';
			echo '<form name="ActivityForm">
			<input type="button" name="MakePostButton" value="Einen Post verfassen" style="height:3cm;width:15cm; font-family: Consolas;font-size: 50; color: aliceblue; background-color: black;" onclick="location.href='."'PostTypeChoose.html'".'" ><br><br>
			<input type="button" name="SeePostsButton" value="Posts ansehen" style="height:3cm;width:15cm; font-family: Consolas;font-size: 50; color: aliceblue; background-color: grey;" onclick="location.href='."'ZianteuMain_Posts.html'".'"><br>
			</form>';
		}
		else {
			echo "Fehler @".$data["username"]."!";
			echo '<p style="font-family: Consolas; font-size: 50;"> <br>';
			echo "Oh, offensichtlich ist etwas falsch gelaufen.";
			echo "<a href='SigninSite.html'>Probiere es am Besten noch einmal.</a></p>";
		}
		*/
	}

?>