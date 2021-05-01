<?php
    global $position;
    $position = 3;
    include "../header.php";

         

        if (isset($_GET["delete"])) {
            unset($_SESSION["questions"][$_GET["questionNumber"]]);
            header("location: showQuestions.php");
        }

        else if (isset($_GET["edit"])) {
            $_SESSION["questionNumber"]=$_GET["questionNumber"]; //Nummer der zu bearbeitenden Frage
            //Anzahl der Antwortemöglichkeiten + Frage
            echo '<h1>'.$_SESSION["questions"][$_SESSION["questionNumber"]][0].'</h1>
                    <form action="editQuestion.php" method="get">              
                        <input type="text" name="question" placeholder="Frage" value="'.$_SESSION["questions"][$_SESSION["questionNumber"]][0].'">
                        <p>
                        <input type="number" name="answerCount" placeholder="Anzahl der Antwortmöglichkeiten" value="'.$_SESSION["questions"][$_SESSION["questionNumber"]][3].'">
                        <p>
                        <input type="submit" name="editNumberSubmit">
                    </form>';
                    
        }

        else if (isset($_GET["editNumberSubmit"])) {
            if ($_GET["answerCount"]<$_SESSION["questions"][$_SESSION["questionNumber"]][3]) {
                echo '<script>
                        alert("Die Anzahl der Antwortemöglichkeiten kann nicht kleiner sein als die ursprüngliche Anzahl der Antwortemöglichkeiten. Sollten Sie eine Antwortemöglichkeit löschen wollen, müssen Sie die Frage löschen und eine neue erstellen.");
                        window.location.href="showQuestions.php";
                    
                    </script>';
            }

            else {
                $answerCount=0; //Zahl der Antwort
                $_SESSION["answerCount"]=$_GET["answerCount"]; //Anzahl der benötigten Antwortmöglichkeiten

                echo '<h1>'.$_GET["question"].'</h1>
                        <form action="editQuestion.php" method="get">   
                        <input type="text" name="question" value="'.$_GET["question"].'" hidden="true"> 
                        <br>'; //Frage zum Übermitteln

                        //Ausgabe bereits geschriebener Antworten
                        foreach ($_SESSION["questions"][$_SESSION["questionNumber"]][1] as $answer) {

                            $checked="";
                            foreach ($_SESSION["questions"][$_SESSION["questionNumber"]][2] as $rightAnswer) {
                                if ($answer == $rightAnswer) {
                                    $checked = "checked";
                                    break;
                                }
                            }

                        echo '           
                            <input type="checkbox" name="possibleAnswerRight'.$answerCount.'" '. $checked .'>
                            <input type="text" name="possibleAnswer'.$answerCount.'" placeholder="Antwortemöglichkeit '.($answerCount+1).'" value="'.$answer.'">
                            <p>';
                            ++$answerCount;
                        }

                        //Ausgabe neuer Antwortfelder
                        for ($i=0;$i<($_SESSION["answerCount"]-$answerCount);++$i) { //läuft für die Anzahl an Eingabefeldern, die benötigt werden, aber noch nicht da sind
                            echo '           
                            <input type="checkbox" name="possibleAnswerRight'.($answerCount+$i).'">
                            <input type="text" name="possibleAnswer'.($answerCount+$i).'" placeholder="Antwortemöglichkeit '.($answerCount+$i+1).'">
                            <p>';
                        }

                        echo '<input type="submit" name="editSubmit">
                        </form>';
                    }
            }

            else if (isset($_GET["editSubmit"])) {
                //Überprüfen ob es gesetzt ist
                $allSet=true;
                for ($i=0;$i<$_SESSION["answerCount"];++$i) {
                    if (empty($_GET["possibleAnswer".$i])) {
                        $allSet=false;
                        break;
                    }
                }

                if ($allSet==true) { 

                    //Schreiben der Antwortmöglichkeiten in einen Array
                    $possibleAnswers=array();
                    $rightAnswers=array();
                    
                    for ($i=0;$i<$_SESSION["answerCount"];++$i) {
                        $possibleAnswers[$i]=$_GET["possibleAnswer".$i]; //Alle Antwortmöglichkeiten

                        if (isset($_GET["possibleAnswerRight".$i])) {
                            $rightAnswers[$i]=$_GET["possibleAnswer".$i]; //Alle richtigen Antwortmöglichkeiten
                        }
                    }
                    
                    //Insert in den array
                    $_SESSION["questions"][$_SESSION["questionNumber"]]=array($_GET["question"],$possibleAnswers,$rightAnswers,$_SESSION["answerCount"],$_SESSION["questions"][$_SESSION["questionNumber"]][4]);
                    
                    header("location: showQuestions.php");
                }

                else {
                    echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe.");';
                }
            }
            
            include "../footer.php";
?>