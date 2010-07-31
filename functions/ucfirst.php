<?php
/**
 * UTF-8 aware alternative to ucfirst.
 *
 * Make a string's first character uppercase
 *
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/ucfirst
 * @uses utf8_strtoupper
 * @param string $str
 * @return string A string with the first character in Uppercase (if applicable).
 */
function utf8_ucfirst($str)
{
	switch( utf8_strlen($str) )
	{
		case 0:
			return '';
			break;
		case 1:
			return utf8_strtoupper($str);
			break;
		default:
			preg_match('/^(.{1})(.*)$/us', $str, $matches);
			return utf8_strtoupper($matches[1]).$matches[2];
			break;
	}
}
