<?php

/**
 * UTF-8 aware alternative to wordwrap.
 *
 * Wraps a string to a given number of characters
 *
 * @see http://www.php.net/manual/en/function.wordwrap.php
 * @param string $str the input string
 * @param int $width the column width
 * @param string $break the line is broken using the optional break parameter
 * @param bool $cut if the cut is set to TRUE, the string is always wrapped at
 * or before the specified width. So if you have a word that is larger than the
 * given width, it is broken apart.
 * @return string the given string wrapped at the specified column
 * @package php-utf8
 * @subpackage functions
 */
function utf8_wordwrap($str, $width = 75, $break = "\n", $cut = false)
{
	$regexp = '%^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}'.($cut ? '%' : '\b%U');
	$wrapped_str = '';

	while (preg_match($regexp, $str, $matches) === 1)
	{
		// Append it to the output, followed by a linebreak
		$wrapped_str .= $matches[0].$break;
		// Trim it off the input ready for the next go
		$str = substr($str, strlen($matches[0]));
	}

	// Add the final part on the end
	$wrapped_str .= $str;

	return $wrapped_str;
}
