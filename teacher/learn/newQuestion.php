<?php
    global $position;
    $position = 3;
    include "../header.inc.php";
         

        if (!isset($_GET["submitQuestions"]) && !isset($_GET["answerCountSubmit"]) && !isset($_GET["answersSubmit"])) {
            echo '<h1>Frage '.($_SESSION["questionCount"]+1).'</h1>
            <p>
            <form action="newQuestion.php" method="get">
                <input type="text" name="question" placeholder="Frage">
                <p>
                <input type="number" name="answerCount" placeholder="Anzahl der Antwortmöglichkeiten">
                <p>
                <input type="submit" name="answerCountSubmit">
                <p>
                <input type="submit" name="submitQuestions" value="Eingabe der Fragen beenden">
            </form>';
        }

        else if (isset($_GET["answerCountSubmit"])) {
            $question=$_GET["question"];
            //Löschen der Anführungszeichen
            $question=str_replace('"', "", $question);
            $question=str_replace('`', "", $question);
            $question=str_replace('´', "", $question);
            $question=str_replace("'", "", $question);


            
                echo '<h1>'.$question.'</h1>
                    <form action="newQuestion.php" method="get">
                        <input type="text" name="question" value="'.$question.'" hidden="true">
                        <p>';

                if (!empty($_GET["answerCount"])) {
                    $_SESSION["answerCount"]=$_GET["answerCount"];

                    
                    for ($i=0;$i<$_GET["answerCount"];++$i) { //Erstellen der Antwortmöglichkeiten
                        echo '           
                            <input type="checkbox" name="possibleAnswerRight'.$i.'">
                            <input type="text" name="possibleAnswer'.$i.'" placeholder="Antwortemöglichkeit '.($i+1).'">
                            <p>';
                    }
                    echo '<input type="submit" name="answersSubmit">
                    </form>';
                }

                else {
                    echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe.");</script>';
                }
            

            }

        
        else if (isset($_GET["answersSubmit"])) {
            
            
            
        

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
                        //Speichern aller Antwortmöglichkeiten
                        $possibleAnswers[$i]=$_GET["possibleAnswer".$i]; 

                        //Anführungszeichen löschen
                        $possibleAnswers[$i]=str_replace('"', "", $possibleAnswers[$i]);
                        $possibleAnswers[$i]=str_replace('`', "", $possibleAnswers[$i]);
                        $possibleAnswers[$i]=str_replace('´', "", $possibleAnswers[$i]);
                        $possibleAnswers[$i]=str_replace("'", "", $possibleAnswers[$i]);

                        if (isset($_GET["possibleAnswerRight".$i])) {
                            $rightAnswers[$i]= $possibleAnswers[$i]; //Alle richtigen Antwortmöglichkeiten
                        }
                    }
                    
                    //Insert in den array
                    if (!isset($_SESSION["questionNumber"])) {
                        $_SESSION["questionNumber"]=0;
                    }

                    if (!isset($_SESSION["questionCount"])) {
                        $_SESSION["questionCount"]=0;
                    }

                    $_SESSION["questions"][$_SESSION["questionCount"]]=array($_GET["question"],$possibleAnswers,$rightAnswers,$_SESSION["answerCount"],$_SESSION["questionCount"]); //Anzahl der Antwortmöglichkeiten muss für das Bearbeiten gespeichert werden, Nummer der Frage für das Löschen

                    ++$_SESSION["questionNumber"];
                    ++$_SESSION["questionCount"];

                    header("location: newQuestion.php");
                }

                else {
                    echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe.");';
                }
              
        }

        else if (isset($_GET["submitQuestions"])) {
            header("location: showQuestions.php");
        }

        
        include "../footer.inc.php";
?>