<?php
    global $position;
    $position = 3;
    include "../header.inc.php";

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
                    echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe");</script>';
                }

            
        }

       

        else if (isset($_GET["submitVocs"])) {
            if (!empty($_GET["language"]) && !empty($_GET["vocab"]) && !empty($_GET["transl"]) && !empty($_GET["niveau"])) { //ggf. Hinzufügen der Vokabel
                $vocabs=$_SESSION["vocabs"];
                $vocabs[$_SESSION["vocNumber"]]=array($_GET["language"],$_GET["vocab"],$_GET["transl"],$_GET["niveau"]);
                $_SESSION["vocabs"]=$vocabs;
            }
            
            header("Location: vocShow.php");
        }

        else if (isset($_GET["back"])) {
            if ($_SESSION["vocNumber"]==0) { //wenn man nicht weiter zurück kann

            }

            else {
            --$_SESSION["vocNumber"]; //Eingabe zurück
      
            }
        }

        else {
            ++$_SESSION["vocNumber"]; //Eingabe vor
         
        }

        include "../footer.inc.php";
?>