<html>
    <head>
        <title>Metis - Vokabeltrainer</title>
    </head>
    <body>
        <style>
            table, th, td {
            border: 1px solid black;
        }

        table {text-align: center};
        </style>
        <?php
            session_start();
        ?>

        <center>
            <h1>Bitte überprüfen Sie Ihre Eingabe:</h1>
            <br>
            <table>
                <tr>
                    <th style="width: 9cm;">Sprache der Vokabel</th>  
                    <th style="width: 9cm;">Vokabel</th>
                    <th style="width: 9cm;">Übersetzung der Vokabel</th>
                    <th style="width: 9cm;">Anspruch der Vokabel</th>
                </tr>
                <tr>

            <?php

                include "DbAccess.php";
                $sql="SELECT langId, lang FROM langs";
                /* SQL-Abfrage ausführen */
                $res = $dbank->query($sql);                
                /* Verbindung schließen */
                $dbank = null;

                $result=array();
                foreach ($res as $value) {
                    array_push($result, $value);
                }

                $i=0; //gibt Stelle des arrays zum bearbeiten an

                foreach ($_SESSION["vocabs"] as $vocab) {
                    $foundLang=false;
                    foreach ($result as $ds) {                        
                        if ($vocab[0]==$ds["langId"] && !$foundLang) {
                            echo '<td>'.$ds["lang"].'</td>';
                            $foundLang=true;
                        }
                    }

                    if (!$foundLang) {
                        echo '<td> Not found </td>';
                    }

                    for ($j=1;$j<3;++$j) {
                        echo '<td>'.$vocab[$j].'</td>';
                    }

                    echo '<td> Klassenstufe '.$vocab[3].'</td>';

                    echo '<td>
                    <form name="editVocab" method="GET" action="editVocab.php">
                    <input type="submit" name="edit" value="Bearbeiten"\>
                    <input type="hidden" name="vocNumber" value="'.$i.'"\>
                    </form>
                    </td>'; //falls man was bearbeiten möchte

                    echo '</tr>';

                    ++$i;


                    
                } 
                echo '</table>';
          
        ?>

        <br>
        <form action="abgabeVocs.php" method="GET" name="submitVocs">
            <input type="submit" value="Eingabe bestätigen" name="submitVocsSubmit"></input>
        </form>

        </center>
        
        
    </body>
</html>
