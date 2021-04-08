<?php
class Rand {

	private static $seed = 0;

	public static function SetSeed($seed) {
		self::$seed = $seed;
	}

	public static function Next() {
		self::$seed = self::$seed * 1103515245 + 12345;
		return((self::$seed / 65536) % 32768);
	}
}
?>