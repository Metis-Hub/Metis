<html>
    <head>
        <link rel="icon" href="image/faviconMetis.ico" type="image/x-icon" />
        <title>
            Metis - Bitte stimmen Sie den Cookies zu
        </title>
        <?php
               
            session_start();
            $_SESSION["caller"] = "./";
            $_SESSION["cookies.php_type"] = "cookies";

            
            if ((!isset($_SESSION["cookies_set"])) || ($_SESSION["cookies_set"] == false)) {
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