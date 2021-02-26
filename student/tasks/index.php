<?php
	global $position;
	$position = 2;
	include("./../header.php");
?>
	<table width="100%">
		<tr>
			<td width="5%"></td>
			<td width="45%" align="left"><a name="last" href="index.php?direction=last">letze Woche</a></td>
			<td width="45%" align="right"><a name="next" href="index.php?direction=next">n&auml;chste Woche</a></td>
			<td width="5%"></td>
		</tr>
	</table>

	<div class="table">
		<center>
			<table border="1" width="100%" heigth="100%">
				<tr heigth="10%">
					<td align="center" width="0%">Uhrzeit</td>
					<td align="center" width="13%">Montag</td>
					<td align="center" width="13%">Dienstag</td>
					<td align="center" width="13%">Mittwoch</td>
					<td align="center" width="13%">Donnerstag</td>
					<td align="center" width="13%">Freitag</td>
					<td align="center" width="13%">Samstag</td>
					<td align="center" width="13%">Sonntag</td>
				</tr><?php

				for($i = 0; $i < 24; $i++) {
					echo "\n\t\t\t\t<tr>";
					echo "\n\t\t\t\t\t<td align=\"center\">" . $i . ":00 Uhr</td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t\t<td></td>";
					echo "\n\t\t\t\t</tr>\n";
				}
			?><table>
		</center>
	</div>
<?php
	include("./../footer.php");
?>