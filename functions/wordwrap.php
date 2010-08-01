<?php
/**
 * Wordwrap for utf8 encoded strings.
 *
 * @package php-utf8
 * @subpackage functions
 * @uses utf8_strlen
 * @see http://www.php.net/manual/en/function.wordwrap.php#98724
 * @param string $str
 * @param int $width
 * @param string $break
 * @param bool $cut
 * @return string
 */
function utf8_wordwrap($str, $width = 75, $break = "\n")
{
	// Return short or empty strings untouched
	if( empty($str) || utf8_strlen($str, 'UTF-8') <= $width)
	{
		return $str;
	}
  
	$br_width  = utf8_strlen($break);
	$str_width = utf8_strlen($str);
	$return = '';
	$last_space = FALSE;
   
	for($i=0, $count=0; $i < $str_width; $i++, $count++)
	{
		// If we're at a break
		if (utf8_substr($str, $i, $br_width) == $break)
		{
			$count = 0;
			$return .= utf8_substr($str, $i, $br_width);
			$i += $br_width - 1;
			continue;
		}

		// Keep a track of the most recent possible break point
		if(utf8_substr($str, $i, 1) == " ")
		{
			$last_space = $i;
		}

		// It's time to wrap
		if ($count > $width)
		{
			$count = 0;
			// There are no spaces to break on!  Going to truncate :(
			if(!$last_space)
			{
				$return .= $break;
			}
			else
			{
				// Work out how far back the last space was
				$drop = $i - $last_space;

				// Cutting zero chars results in an empty string, so don't do that
				if($drop > 0)
				{
					$return = utf8_substr($return, 0, -$drop);
				}
			   
				// Add a break
				$return .= $break;

				// Update pointers
				$i = $last_space + ($br_width - 1);
				$last_space = false;
			}
		}

		// Add character from the input string to the output
		$return .= utf8_substr($str, $i, 1);
	}
	return $return;
}
