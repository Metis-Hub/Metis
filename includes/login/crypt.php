<?php
function decrypt($hash, $text) {
	$out = "";
	for($i = 0; $i < strlen($text); $i++) {
		$hash = $hash * 271 % 999999 + 1;
		$tmp = "";

		while($text[$i] != ';') {
			$tmp .= $text[$i];
			$i++;
		}

		$tmp = intval($tmp);
		if(($tmp ^ $hash) != 3141) $out .= chr($tmp ^ $hash);
	}
    return $out;
}
?>