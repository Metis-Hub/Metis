<html>
    <head>
        <title>Metis - Vokabeltrainer</title>
    </head>
    <body>
        <?php
        session_start();

        include "DbAccess.php";

        foreach ($_SESSION["vocabs"] as $vocab) {

            $allMeanings=explode(", ",$vocab[2]);
            $allMeaningsCaps=array();

            $i=0;

            foreach ($allMeanings as $meaning) { //wird kapitalisiert
                $allMeaningsCaps[$i]=ucfirst(strtolower($meaning));
                ++$i;
            }

            $vocab[2]=implode(", ", $allMeaningsCaps);

            $exists = $dbank->query("SELECT vId FROM vocabs WHERE vocab = '" . ucfirst(strtolower($vocab[1])) . "'");

            if($exists->num_rows == 0) {
                $sqlAdd='INSERT INTO `vocabs`(`lang`, `vocab`, `transl`, `niveau`) VALUES ("'.$vocab[0].'","'.ucfirst(strtolower($vocab[1])).'","'.$vocab[2].'", "'.$vocab[3].'")';
                $dbank->query($sqlAdd);
            }         
            
            else {
                
            }
        }        

        $dbank = null; //Verbindung schließen

        echo "Vielen Dank für Ihren Beitrag.";
        unset($_SESSION["vocabs"]);
        unset($_SESSION["defaultLang"]);
        unset($_SESSION["defaultNiveau"]);
        ?>   
        
        
    </body>
</html>
