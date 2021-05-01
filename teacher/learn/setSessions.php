<?php
    global $position;
    $position = 3;
    include "../header.php";
    session_start();
    $_SESSION["questionNumber"]=0;
    $_SESSION["questionCount"]=0;
    $_SESSION["answerCount"]=0;
    $_SESSION["quizId"]=0;

    header("location: newQuiz.php");
    include "../footer.php";
?>