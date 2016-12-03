<?php

namespace Services;

class Out
{
	private static $colors = [
		'white' => '1;37',
		'green' => '0;32',
		'red'   => '0;31',
	];

	public static function s($msg, $newLine = true, $color = 'white')
	{
		if (!isset(self::$colors[$color])) {
			$color = 'white';
		}
		echo "\033[" . self::$colors[$color] . "m";
		echo $msg;
		echo "\033[0m";
		if ($newLine) {
			echo "\n";
		}
	}

	public static function r($msg)
	{
		return self::s($msg, false, 'red');
	}

	public static function g($msg)
	{
		return self::s($msg, false, 'green');
	}
}

