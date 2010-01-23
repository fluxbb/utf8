<?php

//
// http://sourceforge.net/tracker/?func=detail&aid=1804661&group_id=142846&atid=753845
//

/**
* Wordwrap for utf8 encoded strings
* @param string $str
* @param integer $len
* @param string $what
* @return string
* @author Milian Wolff <mail@milianw.de>
*/
function utf8_wordwrap($str, $width, $break=" ", $cut = false)
{
	if(!$cut)
		$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
	else
		$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';

	$str_len = utf8_strlen($str);

	$while_what = ceil($str_len / $width);
	$i = 1;
	$return = '';

	while ($i < $while_what)
	{
		if (!preg_match($regexp, $str, $matches))
			break;

		$string = $matches[0];
		$return .= $string.$break;
		$str = substr($str, strlen($string));

		++$i;
	}

	return $return.$str;
}
