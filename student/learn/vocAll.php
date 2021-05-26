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
?>

    <style>
        table, th, td {
            border: 1px solid black;
        }

        table {
            text-align: center
        }
    </style>
       
    <?php

        if (!empty($_GET["lang"]) && !empty($_GET["minNiveau"]) && !empty($_GET["maxNiveau"]) && !empty($_GET["queryLimit"])) {

            $_SESSION["studentLang"] = $_GET["lang"]; //is als SESSION vllt nt so optimal
            $lang=$_SESSION["studentLang"];

            $minNiveau=$_GET["minNiveau"];
            $maxNiveau=$_GET["maxNiveau"];

            $_SESSION["queryLimit"] = $_GET["queryLimit"]; //hier auch
            $queryLimit = $_SESSION["queryLimit"];

            $_SESSION["resultVocs"] = array();

            $langs = ""; //ausgwewählte Sprachen

            foreach ($lang as $i) {
                $langs .= "'" . $i . "',";
            }

            //Abfrage der Vokabeln aus der DB

            /* Verbindung aufnehmen und Datenbank
            auswählen */
            include ("../../includes/DbAccess.php");

            $sqlVocs="SELECT lang, vocab, transl, niveau FROM vocabs WHERE lang IN ( " . substr($langs, 0, -1) . " ) AND niveau>=".$minNiveau." AND niveau<=".$maxNiveau." ORDER BY RAND() LIMIT ".$queryLimit."";
            /* SQL-Abfrage ausführen */
            $resVocs = $conn->query($sqlVocs);
            echo "<br />";

        
            $resultVocs = array();
            while($row = $resVocs->fetch_assoc()) {
                array_push($resultVocs, $row);
            }

            $_SESSION["resultVocs"] = $resultVocs;
                                          

            //Abfrage der vorhandenen Sprachen
            $sqlLangs="SELECT langId, lang FROM langs";
            /* SQL-Abfrage ausführen */
            $resLangs = $conn->query($sqlLangs);
            /* Verbindung schließen */
            $conn->close();

            $resultLangs=array(); //muss aus irgendwelchen gründen in ein anderes array geschreiben werden
            foreach ($resLangs as $value) {
                array_push($resultLangs, $value);
            }
    
            echo "\t<h1>Alle zu lernenden Vokabeln:</h1> <!--Tabelle zum Lernen!-->\n";
            echo "\t<table>\n";
            echo "\t\t<tr>\n";
            echo "\t\t\t<th style=\"width: 9cm;\">Sprache der Vokabel</th>\n";
            echo "\t\t\t<th style=\"width: 9cm;\">Vokabel</th>\n";
            echo "\t\t\t<th style=\"width: 9cm;\">Übersetzung der Vokabel</th>\n";
            echo "\t\t\t<th style=\"width: 9cm;\">Anspruch der Vokabel</th>\n";
            echo "\t\t</tr>\n";        

            foreach ($resultVocs as $dsVocs) {
                echo "\t<tr>"; 
                
                $foundLang = false;
                foreach ($resultLangs as $dsLangs) {                        
                    if ($dsVocs["lang"] == $dsLangs["langId"] && !$foundLang) {
                        echo "\t\t\t<td>" . $dsLangs["lang"] . "</td>\n";
                        $foundLang = true;
                    }
                }
            
                if (!$foundLang) {
                    echo "\t\t\t<td> Not found </td>\n";
                }                      

                echo "\t\t\t<td>" . $dsVocs["vocab"] . "</td>\n";
                echo "\t\t\t<td>" . $dsVocs["transl"]  ."</td>\n";
                echo "\t\t\t<td> Klasse " . $dsVocs["niveau"] . "</td>\n";
            }

            echo "\t\t</tr>\n";
            echo "</table>\n";
        } 
        else {
            echo "<script>\n";
            echo "alert(unescape(\"Bitte vervollst%E4ndige deine Eingabe\"));\n";
            echo "window.location.href=\"vocRequestDefault.php\"\n";
            echo "</script>\n";
        }
    ?>

    <p>
    <form action="vocQuery.php">
        <input type="submit" name="allVocsConfirm" value="Abfrage starten">
        <?php
            echo "<input type=\"hidden\" name=\"minNiveau\" value=\"" . $minNiveau . "\" \n";
            echo "<input type=\"hidden\" name=\"maxNiveau\" value=\"" . $maxNiveau . "\" \n";
        ?>
    </form>

<?php
    include "../footer.inc.php";
?>