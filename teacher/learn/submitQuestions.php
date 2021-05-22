<?php
    global $position;
    $position = 3;
    include "../header.inc.php";
         

        include "../../includes/DbAccess.php"; 

        //Hinzufügen des Quizzes
        $sqlAddQuiz="INSERT INTO `quizzes`(`name`, `subjectId`, `minClass`, `maxClass`, `questionCount`) VALUES ('".$_SESSION["quizName"]."',".$_SESSION["quizSubject"].",".$_SESSION["minClass"].",".$_SESSION["maxClass"].", ".($_SESSION["questionCount"]).")";
        $conn->query($sqlAddQuiz);
        $quizId=$conn->insert_id; //Die ID des Quizzes für die Fragen u. Tags wird festgelegt

        foreach ($_SESSION["tags"] as $tag) {
            $sqlAddTag='INSERT INTO `quizTags`(`quizId`, `tag`) VALUES ('.$quizId.',"'.$tag.'")';
            $conn->query($sqlAddTag);
        }

        foreach ($_SESSION["questions"] as $question) {    
            
            $sqlAddQuestion='INSERT INTO `questions`(`quizId`, `question`) VALUES ('.$quizId.',"'.$question[0].'")';
            $conn->query($sqlAddQuestion);

            $questionId=$conn->insert_id;

            foreach ($question[1] as $answer) {
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
                $conn->query($sqlAddAnswer);
            }

            
        }

        $conn->close();

        header("location: QuizSubmitSucessfull.php");
        include "../footer.inc.php";
?>