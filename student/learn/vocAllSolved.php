<?php
    global $position;
    $position = 4;
    include "../header.php";
    
    echo '
	<header>
		<nav>
			<div><a href="vocRequestDefault.php" class="active">Vokabeltrainer</a></div>
			<div><a href="quizSearch.php">Quizze</a></div>
			<div><a href="trainCalc.php">Kopfrechnen</a></div>
		</nav>
	</header>';
?> 
    <h1>Herzlichen Glückwunsch!</h1>       
    Du hast alle Vokabeln richtig gewusst!
    <p>
    <form action="index.php">
        <input type="submit" value='Zurück zu "Lernen" gehen'>
    </form>
<?php
    include "../footer.php";
?>