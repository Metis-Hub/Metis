<?php
    global $position;
    $position = 3;
    include "../header.inc.php";
         

        echo '<table border>
                <tr>
                    <th style="width: 9cm;">Frage</th>  
                    <th style="width: 9cm;">Antwortmöglichkeiten</th>
                    <th style="width: 9cm;">Richtige Antwortmöglichkeiten</th>
                    <th style="width: 4cm;">Bearbeiten</th>
                    <th style="width: 4cm;">Löschen</th>
                </tr>';


        foreach ($_SESSION["questions"] as $question) {

            echo '<tr>'; //neue Zeile

            $answerNumber=1;

            echo '<td>'.$question[0].'</td>'; //Frage 

            echo '<td>';
            foreach ($question[1] as $answer) { //Antwortmöglichkeiten
                echo $answerNumber.") ".$answer.'<br>';
                ++$answerNumber;
            }
            echo '</td>';



            echo '<td>';
            foreach ($question[2] as $answer) { //Richtige Antwortmöglichkeiten
                echo "&nbsp;".$answer.'<br>';
            }
            echo '</td>';

            //Bearbeiten
            echo '
            <form method="GET" action="quizEditQuestion.php">
                <td style="text-align: center;">
                <input type="submit" name="edit" value="Bearbeiten"\>
                </td>
                <td style="text-align: center;">
                <input type="submit" name="delete" value="Frage löschen"\>
                </td>
                <input type="hidden" name="questionNumber" value="'.$question[4].'"\>
            </form>'; 
       

            echo '</tr>';
        }

        echo '</table>';

        echo '<form action="quizSubmit.php" method="get">
            <p>
            <center>
            <input type="submit" name="submitQuiz" value="Quiz bestätigen">
            <br>
            <b>Achtung! Diese Aktion kann nicht rückgängig gemacht werden! Eine Bearbeitung ist dann nicht mehr möglich.</b>
            </center>
        </form>';

        echo '<form action="quizNewQuestion.php" method="get">
                <p>
                <center>
                <input type="submit" name="newQuestion" value="Neue Frage erstellen">
                </center>
            </form>';
        include "../footer.inc.php";
?>