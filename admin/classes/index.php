<?php
$position = 2;
include "../header.php";
include "../../includes/DbAccess.php";
?>
		<h1> Klassen </h1>
		<div class="left">
			<form method="GET">
				<?php
					echo '<input type = "text" name = "class" placeholder="Klassenname" '.(!empty($_GET["class"]) ? ("value=".$_GET["class"]) :  "").'>';
				?>
				<input type=submit name=search value="Suchen">
				<input type=submit name=newClass value="Neue Klasse">
			<?php
			##### Suchsystem #####
			if(isset($_GET["search"]) ||!empty($_GET["select"])) {
				echo "<table><tr> <th>ID</th> <th>Klassenname</th></tr>";
				$result;
				if(!empty($_GET["class"])) {
					$class = $_GET["class"];
					$stmt = $conn -> prepare("SELECT classId, className FROM grade WHERE className LIKE ?");
					$stmt -> bind_param("s", $class);
					$stmt -> execute();
					$result = $stmt -> get_result();
				} else {
					$result = $conn -> query("SELECT classId, className FROM grade");
				}

				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td> <input type=submit name=select value=".$row["classId"]."></td>";
					echo "<td>".$row["className"]."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}


			?>
			</form>
		</div>
		
		<?php
		##### Erweiterte Eingaben #####
		### Klasseninformation ###
		if(isset($_GET["select"])) {
			echo "<div class=\"right\">";
			echo "<h1> Klasse ... </h1>";
			$class = $_GET["select"];
			$stmt = $conn -> prepare("SELECT classId, className FROM grade WHERE classId = ?");
			if(!$stmt) {
				echo "SQL error";
				exit();
			}
			$stmt -> bind_param("i", $_GET["select"]);
			echo "</div>";

		### Neue Klasse ###
		}elseif(isset($_GET["newClass"])){
			$success = false;
			echo "<div class=\"right\">";
			if (isset($_POST["createClass"])) {
				if(!empty($_POST["className"])) {
					$sql = "INSERT INTO grade (className) VALUES (?)";
					$stmt = $conn -> prepare($sql);
					$stmt -> bind_param("s", $_POST["className"]);
					$stmt -> execute();
					$success = true;
					header("Location: ./?select=".mysqli_insert_id($conn));
				} else {
					#TODO
					echo "Empty Fields";
				}
			}
			if(!$success) {
				echo "<h1> Neue Klasse </h1>";
				echo "<form method=POST> <input type=text name=className placeholder = 'Klassenname'> <input type=submit name=createClass> </form>";
			}
			echo "</div>";
		}
		?>
<?php
include "../footer.php";
?>