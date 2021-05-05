<?php
    global $position;
    $position = 3;
    include "../header.php";
?>
        <style>
            table, th, td {
            border: 1px solid black;
        }

        table {text-align: center};
        </style>

        <center>
            <h1>Bitte überprüfen Sie Ihre Eingabe:</h1>
            <br>
            <table>
                <tr>
                    <th style="width: 9cm;">Sprache der Vokabel</th>  
                    <th style="width: 9cm;">Vokabel</th>
                    <th style="width: 9cm;">Übersetzung der Vokabel</th>
                    <th style="width: 9cm;">Anspruch der Vokabel</th>
                    <th style="width: 4cm;">Bearbeiten</th>
                    <th style="width: 4cm;">Löschen</th>
                </tr>
                <tr>

            <?php

                include "../../includes/DbAccess.php"; 
                $sql="SELECT langId, lang FROM langs";
                /* SQL-Abfrage ausführen */
                $res = $conn->query($sql);                
                /* Verbindung schließen */
                $conn->close();

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

                    echo '
                    <form name="editVocab" method="GET" action="editVocab.php">
                    <td style="text-align: center;">
                        <input type="submit" name="edit" value="Bearbeiten"\>
                    </td>
                    <td style="text-align: center;">
                        <input type="submit" name="delete" value="Frage löschen"\>
                    </td>
                    <input type="hidden" name="vocNumber" value="'.$i.'"\>
                    </form>'; //falls man was bearbeiten oder löschen möchte
                    

                    echo '</tr>';

                    ++$i;


                    
                } 
                echo '</table>';
          
        ?>

        <br>
        <form action="abgabeVocs.php" method="GET" name="submitVocs">            
            <input type="submit" value="Eingabe bestätigen" name="submitVocsSubmit"></input>
            <br>
            <b>Achtung! Diese Aktion kann nicht rückgängig gemacht werden! Eine Bearbeitung ist dann nicht mehr möglich.<b> 
            <p>          
        </form>

        <form action="vInput.php" method="GET">
            <input type="submit" value="Neue Vokabel erstellen" name="newQuestion"></input>
        </form>

        </center>
        
        
<?php
    include "../footer.php";
?>
