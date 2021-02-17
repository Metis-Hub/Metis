<html>
    <head>
        <link rel="icon" href="faviconMetis.ico" type="image/x-icon" />
        <title>
            Metis - Bitte stimmen Sie den Cookies zu
        </title>
        <?php
               
            session_start();
            $_SESSION["caller"] = "./";
            $_SESSION["type"] = "cookies";

            
            if ((!isset($_SESSION["cookies_set"])) || ($_SESSION["cookies_set"] == false)) {
				echo "<script type=\"text/javascript\">\n

				var cookie = confirm(unescape(\"Diese Web-Site verwendet Cookies. Bitte stimmen Sie zu%2C um unsere Web-Site zu verwenden.\\n\"+\n
                                              \"%0ADiese Cookies verbleiben bis zur n%E4chsten L%F6schung Ihrer Browserdaten auf Ihren Computer.\"));\n\n

				if (cookie) {\n
                    window.location = \"CookiesConfirm.php\";\n
                }\n

				</script>\n";
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
            Um die Cookies (die jetzt noch nicht gesetzt wurden), gehen Sie einfach in Ihren Browserverlauf, und auf "Browserdaten l&ouml;schen".
        </p>
    </body>
</html>