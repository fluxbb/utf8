<?php

//
// http://sourceforge.net/tracker/?func=detail&aid=1804663&group_id=142846&atid=753845
//

function utf8_sprintf($format)
{
	$argv = func_get_args();
	array_shift($argv);
	return utf8_vprintf($format, $argv);
}

function utf8_vprintf($format, $arguments)
{
	if (mb_internal_encoding() != 'UTF-8')
		return vsprintf($format, $arguments);

	$newargv = array();

	preg_match_all("`\%('.+|[0 ]|)([1-9][0-9]*|)s`U", $format, $results, PREG_SET_ORDER);

	if (count($results))
	{
		foreach($results as $result)
		{
			list($string_format, $filler, $size) = $result;
			if(strlen($filler) > 1) $filler = substr($filler, 1);
			while(count($arguments) && !is_string($arg = array_shift($arguments)))
			$newargv[] = $arg;
			$pos = strpos($format, $string_format);

			$format = substr($format, 0, $pos)
			.($size ? str_repeat($filler, $size-strlen($arg)) : '')
			.str_replace('%', '%%', $arg)
			.substr($format, $pos+strlen($string_format));
		}

		if (!count($newargv))
			return $format;
		else
			return vsprintf($format, $newargv);
	}
	else
		return vsprintf($format, $arguments);
}
