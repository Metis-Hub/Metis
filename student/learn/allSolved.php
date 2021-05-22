<?php
    global $position;
    $position = 4;
    include "../header.inc.php";
?> 
    <h1>Herzlichen Glückwunsch!</h1>       
    Du hast alle Vokabeln richtig gewusst!
    <p>
    <form action="index.php">
        <input type="submit" value='Zurück zu "Lernen" gehen'>
    </form>
<?php
    include "../footer.inc.php";
?>