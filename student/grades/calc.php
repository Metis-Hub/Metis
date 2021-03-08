<?php
    session_start();

    global $name;

    if(!isset($_SESSION["subjekt"]) || !isset($_SESSION["subj"])) {
        header("location: ./../grades/");
    }
    else {
        $name = $_SESSION["subjekt"];
    }

    if(isset($_GET["reset"])) {
        unset($_GET);
        $_GET["save"] = true;
        $_SESSION["num"] = 0;
    }
    elseif(isset($_GET["back"])) {
        unset($_GET);
        header("location: ./../grades/");
    }

    if(isset($_GET["save"])) {
        
        // Löschen der Sessions
		$number = $_SESSION["subj"];
        $sum = 0;

        for($i = 0; $i < $_SESSION["num"]; $i++) {
            $_SESSION["average".$number][$i] = $_GET[$i];
            $sum += $_GET[$i];
        }

        if($sum != 0) $_SESSION["average".$number]["num"] = $sum / $_SESSION["num"];
        else $_SESSION["average".$number]["num"] = 0.00;

        $_SESSION["average".$number]["n"] = $_SESSION["num"];
        header("location: ./../grades/");
    }

    if(!isset($_SESSION["num"])) {
        $_SESSION["num"] = 0;
    }

    $input = array(
    1 => array(1 => "\t\t\t\t\t<td><input name=\"", 2 => "\" class=\"num\" type=\"number\" max=\"6\" min=\"1\" placeholder=\"Note\" value=\"", 3 => "\" /></td>\n",
                4 => "\" type=\"number\" max=\"6\" min=\"1\" placeholder=\"Note\" autofocus value=\""),
    2 => array(1 => "\t\t\t\t\t<td><input name=\"del", 2 => "\" class=\"minus\" type=\"submit\" value=\"&minus;\" /></td>\n")
    );

    if(isset($_GET["addGrade"])) {
        if(isset($_GET[$_SESSION["num"]]) && $_GET[$_SESSION["num"]] != null) {
            $_SESSION["num"]++;
        }
    }
    global $position;
    $position = 1;
    include("./../header.php");
?>
    <div>
        <p><h1><?php echo $name;?></h1></p>
        <form action="calc.php" method="get">
            <table><?php
                    echo "\n\t\t\t\t<tr>\n";
                

                    $jumps = array();
                    $n_jumps = 0;
                        
                    for($i = 0; $i < $_SESSION["num"]; $i++) {
                        if(isset($_GET["del".$i])) {
                            array_push($jumps, $i);
                        }
                    }

                    if($_SESSION["num"] != 0) {
                        for($i = 0; $i < $_SESSION["num"]; $i++) {
                            if(!isset($_GET[$i]) || $_GET[$i] == null) {
                                array_push($jumps, $i);
                            }
                        }
                    }

                    if($_SESSION["num"] == 0) {
                        echo $input[1][1] . 0 . $input[1][4] . $input[1][3];    // Wenn das Dokument leer ist
                    }
                    else {
                        $i2 = 0;
                        for($i = 0; $i < $_SESSION["num"]; $i++) {
                            $isnJmp = true;
                            foreach($jumps as $jmp) {
                                if($i == $jmp) {
                                    $isnJmp = false;
                                }
                            }
                            if($isnJmp) {
                                echo $input[1][1] . $i - $n_jumps . $input[1][2] . $_GET[$i] . $input[1][3];
                            }
                            else {  // Wenn das Feld leer ist, wird es übersprungen
                                $n_jumps++;
                            }
                            $i2 = $i;
                        }
                        echo $input[1][1] . $i2 - $n_jumps + 1 . $input[1][4] . $input[1][3];
                        $_SESSION["num"] = $_SESSION["num"] - $n_jumps;
                    }
                    ?>
                    <td><input type="submit" name="addGrade" value="+" /></td>
                </tr>
                <tr><?php
                        echo "\n";
                        for($i = 0; $i <= $_SESSION["num"] - 1; $i++) {    // Gibt die "löschen"-Buttons aus
                        echo $input[2][1] . $i . $input[2][2];
                        }
                    ?>
                </tr>
            </table>
            <br />
            <p id="average">
                <script type="text/javascript">
                    window.onload = function() {
                        var sum = 0.0;
                        const num = document.querySelectorAll('input[class="num"]')
                        for(var i = 0; i < num.length; i++) {
                            sum += parseFloat(num[i].value + ".0");
                        }
                        if(sum != 0) {
                            document.getElementById("average").innerHTML = "Ihr Durchschnitt betr&auml;gt: " + 
                            (parseFloat(Math.round((sum/parseFloat(num.length)*100))/100).toString());
                        }
                    }
                </script>
            </p>
            <br />
            <table>
                <tr>
                    <td><input type="submit" name="reset" value="reset" /></td>
                    <td><input type="submit" name="back" value="zur&uuml;ck" /></td>
                    <td><input type="submit" name="save" value="speichen" /></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>