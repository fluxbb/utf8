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
function utf8_strcasecmp($strX, $strY)
{
	$strX = utf8_strtolower($strX);
	$strY = utf8_strtolower($strY);

	return strcmp($strX, $strY);
}

