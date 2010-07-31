<?php
/**
 * UTF-8 aware alternative to strspn.
 *
 * Find length of initial segment matching mask.
 *
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/strspn
 * @uses utf8_strlen
 * @uses utf8_substr
 * @param string $str
 * @param string $mask
 * @param int $start
 * @param int $length
 * @return int
 */
function utf8_strspn($str, $mask, $start=null, $length=null)
{
	$mask = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $mask);

	if( $start !== null || $length !== null )
	{
		$str = utf8_substr($str, $start, $length);
	}

	preg_match('/^['.$mask.']+/u', $str, $matches);

	if( isset($matches[0]) )
	{
		return utf8_strlen($matches[0]);
	}

	return 0;
}
