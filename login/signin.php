<html>
    <head>
        <title>Zianteu - Pop the bubble</title>
    </head>    
    <body style="background-color: aliceblue;">  
    <center>
            <p style="font-family: Haettenschweiler; font-size: 200;">
                Zianteu - pop the bubble
            </p>      
        <?php
            $usernameInput=$_POST["SigninUsername"];
            $passwordInput=$_POST["SigninPassword"];
			
			$data = array(
			"name" => $usernameInput,
			"password" => $passwordInput,
			);
			
			
            $curl = curl_init();
			$url = sprintf("%s?%s", "localhost:8080/users/exists", http_build_query($data));

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($curl);
			curl_close($curl);

            if ($result) {
                $name=$_POST["SigninUsername"];
                echo '<p style="font-family: Consolas; font-size: 80;"> <br>';
                echo "Hallo ".$name.", Willkommen zurück!";
                echo '</p>';
                echo '<p style="font-family: Consolas; font-size: 50;"> <br>';
                echo 'Was willst du zuerst tun?<br>';
                echo '<form name="ActivityForm">
                        <input type="button" name="MakePostButton" value="Einen Post verfassen" style="height:3cm;width:15cm; font-family: Consolas;font-size: 50; color: aliceblue; background-color: black;" onclick="location.href='."'PostTypeChoose.html'".'" ><br><br>
                        <input type="button" name="SeePostsButton" value="Posts ansehen" style="height:3cm;width:15cm; font-family: Consolas;font-size: 50; color: aliceblue; background-color: grey;" onclick="location.href='."'ZianteuMain_Posts.html'".'"><br>
                </form>';
            }
            else {
                echo '<p style="font-family: Consolas; font-size: 50;"> <br>';
                echo "Oh, offensichtlich ist etwas falsch gelaufen.";
                echo "<a href='SigninSite.html'>Probiere es am Besten noch einmal.</a></p>";
            }
            
        ?>           
        </center> 
        
    </body>
</html>