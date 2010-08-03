<?php
/**
 * UTF-8 aware replacements for the trim functions.
 *
 * Use these only if you are supplying the charlist optional arg and it contains
 * UTF-8 characters. Otherwise trim will work normally on a UTF-8 string.
 * 
 * @package php-utf8
 * @subpackage functions
 */

/**
 * UTF-8 aware replacement for ltrim().
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @see http://www.php.net/ltrim
 * @see http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
 * @param string $str
 * @param string $charlist
 * @return string
 */
function utf8_ltrim($str, $charlist = '')
{
	if( empty($charlist) )
	{
		return ltrim($str);
	}

	// Quote charlist for use in a characterclass
	$charlist = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $charlist);

	return preg_replace('/^['.$charlist.']+/u', '', $str);
}

/**
 * UTF-8 aware replacement for rtrim().
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @see http://www.php.net/rtrim
 * @see http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
 * @param string $str
 * @param string $charlist
 * @return string 
 */
function utf8_rtrim($str, $charlist= '')
{
	if( empty($charlist) )
	{
		return rtrim($str);
	}

	// Quote charlist for use in a characterclass
	$charlist = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $charlist);

	return preg_replace('/['.$charlist.']+$/u', '', $str);
}

/**
 * UTF-8 aware replacement for trim().
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @see http://www.php.net/trim
 * @see http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
 * @param string $str
 * @param boolean $charlist
 * @return string
 */
function utf8_trim($str, $charlist= '')
{
	if( $charlist === '' )
	{
		return trim($str);
	}

	return utf8_ltrim(utf8_rtrim($str, $charlist), $charlist);
}
