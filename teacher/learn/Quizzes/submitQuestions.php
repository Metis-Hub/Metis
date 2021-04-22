<html>
    <head>
        <title>Metis - Quizzes</title>
    </head>
    <body>
        <?php
        session_start();

        include "dbSelect.php";

        //Hinzufügen des Quizzes
        $sqlAddQuiz="INSERT INTO `quizzes`(`name`, `tags`, `subjectId`, `minClass`, `maxClass`, `questionCount`) VALUES ('".$_SESSION["quizName"]."','".$_SESSION["quizTags"]."',".$_SESSION["quizSubject"].",".$_SESSION["minClass"].",".$_SESSION["maxClass"].", ".($_SESSION["questionCount"]).")";
        $dbank->query($sqlAddQuiz); 

        $quizId=$dbank->insert_id; //Die ID des Quizzes für die Fragen wird festgelegt

        foreach ($_SESSION["questions"] as $question) {    
            
            $sqlAddQuestion='INSERT INTO `questions`(`quizId`, `question`) VALUES ('.$quizId.',"'.$question[0].'")';
            $dbank->query($sqlAddQuestion);

            var_dump($sqlAddQuestion);

            $questionId=$dbank->insert_id;

            foreach ($question[1] as $answer) {
                //ermittelt die Id der Frage
                

                var_dump($questionId); //funktioniert nt

                //Überprüft, ob die Antwort richtig ist
                $isTrue=0;
                foreach ($question[2] as $rightAnswer) {
                    if ($answer==$rightAnswer) {
                        $isTrue=1;
                        break;
                    }
                }

                //Hinzufügen der Antwortemöglichkeit
                $sqlAddAnswer='INSERT INTO `answers`(`questionId`, `answer`, `isCorrect`) VALUES ('.$questionId.',"'.$answer.'",'.$isTrue.')';
                $dbank->query($sqlAddAnswer);
            }

            
        }

        header("location: submitSucessfull.php");
        ?>
    </body>
</html>