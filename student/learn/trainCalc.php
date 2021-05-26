<?php
    global $position;
    $position = 4;
    include "../header.inc.php";

    echo '
	<header>
		<nav>
			<div><a href="vocRequestDefault.php">Vokabeltrainer</a></div>
			<div><a href="quizSearch.php">Quizze</a></div>
			<div><a href="trainCalc.php" class="active">Kopfrechnen</a></div>
		</nav>
	</header>';
?>

    <script>
    //generiert Variablen, die festhalten, ob checkboxes gecheckt sind
    var addChecked=false;
    var subChecked=false;
    var multiChecked=false;
    var diviChecked=false;
    var squareChecked=false;
    var excludeNegativesChecked=true;
    var taskCountScript=0;
    var solutions=new Array(); //alle Lösungen
    var tasks=new Array(); //alle Aufgaben
    var rightCount=0; //Zahl der richtig beantworteten Aufgaben
    var taskStart=0; //Zeit beim Anfang der Bearbeitung

    //Funktionen
    function checkCheckbox(checkbox) {
        //Speichert die ausgewählten Checkboxen
        if (checkbox=="add") {
            addChecked=!addChecked;        
        }
        else if (checkbox=="sub") {
            subChecked=!subChecked;
        }
        else if (checkbox=="multi") {
            multiChecked=!multiChecked;
        }
        else if (checkbox=="divi") {
            diviChecked=!diviChecked;
        } 

        else if (checkbox=="square") {
            squareChecked=!squareChecked;
        }         

        else if (checkbox=="excludeNegatives") {
            excludeNegativesChecked=!excludeNegativesChecked;
        }   
    }

    function createTasks(taskCount, minNumber, maxNumber) {
        if (addChecked==false && subChecked==false && multiChecked==false && diviChecked==false && squareChecked==false || taskCount=="" || minNumber=="" || maxNumber=="") {
            alert("Bitte vervollsändige deine Eingabe.");
        }

        else if (taskCount<=0 || taskCount > 1000) {        
            alert("Die Zahl der Aufgaben muss mindestens 1 und darf höchstens 1000 betragen.");
        } 

        else if (taskCount % 1!=0) {        
            alert("Die Zahl der Aufgaben muss eine ganze Zahl sein.");
        } 
        
        else {
            settings.innerHTML = ""; //der Inhalt der Seite wird gelöscht

            //Schreiben aller ausgewählten Rechenarten in einen array zur einfacheren Verarbeitung
            taskCountScript=taskCount; //die übergebene Variable muss für den Rest des Scripts gespeichert werden
            var calcTypes= new Array();
            var calcTypesIndex=0;

            if (addChecked==true) {
                calcTypes[calcTypesIndex]="add";
                calcTypesIndex++;
            }
            if (subChecked==true) {
                calcTypes[calcTypesIndex]="sub";
                calcTypesIndex++;
            }
            if (multiChecked==true) {
                calcTypes[calcTypesIndex]="multi";
                calcTypesIndex++;
            }
            if (diviChecked==true) {
                calcTypes[calcTypesIndex]="divi";
                calcTypesIndex++;
            }
            if (squareChecked==true) {
                calcTypes[calcTypesIndex]="square";
                calcTypesIndex++;
            }
            
            //Erstellen der Aufgaben
            var i=0; //Zähler

            while (i<taskCount) { //ist eine while- und keine for-schleife um das Exkludieren negativer Zahlen zu ermöglichen
                //Ermitteln der Faktoren
                var factor1=Math.round(Math.random() * (maxNumber-minNumber)) + 1*minNumber;
                var factor2=Math.round(Math.random() * (maxNumber-minNumber)) + 1*minNumber;
                
                //Ermittelnd er Rechenart
                
                var calcTypesCount=calcTypes.length;
                var calcTypesRandIndex=Math.floor(Math.random()*calcTypesCount);
                var calcTypeUsed=calcTypes[calcTypesRandIndex];

                if (calcTypeUsed=="add") {
                    var solution=factor1+factor2;
                    var task=factor1+" + "+factor2+" = ";
                }
                if (calcTypeUsed=="sub") {
                    var solution=factor1-factor2;
                    var task=factor1+" - "+factor2+" = ";
                }
                if (calcTypeUsed=="multi") {
                    var solution=factor1*factor2;
                    var task=factor1+" * "+factor2+" = ";
                }
                if (calcTypeUsed=="divi") {
                    var solution=factor1/factor2;
                    var task=factor1+" / "+factor2+" = ";
                }
                if (calcTypeUsed=="square") {
                    var solution=factor1*factor1;
                    var task=factor1+"² = ";
                }        
            
            //überprüft, ob die Lösung negativ sein muss / ist
            if (excludeNegativesChecked == true) {
                if (solution >= 0) {
                    tasksBody.innerHTML += task+'<form name="tasks"><input type="number" name="studentSol'+i+'" id="studentSol'+i+'"/></form>';
                    solutions.push(solution);
                    tasks.push(task);
                    i++;
                }
            }

            else {
                    tasksBody.innerHTML += task+'<form name="tasks"><input type="number" name="studentSol'+i+'" id="studentSol'+i+'"/></form>';
                    solutions.push(solution);
                    tasks.push(task);
                    i++;
            }
            }

            tasksBody.innerHTML += '<br/><br/><form name="checkSolutions"><input type="button" name="checkSolutions" value="Antworten überprüfen" onclick="checkSols()"></form>';

            taskStart = performance.now();

        

        }
    }

//überprüft die Antworten des Schülers
    function checkSols() {
        var taskEnd = performance.now();

        for (var i=0;i<taskCountScript;i++) { 

            if (document.getElementById("studentSol"+i).value=="") { //keine Antwort
                sols.innerHTML += tasks[i]+'<p style="color:red; display:inline;">Keine Antwort</p><p style="color:green; display:inline;"> '+solutions[i]+"</p><br>";
            }

            else if (document.getElementById("studentSol"+i).value==solutions[i]) { //Richtig
                sols.innerHTML += tasks[i]+'<p style="color:green; display:inline;">'+document.getElementById("studentSol"+i).value+"</p><br>";
                rightCount++;
            }  

            else { //falsch
                sols.innerHTML += tasks[i]+'<p style="color:red; display:inline;"><s>'+document.getElementById("studentSol"+i).value+'</s></p> <p style="color:green; display:inline;">'+solutions[i]+"</p><br>";
            }
        }

        workTime=Math.round((taskEnd-taskStart)/1000);

        sols.innerHTML += '<h1>Herzlichen Glückwunsch!</h1><p>Du hast '+rightCount+' von '+taskCountScript+' Aufgaben richtig beantwortet ('+Math.round((rightCount/taskCountScript)*100)+'%)!<br>';
        sols.innerHTML += 'Dafür hast du '+workTime+' Sekunden gebraucht (durchschnittlich '+Math.round((workTime/taskCountScript)*100)/100+' Sekunden pro Aufgabe).'; //rundet bei der Durchschnittszahl auf 2 Nachkommastellen

        tasksBody.innerHTML = "";
    }

    </script>
</head>

<body>
    <div id="settings">
        <form name="trainCalcSettings">
            Zahl der Fragen:
            <br/>
            <input type="number" name="taskCount" id="taskCount" min="1" max="1000" placeholder="Anzahl der Aufgaben">
            <br/><br/>
            Zu übende Rechenarten:
            <br/>
            <input type="checkbox" name="calcTypes" id="add" value="add" onClick="checkCheckbox('add')"> Addition
            <br/>
            <input type="checkbox" name="calcTypes" id="sub" value="sub" onClick="checkCheckbox('sub')"> Subtraktion
            <br/>
            <input type="checkbox" name="calcTypes" id="multi" value="multi" onClick="checkCheckbox('multi')"> Multiplikation
            <br/>
            <input type="checkbox" name="calcTypes" id="divi" value="divi" onClick="checkCheckbox('divi')"> Division
            <br>
            <input type="checkbox" name="calcTypes" id="square" value="square" onClick="checkCheckbox('square')"> Quadrate
            <br/><br/>
            Zahlenbereich:
            <br/>
            <input type="number" name="minNumber" id="minNumber" value="1"> bis <input type="number" name="maxNumber" id="maxNumber" value="10">
            <br/><br/>
            <input type="checkbox" name="exclude" id="excludeNegatives" value="excludeNegatives" onClick="checkCheckbox('excludeNegatives')" checked> Keine negativen Zahlen in der Lösung nutzen
            <br/><br/>
            <input type="button" name="trainCalcSettingsSubmit" onclick="createTasks(document.trainCalcSettings.taskCount.value, document.trainCalcSettings.minNumber.value, document.trainCalcSettings.maxNumber.value)" value="Bestätigen">
        </form>
    </div>
    <div id="tasksBody">
    </div>
    <div id="sols">
    </div>
</body>

<?php
    include "../footer.inc.php";
?>