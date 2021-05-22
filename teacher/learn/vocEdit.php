<?php
    global $position;
    $position = 3;
    include "../header.inc.php";

        $vocNumber=$_GET["vocNumber"]; //Zahl des Edit-Buttons

        if (isset($_GET["submitVocs"])) {
            if (!empty($_GET["language"]) && !empty($_GET["vocab"]) && !empty($_GET["transl"]) && !empty($_GET["niveau"])) {
                $_SESSION["vocabs"][$vocNumber][0]=$_GET["language"];
                $_SESSION["vocabs"][$vocNumber][1]=$_GET["vocab"];
                $_SESSION["vocabs"][$vocNumber][2]=$_GET["transl"];
                $_SESSION["vocabs"][$vocNumber][3]=$_GET["niveau"];

                header("location: vocShow.php");
            }

            else {
                echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe");</script>';
            }
        }        

        else if (isset($_GET["edit"])) {
            echo '
            <form action="vocEdit.php" method="GET" name="inputVocs"> <!--Schreiben der Eingabe!-->
                Vokabel:
                    <p>
                    <select name="language" id="language">';

                            echo '<option value="no"' . (($_SESSION["defaultLang"] == "no")? "selected" : "") . ' disabled selected>Bitte wählen Sie die Sprache der Eingabe aus</option>'; 

                                include "../../includes/DbAccess.php"; 

                                $sql="SELECT langId, lang FROM langs";
                                /* SQL-Abfrage ausführen */
                                $db = $conn->query($sql);                
                                /* Verbindung schließen */
                                $conn->close();

                                foreach ($db as $ds) {                                    
                                    echo '<option value="'.$ds["langId"].'" '.(($_SESSION["vocabs"][$vocNumber][0] == $ds["langId"])? "selected" : "").'>'.$ds["lang"].'</option>';     
                                }           

                        echo '</select>      
                        <p>
                        <input type="text" name="vocab" id="vocab" placeholder="Vokabel" size="50" value="'.$_SESSION["vocabs"][$vocNumber][1].'"></input>
                        <p>
                        <input type="text" name="transl" id="transl" placeholder="Übersetzung der Vokabel" size="50" value="'.$_SESSION["vocabs"][$vocNumber][2].'"></input>
                        <p>
                        <input type="number" name="niveau" id="niveau" min="0" max="13" placeholder="Anspruch der Vokabel (nach Klassenstufe)" value="'.$_SESSION["vocabs"][$vocNumber][3].'" size="50"></input>
                        <p>              
                        <input type="submit" name="submitVocs" id="submitVocs" value="Bearbeitung bestätigen">

                        <input type="number" name="vocNumber" value="'.$vocNumber.'" hidden="true"></input>

            </form>';
        }

        if (isset($_GET["delete"])) {
            unset($_SESSION["vocabs"][$_GET["vocNumber"]]);
            header("location: vocShow.php");
        }
        
  
    include "../footer.inc.php";
?>

