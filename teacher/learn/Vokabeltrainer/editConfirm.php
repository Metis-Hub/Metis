<html>
    <head>
        <title>Metis - Vokabeltrainer</title>
    </head>
    <body>
        <?php
        session_start();

        $vocNumber=$_GET["vocNumber"];

        if (!empty($_GET["language"]) && !empty($_GET["vocab"]) && !empty($_GET["transl"]) && !empty($_GET["niveau"])) {
            $_SESSION["vocabs"][$vocNumber][0]=$_GET["language"];
            $_SESSION["vocabs"][$vocNumber][1]=$_GET["vocab"];
            $_SESSION["vocabs"][$vocNumber][2]=$_GET["transl"];
            $_SESSION["vocabs"][$vocNumber][3]=$_GET["niveau"];
        }

        header ("location: vSubmit.php");

        ?>               
    </body>
</html>