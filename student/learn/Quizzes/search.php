<html>
    <head>
        <title>Metis - Quizzes</title>
    </head>
    <body>

    <form action="search.php" method="get">
        <input type="text" name="tags" placeholder="Suche (verschiedene Tags durch Semikola abtrennen)" style="width: 10cm;">
        <input type="submit" name="search" value="Suche">
    </form>
        <?php
            if (isset($_GET["search"])) {
                //Speichern aller Quizzes
                $search=explode("; ", $_GET["tags"]);

                $resultQuiz=array();
                foreach ($search as $tag) {    
                    include "dbSelect.php";       
                    $sqlQuiz="SELECT * FROM `quizzes` INNER JOIN `subjects` ON `quizzes`.`subjectId` = `subjects`.`subjectId` WHERE `tags` LIKE '%".$tag."%' ";
                    $resQuiz=$dbank->query($sqlQuiz);
                    $dbank=null;

                 
                    foreach ($resQuiz as $value) {
                        array_push($resultQuiz, $value);
                    }


                }

                $resultQuiz=array_unique($resultQuiz, SORT_REGULAR); //Entfernen bei mehrfach gespeichertem Quiz
            

                //Ausgaben in eienr Tabelle
                echo '<table border>
                    <tr>
                        <th style="width:9cm">Name</th>
                        <th style="width:3cm">Fach</th>
                        <th style="width:5cm">Klassen</th>
                        <th style="width:9cm">Themen</th>
                        <th style="width:3cm">Zahl der Fragen</th>
                    <tr>';

                    foreach ($resultQuiz as $quiz) {
                        echo '<tr>';
                        echo '<td>'.$quiz["name"].'</td>';
                        echo '<td>'.$quiz["subjectName"].'</td>';
                        echo '<td> Klasse '.$quiz["minClass"].' bis Klasse '.$quiz["maxClass"].'</td>';
                        echo '<td>'.implode("; ", explode(";", $quiz["tags"])).'</td>';
                        echo '<td>'.$quiz["questionCount"].'</td>';

                        echo '<form action="solveQuiz.php" method="get">
                                <td>                            
                                <input type="submit" name="solveQuiz" value="Quiz bearbeiten">
                                <input type="number" name="quizId" value="'.$quiz["Id"].'" hidden="true">
                                <input type="number" name="questionCount" value="'.$quiz["questionCount"].'" hidden="true">
                                <input type="text" name="quizName" value="'.$quiz["name"].'" hidden="true">
                                </td>
                            </form>';
                        echo '</tr>';
                    }
                }
                    ?>

                </table>
     
    </body>
</html>