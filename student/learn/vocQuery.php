<?php
    global $position;
    $position = 4;
    include "../header.php";
    
         

        if (isset($_GET["allVocsConfirm"])) {
            $lang = $_SESSION["studentLang"];
            $minNiveau = $_GET["minNiveau"];
            $maxNiveau = $_GET["maxNiveau"];

            $queryLimit = $_SESSION["queryLimit"];

            $langs = ""; //ausgwewählte Sprachen

            foreach ($lang as $i) {
                $langs .=  "'" . $i . "',";
            }

            /* Verbindung aufnehmen und Datenbank
            auswählen */
            include("../../includes/DbAccess.php");

            $sqlVocs = "SELECT lang, vocab, transl, niveau FROM vocabs WHERE lang IN ( " . substr($langs, 0, -1) . " ) AND niveau >= " .
            $minNiveau . " AND niveau <= " . $maxNiveau . " ORDER BY RAND() LIMIT " . $queryLimit . "";
            /* SQL-Abfrage ausführen */
            $res = $conn->query($sqlVocs);

            /* Verbindung schließen */
            $conn->close();
        } else if (isset($_POST["studentSolSubmit"])) {
    
            $queryNumber = $_POST["queryNumber"];
            $studentSol = $_POST["sol"];

            $solRight = false; //überprüft, ob die antwort richtich ist

            
            $difTransls = explode (", " , $_SESSION["resultVocs"][$queryNumber]["transl"]);
                

            foreach ($difTransls as $transl) {
                if (strtoupper($studentSol) == strtoupper($transl)) {
                    $solRight = true;
                    break;
                }
            }
            
            if ($solRight == true) {

                if (count($difTransls) > 1) { //falls es mehrere bedeutungen gibt, werden diese ebenfalls ausgegeben

                    $allMeanings = implode(', ', $difTransls);

                    echo "\t<script>alert(\"Deine Antwort war richtig. Die Bedeutungen der Vokabel \"" .
                    $_SESSION["resultVocs"][$queryNumber]["vocab"] . "\" sind: \"" . $allMeanings . ".\");</script>\n";
                }
                else {
                    echo "\t<script>alert(\"Deine Antwort war richtig.\");</script>\n";
                }

                array_splice($_SESSION["resultVocs"], $queryNumber, 1);
            }

            else {
                echo "\t<script>\n";
                echo "\t\talert(unescape('Deine Antwort war leider falsch. Die richtige Antwort w%E4re \""
                     . $_SESSION["resultVocs"][$queryNumber]["transl"] . "\" gewesen.'));";
                echo "\t</script>";
            }
        }

        $queriedNumber = rand(0, (count($_SESSION["resultVocs"])-1));

        if (isset($_SESSION["resultVocs"][$queriedNumber])) {

            echo "\t<h2>Was bedeutet " . $_SESSION["resultVocs"][$queriedNumber]["vocab"] . "?</h2>\n"; //Ausgabe der abgefragten Vokabel
        
            echo "\t<form action=\"vocQuery.php\" method=\"POST\" name=\"studentSolution\">\n";
            echo "\t\t<input type=\"text\" name=\"sol\" placeholder=\"Bitte gib die Übersetzung an\" autocomplete=\"off\" />\n";
            echo "\t\t<input type=\"number\" name=\"queryNumber\" value=\"" . $queriedNumber . "\" hidden=\"true\" />\n";
            echo "\t\t<input type=\"submit\" name=\"studentSolSubmit\" value=\"Eingabe überprüfen\" />\n";
            echo "\t</form>\n";
        }
        else {
            header("location: vocAllSolved.php"); //muss auf ne andere seite geleitet werden (wegen refreshing) @Jakob neeee @doot dooooooooooooch
        }
    ?>


<?php
    include "../footer.php";
?>