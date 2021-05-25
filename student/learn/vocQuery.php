<?php
    global $position;
    $position = 4;
    include "../header.inc.php";
    
    echo '
	<header>
		<nav>
			<div><a href="vocRequestDefault.php" class="active">Vokabeltrainer</a></div>
			<div><a href="quizSearch.php">Quizze</a></div>
			<div><a href="trainCalc.php">Kopfrechnen</a></div>
		</nav>
	</header>';

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

            header("location: vocQuery.php?nextVoc=1");

        } 
        
        else if (isset($_POST["studentSolSubmit"])) {
    
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

                    echo "<h1>Super! Deine Antwort war richtig!</h1>
                    <br/>
                    Die Bedeutungen der Vokabel \"" . $_SESSION["resultVocs"][$queryNumber]["vocab"] . "\" sind: \"" . $allMeanings . ".\"\n;
                    <br/><br/>";                 
                    echo "<form action=\"vocQuery.php\" method=\"get\">            
                            <input type=\"submit\" name=\"nextVoc\" value=\"Zur nächsten Vokabel gehen\">
                        </form>";                    
                }

                else {
                    echo "\t<h1>Super! Deine Antwort war richtig!</h1>\n
                    <br/>";                 
                    echo "<form action=\"vocQuery.php\" method=\"get\">            
                            <input type=\"submit\" name=\"nextVoc\" value=\"Zur nächsten Vokabel gehen\">
                        </form>";           
                
                }

                array_splice($_SESSION["resultVocs"], $queryNumber, 1);
            }

            else {
                echo "\t\t<h1>Deine Antwort war leider falsch!</h1> 
                <br/>
                Die richtige Antwort wäre \"". $_SESSION["resultVocs"][$queryNumber]["transl"] . "\" gewesen.
                <br/><br/>                  
                <form action=\"vocQuery.php\" method=\"get\">            
                    <input type=\"submit\" name=\"nextVoc\" value=\"Zur nächsten Vokabel gehen\">
                </form>";           
            }
        }

        else if (isset($_GET["nextVoc"])) {
            
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
                header("location: vocAllSolved.php"); //muss auf ne andere seite geleitet werden (wegen refreshing)
            }
        }
    ?>


<?php
    include "../footer.inc.php";
?>