<?php
    global $position;
    $position = 4;
    include "../header.php";

     

    if (isset($_GET["solveQuiz"])) {
        //Abfragen der Fragenzahl & ID
        $_SESSION["questionCount"]=$_GET["questionCount"];
        $quizId=$_GET["quizId"];

        $_SESSION["questionNumber"]=0; //Zahl der Frage, welche abgefragt wird
        $_SESSION["rightAnswersCount"]=0; //Zahl der richtig beantworteten Fragen

        //Abfragen der Fragen (inkl. IDs f. Antworten)
        include "../../includes/DbAccess.php";  
        $sqlGetQuestions="SELECT `questions`.`question`, `questions`.`questionId` FROM `questions` WHERE `questions`.`quizId` LIKE ".$quizId."";
        $resGetQuestion=$conn->query($sqlGetQuestions);
        $conn->close();

        $_SESSION["questions"]=array();
        foreach ($resGetQuestion as $value) {
            array_push($_SESSION["questions"], $value);
        }

        

        echo '<h1>'.$_GET["quizName"].'</h1>
        <br>
        <form action="solveQuiz.php" method="get">
            <input type="submit" name="nextQuestion" value="Quiz starten">
        </form>';
    }

    else if (isset($_GET["nextQuestion"])) {
        //Überprüfung, ob alle Fragen richtig beantwortet wurden
        

            //Abfragen der Antwortemöglichkeiten in der DB
             include "../../includes/DbAccess.php";  
            $sqlGetAnswers="SELECT `answer` FROM `answers` WHERE `questionId`=".$_SESSION["questions"][$_SESSION["questionNumber"]]["questionId"]."";
            $resAnswers=$conn->query($sqlGetAnswers);

       

            $_SESSION["answers"]=array();
            foreach ($resAnswers as $answer) {
                array_push($_SESSION["answers"], $answer);
            }

            //ausgabe der Frage u. Antwortemöglichkeiten
            echo '<h1> Frage '.($_SESSION["questionNumber"]+1).'/'.$_SESSION["questionCount"].': '.$_SESSION["questions"][$_SESSION["questionNumber"]]["question"].'</h1>';

            echo '<form action="solveQuiz.php" method="POST">'; //es ist post, damit man die Eingabe nicht nach der Mittteilung der richigen Antworten bearbeiten kann

            $answerNumber=0;
            foreach ($_SESSION["answers"] as $answer) {
                echo '<input type="checkbox" name="possibleAnswer'.$answerNumber.'">';
                echo $answer["answer"];
                echo '<p>';
                ++$answerNumber;
            }

            echo '<input type="number" name="answerCount" value="'.$answerNumber.'" hidden="true">
                <input type="submit" name="checkAnswer" value="Antwort überprüfen">
            </form>';            
            
        
    }
    

    else if (isset($_POST["checkAnswer"])) {
        //Abfragen der richtigen Antwortemöglichkeiten in der DB
         include "../../includes/DbAccess.php";  
        $sqlGetCorrectAnswers="SELECT `answer` FROM `answers` WHERE `questionId`=".$_SESSION["questions"][$_SESSION["questionNumber"]]["questionId"]." AND `isCorrect` = 1";
        $resCorrectAnswers=$conn->query($sqlGetCorrectAnswers);

        $correctAnswers=array();
        foreach ($resCorrectAnswers as $value) {
            array_push($correctAnswers, $value);
        }


        //Speichern der abgegebenen Antwortmöglichkeiten
        $correctAnswersSubmitted=array();
        for ($i=0;$i<$_POST["answerCount"];++$i) {
            if (isset($_POST["possibleAnswer".$i])) {
                array_push($correctAnswersSubmitted, $_SESSION["answers"][$i]);
            }
        }


        //wird ausgeführt, wenn die richtigen Antworten den ausgewählten Antworten des Schülers entsprechen
        if ($correctAnswers == $correctAnswersSubmitted) {
            ++$_SESSION["questionNumber"];
            ++$_SESSION["rightAnswersCount"];

            echo '<h1>Super! Du hast die Frage richtig beantwortet!</h1>
                <form action="solveQuiz.php" method="get">';

            //wenn es dann keine Fragen mehr gibt, kann man das Quiz beenden
            if ($_SESSION["questionNumber"]<$_SESSION["questionCount"]) {                
                    echo '<input type="submit" name="nextQuestion" value="Zur nächsten Frage gehen">';
            }

            else {               
                echo '<input type="submit" name="endQuiz" value="Quiz beenden">';  
            }

            echo '</form>';

        }

        else {
            ++$_SESSION["questionNumber"];

            echo '<h1>Schade. Deine Antwort war nicht richtig. Die richtige Antwort wäre gewesen:
            <br>';
            foreach ($correctAnswers as $correctAnswer) {
                echo $correctAnswer["answer"].'<br>';
            }
            echo '<br>';
            
            echo '<form action="solveQuiz.php" method="get">';
                
            //wenn es dann keine Fragen mehr gibt, kann man das Quiz beenden
            if ($_SESSION["questionNumber"]<$_SESSION["questionCount"]) {                
                    echo '<input type="submit" name="nextQuestion" value="Zur nächsten Frage gehen">';
            }

            else {               
                echo '<input type="submit" name="endQuiz" value="Quiz beenden">';  
            }

            echo '</form>';
            
        }

        
    }

    else if (isset($_GET["endQuiz"])) {
        echo '<h1>Herzlichen Glückwunsch!</h1>
        <p>
        Du hast alle Fragen gelöst und '.$_SESSION["rightAnswersCount"].'/'.$_SESSION["questionCount"].' Punkten erzielt ('.(($_SESSION["rightAnswersCount"]/$_SESSION["questionCount"])*100).' %).
        <p>
        <form action="index.php">
            <input type="submit" value=\'Zurück zu "Lernen" gehen\'>
        </form>';
    }

    include "../footer.php";
?>