<?php
    global $position;
    $position = 4;
    include "../header.php";

    echo '
	<header>
		<nav>
			<div><a href="vocRequestDefault.php">Vokabeltrainer</a></div>
			<div><a href="quizSearch.php" class="active">Quizze</a></div>
			<div><a href="trainCalc.php">Kopfrechnen</a></div>
		</nav>
	</header>';
?>
    <form action="quizSearch.php" method="get">
        <b>Nach Themen suchen:</b>
        <br>
        <input type="text" name="tags" placeholder="Suche (verschiedene Tags durch Semikola abtrennen)" style="width: 10cm;">
        <p>
        Klassen (von...bis...):
        <br>
        <input type="range" name="minClass" id="minClass" min="1" max="13" value="1" oninput="document.getElementById('minClassOut').value=document.getElementById('minClass').value"></input>
        <input type="number" name="minClassOut" id="minClassOut" min="1" max="13" value="1" oninput="document.getElementById('minClass').value=document.getElementById('minClassOut').value">
        <p>
        <input type="range" name="maxClass" id="maxClass" min="1" max="13" value="13" oninput="document.getElementById('maxClassOut').value=document.getElementById('maxClass').value"></input>
        <input type="number" name="maxClassOut" id="maxClassOut" min="1" max="13" value="13" oninput="document.getElementById('maxClass').value=document.getElementById('maxClassOut').value"\>
        <p>
         <!--nach Fach filtern!-->
         <select name="subject">
                <option value="all">Quizze aus allen Fächern auswählen</option>

                <?php 
                include "../../includes/DbAccess.php";           
                //Ausgabe aller fächer
                $sql="SELECT * FROM `subject`";
                $res=$conn->query($sql);
                $conn->close();

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
        <input type="submit" name="searchTopics" value="Suche">
        <p>
        <b>Nach speziellem Quiz suchen:</b>
        <br>
        <input type="text" name="searchedId" placeholder="Quiz-Kennnummer" style="width: 10cm;">
        <p>
        <input type="submit" name="searchId" value="Suche">
    </form>


        <?php
            //Suche nach Themen
            if (isset($_GET["searchTopics"])) {
                //Speichern des Faches, wenn eines ausgewählt ist (inkl. SQL für einfacheres Auswählen)
                if ($_GET["subject"]!="all") {
                    $sqlSubject="AND `quizzes`.`subjectId` LIKE ".$_GET["subject"]."";
                }
                else {
                    $sqlSubject="";
                }

                //Speichern aller Quizze
                $search=explode("; ", $_GET["tags"]);

                $resultQuiz=array();
                foreach ($search as $tag) {    
                    include "../../includes/DbAccess.php";     
                    $sqlQuiz="SELECT * FROM `quizzes` INNER JOIN `subject` ON `quizzes`.`subjectId` = `subject`.`subjectId` INNER JOIN `quizTags` ON `quizTags`.`quizId` = `quizzes`.`Id` WHERE `quiztags`.`tag` LIKE '".$tag."' AND `minClass` >= ".$_GET["minClass"]." AND `maxClass` <= ".$_GET["maxClass"]." ".$sqlSubject;
                    $resQuiz=$conn->query($sqlQuiz);
                    $conn->close();

                 
                    foreach ($resQuiz as $value) {
                        array_push($resultQuiz, $value);
                    }


                }

                $resultQuiz=array_unique($resultQuiz, SORT_REGULAR); //Entfernen bei mehrfach gespeichertem Quiz

                //Überprüfen ob es leer ist
                if(empty($resultQuiz)) {
                    echo '<h1>Wir konnten leider keine deiner Suche entsprechenden Quizze finden.</h1>';
                }

                else {
                     //Ausgaben in eienr Tabelle
                    echo '<table border>
                    <tr>
                        <th style="width:9cm">Name</th>
                        <th style="width:3cm">Fach</th>
                        <th style="width:5cm">Klassen</th>
                        <th style="width:3cm">Zahl der Fragen</th>
                    <tr>';

                    foreach ($resultQuiz as $quiz) {
                        echo '<tr>';
                        echo '<td>'.$quiz["name"].'</td>';
                        echo '<td>'.$quiz["long"].'</td>';
                        echo '<td> Klasse '.$quiz["minClass"].' bis Klasse '.$quiz["maxClass"].'</td>';
                        echo '<td>'.$quiz["questionCount"].'</td>';

                        echo '<form action="quizSolve.php" method="get">
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
            

               
            }

            //Suche nach ID
            else if (isset($_GET["searchId"])) {          
    
                    //Speichern aller Quizze
                    $searchedId=$_GET["searchedId"];  
                    $resultQuiz=array();
                     
                        include "../../includes/DbAccess.php";     
                        $sqlQuiz="SELECT * FROM `quizzes` INNER JOIN `subject` ON `quizzes`.`subjectId` = `subject`.`subjectId` WHERE `quizzes`.`Id` LIKE '".$searchedId."'";
                        $resQuiz=$conn->query($sqlQuiz);
                        $conn->close();
    
                     
                        foreach ($resQuiz as $value) {
                            array_push($resultQuiz, $value);
                        }

    
                    //Überprüfen ob es leer ist
                    if(empty($resultQuiz)) {
                        echo '<h1>Wir konnten leider keine deiner Suche entsprechenden Quizze finden.</h1>';
                    }
    
                    else {
                         //Ausgaben in eienr Tabelle
                        echo '<table border>
                        <tr>
                            <th style="width:9cm">Name</th>
                            <th style="width:3cm">Fach</th>
                            <th style="width:5cm">Klassen</th>
                            <th style="width:3cm">Zahl der Fragen</th>
                        <tr>';
    
                        foreach ($resultQuiz as $quiz) {
                            echo '<tr>';
                            echo '<td>'.$quiz["name"].'</td>';
                            echo '<td>'.$quiz["long"].'</td>';

                            if ($quiz["minClass"] == $quiz["maxClass"]) {
                                echo '<td> Klasse '.$quiz["minClass"].'</td>';
                            }
                            else {
                                echo '<td> Klasse '.$quiz["minClass"].' bis Klasse '.$quiz["maxClass"].'</td>';
                            }
                            
                            echo '<td>'.$quiz["questionCount"].'</td>';
    
                            echo '<form action="quizSolve.php" method="get">
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
            }
                
    
                   
                
                    ?>

                </table>
     

<?php
    include "../footer.php";
?>