<?php
    global $position;
    $position = 3;
    include "../header.php";
?>
        <style>
            input[type="number"] {
            width: 389px;
            }           
        </style>

        <?php

        if (isset($_GET["addVoc"])) {

            if (!empty($_GET["language"]) && !empty($_GET["transl"]) && !empty($_GET["vocab"]) && !empty($_GET["niveau"])) {                  
                    //Hinzufügen der Vokabel
                    $vocabs = isset($_SESSION["vocabs"]) ? $_SESSION["vocabs"] : array();
                    
                    $vocabs=$_SESSION["vocabs"];
                        $vocabs[$_SESSION["vocNumber"]]=array($_GET["language"],$_GET["vocab"],$_GET["transl"],$_GET["niveau"]);
                    $_SESSION["vocabs"]=$vocabs;

                    ++$_SESSION["vocNumber"];
               
                }

                else {
                    echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe.");</script>';
                }
                //header("Location: vInput.php");
        }

       

        else if (isset($_GET["submitVocs"])) {
            if (!empty($_GET["language"]) && !empty($_GET["vocab"]) && !empty($_GET["transl"]) && !empty($_GET["niveau"])) { //ggf. Hinzufügen der Vokabel
                $vocabs=$_SESSION["vocabs"];
                $vocabs[$_SESSION["vocNumber"]]=array($_GET["language"],$_GET["vocab"],$_GET["transl"],$_GET["niveau"]);
                $_SESSION["vocabs"]=$vocabs;
            }
            
            header("Location: vSubmit.php");
        }

        else if (isset($_GET["back"])) {
            if ($_SESSION["vocNumber"]==0) { //wenn man nicht weiter zurück kann
            echo '<script>alert("Sie können nicht weiter zurück gehen.");</script>';
            }

            else {
            --$_SESSION["vocNumber"]; //Eingabe zurück
      
            }
        }

        else if (isset($_GET["forward"])) {
            ++$_SESSION["vocNumber"]; //Eingabe vor         
        }

        $vocNumber=$_SESSION["vocNumber"];

        if (isset($_POST["message"])) {
            echo '<script>alert("'.$_POST["message"].'")</script>';
        }
        
        ?>

        <form action="vInput.php" method="GET" name="inputVocs"> <!--Schreiben der Eingabe!-->
            <input type="submit" name="back" value="Zurück">
            <input type="submit" name="forward" value="Vor">
            <p>
                Vokabel <?php echo $_SESSION["vocNumber"]+1;?>:
                    <p>
                    <select name="language" id="language">
                        <?php
                            if (empty($_SESSION["vocabs"][$vocNumber])) { //falls die Vokabel noch nicht geschrieben ist
                                echo '<option value="no"' . (($_SESSION["defaultLang"] == "no")? "selected" : "") . ' disabled selected>Bitte wählen Sie die Sprache der Eingabe aus</option>';

                                    include "../../includes/DbAccess.php"; 

                                    $sql="SELECT langId, lang FROM langs";
                                    /* SQL-Abfrage ausführen */
                                    $db = $conn->query($sql);                
                                    /* Verbindung schließen */
                                    $conn->close();

                                    foreach ($db as $ds) {                                    
                                        echo '<option value="'.$ds["langId"].'" '.(($_SESSION["defaultLang"] == $ds["langId"])? "selected" : "").'>'.$ds["lang"].'</option>';     
                                    }    
                            }  
                            
                            else { //also z.b. wenn man zurück und wieder vor geht (ist dann auch unten so)
                                echo '<option value="no"' . (($_SESSION["vocabs"][$vocNumber][0] == "no")? "selected" : "") . ' disabled selected>Bitte wählen Sie die Sprache der Eingabe aus</option>'; 

                                include "../../includes/DbAccess.php"; 

                                $sql="SELECT langId, lang FROM langs";
                                /* SQL-Abfrage ausführen */
                                $db = $conn->query($sql);                
                                /* Verbindung schließen */
                                $conn->close();

                                foreach ($db as $ds) {                                    
                                    echo '<option value="'.$ds["langId"].'" '.(($_SESSION["vocabs"][$vocNumber][0] == $ds["langId"])? "selected" : "").'>'.$ds["lang"].'</option>';     
                                }
                            }
                        ?>        

                        </select>      
                        <p>
                        <input type="text" name="vocab" id="vocab" placeholder="Vokabel"  value="<?php  if (!empty($_SESSION["vocabs"][$vocNumber])) { echo $_SESSION["vocabs"][$vocNumber][1];}?>" size="50"></input>
                        <p>
                        <input type="text" name="transl" id="transl" placeholder="Übersetzung der Vokabel" value="<?php  if (!empty($_SESSION["vocabs"][$vocNumber])) { echo $_SESSION["vocabs"][$vocNumber][2];}?>" size="50"></input>
                        <p>
                        <input type="number" name="niveau" id="niveau" min="0" max="13" placeholder="Anspruch der Vokabel (nach Klassenstufe)" value="<?php  if (empty($_SESSION["vocabs"][$vocNumber])) { echo $_SESSION["defaultNiveau"];} else {echo $_SESSION["vocabs"][$vocNumber][3];}?>"
                        size="50" ></input>

                        <p>              
                        <input type="submit" name="addVoc" id="addVoc" value="Vokabel hinzufügen">
                        <input type="submit" name="submitVocs" id="submitVocs" value="Vokabeln einreichen">
                        <br>      

            </form> 
<?php
    include "../footer.php";
?>