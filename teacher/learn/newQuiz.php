<?php
    global $position;
    $position = 3;
    include "../header.php";

         
        $_SESSION["questionNumber"]=0;
        $_SESSION["questionCount"]=0;
        $_SESSION["answerCount"]=0;
        $_SESSION["quizId"]=0;
        ?>

        <h1>Neues Quiz erstellen</h1>
        <br>

        <form action="newQuiz.php" method="get">
            <input type="text" name="quizName" placeholder="Name des Quizzes">
            <p>
            <select name="subject">
                <option value="no" disabled selected>Bitte Fach auswählen</option>
                <?php 
                session_start();

                include "../../includes/DbAccess.php";             
                //Ausgabe aller fächer
                $sql="SELECT * FROM `subject`";
                $res=$conn->query($sql);
                $conn=null;

                $result=array();
                foreach ($res as $value) {
                    array_push($result, $value);
                }

                foreach ($result as $subject) { 
                    echo '<option value="'.$subject["subjectId"].'">'.$subject["long"].'</option>';
                }
                ?>
            </select>

            <p>

            Für welche Klassen ist dieses Quiz gedacht?
            <p>
            <input type="range" name="minClass" id="minClass" min="1" max="13" value="1" oninput="document.getElementById('minClassOut').value=document.getElementById('minClass').value"></input>
            <input type="number" name="minClassOut" id="minClassOut" min="1" max="13" value="1" oninput="document.getElementById('minClass').value=document.getElementById('minClassOut').value">
            <p>
            <input type="range" name="maxClass" id="maxClass" min="1" max="13" value="1" oninput="document.getElementById('maxClassOut').value=document.getElementById('maxClass').value"></input>
            <input type="number" name="maxClassOut" id="maxClassOut" min="1" max="13" value="1" oninput="document.getElementById('maxClass').value=document.getElementById('maxClassOut').value"\>
            <br>
            Welche Tags soll das Quiz haben? (Bitte durch Semikola abtrennen) <!--vllt erklärung v. "tags" (für lehrer?)!-->
            <input type="text" name="quizTags" placeholder="Tags des Quizzes">
            <input type="submit" name="newQuizSubmit" value="Eingabe bestätigen">

        </form>

        <?php
        $_SESSION["quizId"]=0;

        if (isset($_GET["newQuizSubmit"])) {
            //Überprüfen, ob alles gesetzt ist
            if (!empty($_GET["quizName"]) && !empty($_GET["subject"]) && !empty($_GET["quizTags"])) {
                $quizName=$_GET["quizName"];
                //Löschen der Anführungszeichen
                $quizName=str_replace('"', "", $quizName);
                $quizName=str_replace('`', "", $quizName);
                $quizName=str_replace('´', "", $quizName);
                $quizName=str_replace("'", "", $quizName);           

               
                $_SESSION["tags"]=explode("; ", $_GET["quizTags"]); //die Tags werden für später gespeichert
                            
                //alle (außer die Fragenanzahl) für das Quiz wichtigen Parameter werden zum Eintragen in die DB gespeicherts
                $_SESSION["quizName"]=$quizName;
                $_SESSION["quizTags"]=$tagsNoSpace;
                $_SESSION["quizSubject"]=$_GET["subject"];
                $_SESSION["minClass"]=$_GET["minClass"];
                $_SESSION["maxClass"]=$_GET["maxClass"];

                header("location: newQuestion.php");
            }

            else {
                echo '<script>alert("Bitte vervollständigen Sie Ihre Eingabe.");</script>';
            }
            
        }
            
        include "../footer.php";
?>