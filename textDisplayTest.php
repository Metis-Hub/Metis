<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Metis - school made easy</title>
    </head>
    <body style="background-color: aliceblue;">
        <center>
            <p style="font-family: Haettenschweiler; font-size: 200;">
                Metis - school made easy
            </p>
        </center>

        <?php
            $text=$_POST["text"];
            echo '<center>
                    <p style="font-family: Consolas; font-size: 35;">
                        Überprüfen Sie Ihren Text noch einmal:
                        <br>    
                        <br>
                        <textarea cols="100" rows="7" style="font-size: 25; font-family: Gadugi;" name="text">'. $text .'</textarea>                        
                    </p>
                    <br>
                    <form action="PubishPHP.php" method="POST">' . //Existiert noch nicht
                        '<input type="submit" name="publish" value="Veröffentlichen" style="height:3cm;width:15cm; font-family: Consolas;font-size: 50; color: aliceblue; background-color: black;" onclick="location.href='."'PostTypeChoose.html'".'" ><br><br>
                    </form>
                </center>';



        ?>
               
           
        
        
    </body>
</html>