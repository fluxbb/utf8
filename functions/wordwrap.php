<?php
/**
 * Wordwrap for utf8 encoded strings.
 *
 * @author Milian Wolff <mail@milianw.de>
 * @package php-utf8
 * @subpackage functions
 * @uses utf8_strlen
 * @param string $str
 * @param int $width
 * @param string $break
 * @param bool $cut
 * @return string
 */
function utf8_wordwrap($str, $width, $break=" ", $cut = false)
{
	$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';

	if( !$cut )
	{
		$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
	}


	$str_len = utf8_strlen($str);

	$while_what = ceil($str_len / $width);
	$i = 1;
	$return = '';

	while( $i < $while_what )
	{
		if( !preg_match($regexp, $str, $matches) )
		{
			break;
		}

		$string = $matches[0];
		$return .= $string.$break;
		$str = substr($str, strlen($string));

		++$i;
	}

	return $return.$str;
}
