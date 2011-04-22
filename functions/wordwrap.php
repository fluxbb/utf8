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
 * @return string the given string wrapped at the specified column
 * @package php-utf8
 * @subpackage functions
 */
function utf8_wordwrap($str, $width = 75, $break = "\n")
{
	$lines = array();

	while (!empty($str))
	{
		// We got a line with a break in it somewhere before the end
		if (preg_match('%^(.{1,'.$width.'})(?:\s|$)%', $str, $matches))
		{
			// Add this line to the output
			$lines[] = $matches[1];

			// Trim it off the input ready for the next go
			$str = substr($str, strlen($matches[0]));
		}
		// Just take the next $width characters
		else
		{
			$lines[] = substr($str, 0, $width);

			// Trim it off the input ready for the next go
			$str = substr($str, $width);
		}
	}

	return implode($break, $lines);
}
