<?php
    global $position;
    $position = 3;
    include "../header.inc.php";
?>
        <h1>Das Quiz wurde erfolgreich erstellt.</h1>
        Vielen Dank für Ihren Beitrag. Wenn Sie dieses Quiz mit Ihren Schülern teilen wollen, teilen Sie Ihnen bitte diese Quiz-Kennnummer mit: <?php echo $_GET["quizId"] ?>.
        <p>
        <form action="index.php">
            <input type="submit" value='Zurück zu "Lernen" gehen'>
        </form>
<?php
    include "../footer.inc.php";
?>