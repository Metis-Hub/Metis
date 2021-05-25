<?php
    global $position;
    $position = 4;
    include "../header.inc.php";
    
    echo '
	<header>
		<nav>
			<div><a href="vocRequestDefault.php">Vokabeltrainer</a></div>
			<div><a href="quizSearch.php" class="active">Quizze</a></div>
			<div><a href="trainCalc.php">Kopfrechnen</a></div>
		</nav>
	</header>';

    if (isset($_GET["solveQuiz"])) {
        //Vorbereiten des Quiz:

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

        //Starten des Quiz:
        header("location: quizSolve.php?nextQuestion=1");
    }

    else if (isset($_GET["nextQuestion"])) {
        //Überprüfung, ob alle Fragen richtig beantwortet wurden
        

            //Abfragen der Antwortemöglichkeiten in der DB
             include "../../includes/DbAccess.php";  
            $sqlGetAnswers="SELECT `answer` FROM `answers` WHERE `questionId`=".$_SESSION["questions"][$_SESSION["questionNumber"]]["questionId"]."";
            $resAnswers=$conn->query($sqlGetAnswers);
            $conn->close();

       

            $_SESSION["answers"]=array();
            foreach ($resAnswers as $answer) {
                array_push($_SESSION["answers"], $answer);
            }

            //ausgabe der Frage u. Antwortemöglichkeiten
            echo '<h1> Frage '.($_SESSION["questionNumber"]+1).'/'.$_SESSION["questionCount"].': '.$_SESSION["questions"][$_SESSION["questionNumber"]]["question"].'</h1>';

            echo '<form action="quizSolve.php" method="POST">'; //es ist post, damit man die Eingabe nicht nach der Mittteilung der richigen Antworten bearbeiten kann

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
        $conn->close();

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

            echo '<h1>Super! Deine Antwort war richtig!</h1>
                <br>
                <form action="quizSolve.php" method="get">';

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

            echo '<h1>Schade. Deine Antwort war nicht richtig.</h1>
            <br/>Die richtige Antwort wäre gewesen: ';
            foreach ($correctAnswers as $correctAnswer) {
                echo $correctAnswer["answer"].'<br/>';
            }
            
            echo '<br/><br/><form action="quizSolve.php" method="get">';
                
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

    include "../footer.inc.php";
?>