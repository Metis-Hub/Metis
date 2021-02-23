<?php
    session_start();

    if(!isset($_SESSION["num"])) {
        $_SESSION["num"] = 0;
    }

    if(isset($_GET["reset"])) {
        unset($_GET);
        $_SESSION["num"] = 0;
    }

    $input = array(
    1 => array(1 => "<td><input name=\"", 2 => "\" type=\"number\" max=\"6\" min=\"1\" placeholder=\"Note\" value=\"", 3 => "\" /></td>\n"),
    2 => array(1 => "<td><input name=\"del", 2 => "\" type=\"submit\" name=\"del\" value=\"l&ouml;schen\" /></td>\n")
    );

    if(isset($_GET["addGrade"])) {
        if(isset($_GET[$_SESSION["num"]]) && $_GET[$_SESSION["num"]] != null) {
            $_SESSION["num"]++;
        }
    }
?>
<html>
<head>
    <title>Notenrechner</title>
</head>
<body>
    <div>
        <form action="tmpTest.php" method="get">
            <table>
                <tr>
                    <?php
                        
                        $del = -1;
                        
                        for($i = 0; $i < $_SESSION["num"]; $i++) {
                            if(isset($_GET["del".$i])) {
                                $del = $i;
                            }
                        }

                        if($del == -1){
                            if(!isset($_GET[0]) || $_GET[0] == null) {
                                echo $input[1][1] . 0 . $input[1][2] . $input[1][3];
                            }
                            else {
                                echo $input[1][1] . 0 . $input[1][2] . $_GET[0] . $input[1][3];
                                for($i = 1; $i < $_SESSION["num"]; $i++) {
                                    echo $input[1][1] . $i . $input[1][2] . $_GET[$i] . $input[1][3];
                                }
                                echo $input[1][1] . $i . $input[1][2] . $input[1][3];
                            }
                        }
                        else {
                            $_SESSION["num"]--;
                            for($i = 0; $i < $del; $i++) {
                                echo $input[1][1] . $i . $input[1][2] . $_GET[$i] . $input[1][3];
                            }
                            for($i = $del; $i < $_SESSION["num"]; $i++) {
                                echo $input[1][1] . $i . $input[1][2] . $_GET[$i+1] . $input[1][3];
                            }
                            echo $input[1][1] . $i . $input[1][2] . $input[1][3];
                        }
                    ?>
                    <td><input type="submit" name="addGrade" value="Note hinzuf&uuml;gen" /></td>
                </tr>
                <tr>
                    <?php
                         for($i = 0; $i <= $_SESSION["num"] - 1; $i++) {
                            echo $input[2][1] . $i . $input[2][2];
                         }
                    ?>
                </tr>
                <tr>
                    <td><input type="submit" name="reset" value="reset" /></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>