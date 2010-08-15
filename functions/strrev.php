<?php

/**
 * UTF-8 aware alternative to strrev.
 *
 * Reverse a string.
 *
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/strrev
 * @param string $str UTF-8 encoded
 * @return string characters in string reverses
 */
function utf8_strrev($str)
{
	preg_match_all('/./us', $str, $ar);
	return implode(array_reverse($ar[0]));
}

