<?php
/**
 * UTF-8 aware substr_replace.
 *
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/substr_replace
 * @uses utf8_strlen
 * @uses utf8_substr
 * @param string $str
 * @param string $repl
 * @param int $start
 * @param int $length
 * @return string
 */
function utf8_substr_replace($str, $repl, $start, $length=null)
{
	preg_match_all('/./us', $str, $ar);
	preg_match_all('/./us', $repl, $rar);

	if( $length === null )
	{
		$length = utf8_strlen($str);
	}

	array_splice($ar[0], $start, $length, $rar[0]);

	return implode($ar[0]);
}
