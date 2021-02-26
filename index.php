<html>
    <head>
        <link rel="icon" href="image/faviconMetis.ico" type="image/x-icon" />
        <title>
            Metis - Bitte stimmen Sie den Cookies zu
        </title>
        <?php
            include ("includes/DbAccess.php");
            $conn -> query("CREATE TABLE IF NOT EXISTS `student` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(45) NOT NULL,
                      `password` varchar(60) NOT NULL,
                      `email` varchar(45) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;");
            
            $conn -> query("CREATE TABLE IF NOT EXISTS `teacher` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(45) NOT NULL,
                      `password` varchar(60) NOT NULL,
                      `email` varchar(45) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;");
            $conn -> close();

            session_start();

            if(!isset($_SESSION["cookies"]["allow_set_cookies"])) {
                $_SESSION["cookie_caller"] = "./";
                $_SESSION["cookie_request_get"] = true;
            header("location: cookies.php");
            }

            
            if ((!isset($_SESSION["cookies"]["allow_set_cookies"])) || ($_SESSION["cookies"]["allow_set_cookies"] == false)) {
		        echo "<script type=\"text/javascript\"> var cookie=confirm(unescape(\"Diese Web-Site verwendet Cookies. Bitte stimmen Sie zu%2C um unsere Web-Site zu verwenden.\\n".
                "Diese Cookies verbleiben bis zur n%E4chsten L%F6schung Ihrer Browserdaten auf Ihren Computer.\"));if(cookie){window.location=\"CookiesConfirm.php\";}</script>";
			}
            else {
                header('location: index/');
            }
            
        ?>

    </head>
    <body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #c2f9ff;">
        <a style="color:#FF1919;" href="./">
            <b><u>Bitte akzeptieren Sie, das wir Cookies benutzen, um unsere Web-Site zu nutzten zu k&ouml;nnen.</u></b>
        </a>
        <p>
            <h2>Wof&uuml;r nutzten wir Cookies?</h2>
            <br />
            Wir nutzen Cookies, um Ihre Web-Site-Einstellungen auf Ihren PC zu speicher, damit Sie unsere Web-Site so wiederfinden, wie Sie sie verlie&szlig;en.
            <br />
            Keineswegs leiten wir Ihre Daten an andere Web-Sites weiter.
            <br />
            Um die Cookies (die jetzt noch nicht gesetzt wurden) zu l&ouml;schen, gehen Sie einfach in Ihren Browserverlauf, und auf "Browserdaten l&ouml;schen".
            <br /><br />
            Um mit Cookies forzufahren Klicken Sie bitte <a href="./">hier</a>.
        </p>
    </body>
</html>