<?php

/**
 * UTF-8 aware alternative to strcasecmp.
 *
 * A case insensivite string comparison
 *
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/strcasecmp
 * @uses utf8_strtolower
 * @param string $strX
 * @param string $strY
 * @return int
 */
function utf8_strcasecmp($str_x, $str_y)
{
	$str_x = utf8_strtolower($str_x);
	$str_y = utf8_strtolower($str_y);

	return strcmp($str_x, $str_y);
}

