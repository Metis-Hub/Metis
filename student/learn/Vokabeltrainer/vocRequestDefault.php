<!DOCTYPE html>
<html lang="de">

<head>
    <title>Metis - Vokabeltrainer</title>
</head>

<body>
    <!--Einstellen der Lämge der Ranges!-->
    <style>
        input[type="range"] {
            width:300px;
        }
    </style>

    <form action="allVocs.php" method="GET" name="lang+niveau"> <!--Abfrage der Sprache und des Niveaus!-->
        Welche Sprachen soll abgefragt werden?
        <br />
        <?php
            include("dbSelect.php");

            $sql = "SELECT langId, lang FROM langs";
            /* SQL-Abfrage ausführen */
            $result = $dbank->query($sql);
            /* Verbindung schließen */
            $dbank = null;

            foreach ($result as $ds) {
                echo "\t\t<input type=\"checkbox\" name=\"lang[]\" value=\"" . $ds["langId"] . "\">" . $ds["lang"] . "</input>\n"; //Ausgabe aller mgl. Sprachen
                echo "\t\t<br />\n";
            }
        ?>

        <!--man kann noch ein höheres minNiveau als maxNiveau haben, der Slider kommt ja noch!-->
        <!--niedrigstes Niveau!-->
        Niedrigste Anspruchsstufe (entsprechend der Klassenstufe):
        <p>
            <input type="range" name="minNiveau" id="minNiveau" min="1" max="13" value="1" oninput="document.getElementById('minNiveauOut').value=document.getElementById('minNiveau').value"></input>
            <input type="number" name="minNiveauOut" id="minNiveauOut" min="1" max="13" value="1" oninput="document.getElementById('minNiveau').value=document.getElementById('minNiveauOut').value">
        </p>

        <!--höchstes Niveau!-->
        Höchste Anspruchsstufe (entsprechend der Klassenstufe):   
        <p>
            <input type="range" name="maxNiveau" id="maxNiveau" min="1" max="13" value="13" width="50" oninput="document.getElementById('maxNiveauOut').value=document.getElementById('maxNiveau').value"></input>
            <input type="number" name="maxNiveauOut" id="maxNiveauOut" min="1" max="13" value="13" oninput="document.getElementById('maxNiveau').value=document.getElementById('maxNiveauOut').value">
        </p>

        <!--Limit der abgefragten Vokabeln!-->
        Maximal abzufragende Vokabeln (sind ggf. weniger):
        <p>
            <input type="range" name="queryLimit" id="queryLimit" min="1" max="100" value="50" width="50" oninput="document.getElementById('queryLimitOut').value=document.getElementById('queryLimit').value"></input>
            <input type="number" name="queryLimitOut" id="queryLimitOut" min="1" max="100" value="50" oninput="document.getElementById('queryLimit').value=document.getElementById('queryLimitOut').value">
        </p>

        <p><input type="submit" name="classLangSubmit" id="classLangSubmit" value="Bestätigen"></input></p>
    </form>

</body>

</html>