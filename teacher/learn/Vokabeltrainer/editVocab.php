<html>
    <head>
        <title>Mettis - Vokabeltrainer</title>
    </head>
    <body>              
        <?php
        session_start();

        $vocNumber=$_GET["vocNumber"]; //Zahl des Edit-Buttons

        if (isset($_GET["submitVocs"])) {
            if (!empty($_GET["language"]) && !empty($_GET["vocab"]) && !empty($_GET["transl"]) && !empty($_GET["niveau"])) {
                $_SESSION["vocabs"][$vocNumber][0]=$_GET["language"];
                $_SESSION["vocabs"][$vocNumber][1]=$_GET["vocab"];
                $_SESSION["vocabs"][$vocNumber][2]=$_GET["transl"];
                $_SESSION["vocabs"][$vocNumber][3]=$_GET["niveau"];

                header("location: vSubmit.php");
            }

            else {
                echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe");</script>';
            }
        }

        ?>

        <form action="editVocab.php" method="GET" name="inputVocs"> <!--Schreiben der Eingabe!-->
                Vokabel:
                    <p>
                    <select name="language" id="language">
                        <?php
                            echo '<option value="no"' . (($_SESSION["defaultLang"] == "no")? "selected" : "") . ' disabled selected>Bitte wählen Sie die Sprache der Eingabe aus</option>'; 

                                include "dbSelect.php";

                                $sql="SELECT langId, lang FROM langs";
                                /* SQL-Abfrage ausführen */
                                $db = $dbank->query($sql);                
                                /* Verbindung schließen */
                                $dbank = null;

                                foreach ($db as $ds) {                                    
                                    echo '<option value="'.$ds["langId"].'" '.(($_SESSION["vocabs"][$vocNumber][0] == $ds["langId"])? "selected" : "").'>'.$ds["lang"].'</option>';     
                                }        
                                
                                
                        ?>        

                        </select>      
                        <p>
                        <input type="text" name="vocab" id="vocab" placeholder="Vokabel" size="50" value="<?php echo $_SESSION['vocabs'][$vocNumber][1] ?>"></input>
                        <p>
                        <input type="text" name="transl" id="transl" placeholder="Übersetzung der Vokabel" size="50" value="<?php echo $_SESSION["vocabs"][$vocNumber][2]?>"></input>
                        <p>
                        <input type="number" name="niveau" id="niveau" min="0" max="13" placeholder="Anspruch der Vokabel (nach Klassenstufe)" value="<?php echo $_SESSION["vocabs"][$vocNumber][3]?>" size="50"></input>
                        <p>              
                        <input type="submit" name="submitVocs" id="submitVocs" value="Bearbeitung bestätigen">

                        <input type="number" name="vocNumber" value="<?php echo $vocNumber ?>" hidden="true"></input>

            </form> 
    </body>
</html>

