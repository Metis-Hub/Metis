<?php
    global $position;
    $position = 3;
    $position2 = 0;
    include "../header.inc.php";
    include "./header.inc.php";
?>
        <style>
            input[type="number"] {
            width: 200px;
            }           
        </style>
        
        <?php

            $_SESSION["vocabs"]=array();
            $_SESSION["vocNumber"]=0; //Das ist später zum Zurückgehen wichtig.
 
            if (isset($_GET["eingabeVocsDefaultSubmit"])) { //Setzen der default-Werte
                $_SESSION["defaultLang"]="no"; //falls es keine Eingabe gab
                $_SESSION["defaultNiveau"]="";
               
                    if (isset($_GET["onlyLang"])) {
                        $_SESSION["defaultLang"]=$_GET["lang"];
                    }
                    if (isset($_GET["onlyNiveau"])) {
                        $_SESSION["defaultNiveau"]=$_GET["class"];
                    
                }   
    
                header('Location: vocNew.php');
            }
            ?>

            <form action="vocSetDefault.php" method="GET"> 
            <p>
				<input type="checkbox" name="onlyLang" id="onlyLang" value="1" <?php echo((isset($_POST["onlyLang"]) && $_POST["onlyLang"] == "1")? "checked" : "");?>> <!--falls man nur vokabeln einer sprache eigeben möchte!-->
					Nur Vokabeln einer Sprache eingeben
				</input>
			</p>
			<p>

            <?php
           include "../../includes/DbAccess.php"; 

            $sql="SELECT langId, lang FROM langs";
            /* SQL-Abfrage ausführen */
            $db = $conn->query($sql);                
            /* Verbindung schließen */
            $conn->close();

            echo '<select name="lang" id="lang">
            <option disabled selected>Bitte wählen Sie die Sprache der Eingabe aus</option>';

            foreach ($db as $ds) {
                
                echo '<option value="'.$ds["langId"].'">'.$ds["lang"].'</option>';     
            }

            echo '</select>';
        ?>
        
        <p>
		<input type="checkbox" name="onlyNiveau" id="onlyNiveau" value="1" <?php echo((isset($_POST["onlyNiveau"]) && $_POST["onlyNiveau"] == "1")? "checked" : "");?>> <!--falls man nur eine anspruchsstufe haben will!-->
			Nur Vokabeln einer Anspruchsstufe eingeben 
		</input>
    	</p>
            <p><input type="number" name="class" id="class" min="1" max="13" placeholder="Entsprechende Klassenstufe" <?php echo((isset($_POST["class"]))? "value = " . $_POST["class"] : "");?>></input></p>
            <p><input type="submit" value="Bestätigen" name="eingabeVocsDefaultSubmit"></input></p>

     
        </form>
<?php
    include "../footer.inc.php";
?>