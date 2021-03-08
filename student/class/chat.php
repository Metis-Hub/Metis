<?php
	global $position;
	global $position2;
	$position = 3;
	$position2 = 1;
	include("./../header.php");
	include("./header2.php");
?>
	<div name="chat">
		<table>
		<?php
			$req = mysqli_query($con, "SELECT * FROM" . $table);
			while($row = mysqli_fetch_array($req, MYSQLI_ASSOC)) {
				echo "\n\t\t\t<tr>\n";
				echo "\t\t\t\t<th width=\"10%\" valign=\"top\">" . $row["name"] . "</th>\n";
				echo "\t\t\t\t<td width=\"90%\" align=\"left\">" . $row["message"] ."</td>\n";
				echo "\t\t\t</tr>\n";
			}
		?>
		</table>
	</div>
	<div id="msg">
		<form action="chat.php" method="post">
			<table border="0" width="100%">
				<tr style="heigth:10%">
					<td width="1%"></td>
					<th width="8%" valign="top">Nachricht:&nbsp;</th>
					<td width="80%" rowspan="2">
						<textarea type="text" name="msg" style="width:100%;resize:none;" rows="5" value=""></textarea>
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
	include("./../footer.php");
?>