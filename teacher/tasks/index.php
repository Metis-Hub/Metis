<?php
	global $position;
	$position = 1;
	$position2 = 0;
	include("./../header.inc.php");
	include("header.inc.php");
?>
<center>
	<form method=GET>
		<input type=week name=week placeholder="bsp: 2021-W20">
		<input type=submit>
	</form>
	
<?php
	$week = !empty($_GET["week"])?date("W", strtotime($_GET["week"])): date("W");
	$year = !empty($_GET["week"])?date("Y", strtotime($_GET["week"])): date("Y");
	$dt = new DateTime;
	$mon = $dt -> setISODate($year, $week, 1) -> format("Y-m-d");
	$fri = $dt -> setISODate($year, $week, 5) -> format("Y-m-d");
	
	$stmt = $conn -> prepare(file_get_contents("allTasks.sql"));
	$stmt -> bind_param("iss", $_SESSION["user"]["id"], $mon, $fri);
	$stmt -> execute();
	$result = $stmt -> get_result();

	$prevDate = 0;
	while($row = $result -> fetch_assoc()) {
		if(!$prevDate == $row["toDate"]) {
			echo $prevDate!=0?"</table></fieldset>":"", "<fieldset> <legend>".date("d.m.Y. D", strtotime($row["toDate"]))."</legend> <table>";
		}
		echo "<tr> <td>", $row["subject"], "<td> <a target=\"_blank\" href=./viewTask.php?task=", $row["taskId"], "> ", $row["title"], "</a> </td></tr>";
		$prevDate = $row["toDate"];
	}
?>


</center>
<?php
	include("./../footer.inc.php");
?>