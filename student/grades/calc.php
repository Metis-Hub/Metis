<?php
    // ++++ Header ++++
    global $position;
    $position = 1;
    include("./../header.inc.php");

    $GET_LINE = "";
    foreach($_GET as $key => $value) $GET_LINE .= $key . "=" . $value . "&";

    global $name;
    if(!isset($_SESSION["subjekt"]) || !isset($_SESSION["subj"])) header("location: ./../grades/");
    else $name = $_SESSION["subjekt"];

    if(isset($_GET["reset"])) {
        unset($_GET);
        $_GET["save"] = true;
        $_SESSION["num"] = 0;
    }

    if(isset($_GET["save"])) {
        
        // ++++ Löschen der Sessions ++++
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
?>
    <nav>
        <a href="index.php">zur&uuml;ck</a>
        <a href="calc.php?<?php echo "save=true&" . $GET_LINE;?>">speichern</a>
        <a href="calc.php?<?php echo "reset=true&" . $GET_LINE;?>">reset</a>
    </nav>
    <div>
        <p><h1><?php echo $name;?></h1></p>
        <p id="average"></p>
        <form action="calc.php" method="get">
            <table border="0"><?php
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
                                echo $input[1][1] . ($i - $n_jumps) . $input[1][2] . $_GET[$i] . $input[1][3];
                            }
                            else {  // Wenn das Feld leer ist, wird es übersprungen
                                $n_jumps++;
                            }
                            $i2 = $i;
                        }
                        echo $input[1][1] . ($i2 - $n_jumps + 1) . $input[1][4] . $input[1][3];
                        $_SESSION["num"] = $_SESSION["num"] - $n_jumps;
                    }
                    ?>
                    <td><input type="submit" name="addGrade" value="+" /></td>
                </tr>
                <tr>
                    <!-- Loeschen-Buttons --><?php
                        echo "\n";
                        for($i = 0; $i <= $_SESSION["num"] - 1; $i++) {
                            echo $input[2][1] . $i . $input[2][2];
                        }
                    ?>
                </tr>
            </table>
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
        </form>
    </div>

</body>
</html>