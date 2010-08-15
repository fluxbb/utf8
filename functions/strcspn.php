<?php

/**
 * UTF-8 aware alternative to strcspn.
 *
 * Find length of initial segment not matching mask.
 *
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/strcspn
 * @uses utf8_strlen
 * @uses utf8_substr
 * @param string
 * @return int
 */
function utf8_strcspn($str, $mask, $start = null, $length = null)
{
	if (empty($mask) || strlen($mask) == 0)
		return null;

	$mask = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $mask);

	if ($start !== null || $length !== null)
		$str = utf8_substr($str, $start, $length);

	preg_match('/^[^'.$mask.']+/u', $str, $matches);

	if (isset($matches[0]))
		return utf8_strlen($matches[0]);

	return 0;
}
