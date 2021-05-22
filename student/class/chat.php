<?php
	global $position;
	global $position2;
	$position = 3;
	$position2 = 1;
	include("./../header.inc.php");
	include("./header2.inc.php");
?>
	<!-- Inhalt Chat -->
	<div name="chat">
		<table>
		<?php
			//require_once("chat/config.php");
			include("./../../includes/DBAccess.php");
			//mysqli_select_db($conn, "message");
			//$req = mysqli_query($conn, "SELECT * FROM `message` JOIN `teacher` ON Not Isnull(`teacherId`) AND `teacherId` = `teacher`.`id`" .
			//						   " JOIN `student` ON Not Isnull(`studentId`) AND `studentId` = `student`.`id` ORDER BY `time`");
			$req = mysqli_query($conn, "SELECT `message`.*, CASE `isTeacher` = 1 THEN".
			" JOIN `teacher` ON `accountId` = `teacher`.`id` ELSE JOIN `student` ON `accountId` = `student`.`id`");


			$i = 0;

			// Durchlaufen der Nachrichten
			while($row = mysqli_fetch_array($req, MYSQLI_ASSOC)) {

				$name = (!empty($row["teacherId"])) ? $row["teacherId"] : ((!empty($row["studentId"])) ? $row["studentId"] : "");

				// Ausgabe der Nachricht
				echo "\n\t\t\t<tr>\n";
				echo "\t\t\t\t<th width=\"10%\" valign=\"top\">" . $name . "</th>\n";
				echo "\t\t\t\t<td width=\"90%\" align=\"left\">" . $row["message"] ."</td>\n";
				echo "\t\t\t</tr>\n";
				$i++;
			}

			// Wenn keine Nachrichten gesendet wurden
			if($i <= 0) {
				echo "\n\t\t\t<tr><td>Keine Nachrichten verf&uuml;gbar.</td></tr>\n";
			}

		?>
		</table>
	</div>

	<!-- Formular zum Nachrichten senden -->
	<div id="msg">
		<form action="chat.php" method="post">
			<table border="0" width="100%">
				<tr style="heigth:10%">
					<td width="1%"></td>
					<th width="8%" valign="top">Nachricht:&nbsp;</th>
					<td width="80%" rowspan="2">
						<textarea type="text" name="msg" style="width:100%;resize:none;" rows="5" maxlength="700" value=""></textarea>
					</td>
					<td width="1%"></td>
					<td width="9%" rowspan="2"><input type="submit" name="send_msg" style="height:5rem;width:100%;" value="Senden!"></input></td>
					<td width="1%"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</form>
	</div>

<?php
	include("./../footer.inc.php");
?>