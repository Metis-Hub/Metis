<html>
    <head>
        <title>Metis - Quizzes</title>
    </head>
    <body>
        <?php
        session_start();
        $_SESSION["questionNumber"]=0;
        $_SESSION["questionCount"]=0;
        $_SESSION["answerCount"]=0;
        $_SESSION["quizId"]=0;

        header("location: newQuiz.php");
        ?>
    </body>
</html>