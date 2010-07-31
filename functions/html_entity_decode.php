<?php
/**
 * UTF-8 aware alternative to html_entity_decode.
 * 
 * @package php-utf8
 * @subpackage functions
 * @staticvar <type> $trans_tbl
 * @param string $string
 * @return string
 */
function utf8_html_entity_decode($string)
{
	static $trans_tbl;

	// Replace numeric entities
	$string = preg_replace('~&#x([0-9a-f]+);~ei', 'code2utf(hexdec("\\1"))', $string);
	$string = preg_replace('~&#([0-9]+);~e', 'code2utf(\\1)', $string);

	// Replace literal entities
	if( !isset($trans_tbl) )
	{
		$trans_tbl = array( );

		foreach( get_html_translation_table(HTML_ENTITIES) as $val => $key )
		{
			$trans_tbl[$key] = utf8_encode($val);
		}
	}

	return strtr($string, $trans_tbl);
}

/**
 * Returns the utf string corresponding to the unicode value.
 *
 * @see http://www.php.net/manual/en/function.html-entity-decode.php#76408
 * @param integer $number
 * @return string
 */
function code2utf($number)
{
	if( $number < 0 )
	{
		return FALSE;
	}
	if( $number < 128 )
	{
		return chr($number);
	}

	// Removing / Replacing Windows Illegals Characters
	if( $number < 160 )
	{
		$ill_chars = array(
			128 => 8364,
			129 => 160, // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
			130 => 8218,
			131 => 402,
			132 => 8222,
			133 => 8230,
			134 => 8224,
			135 => 8225,
			136 => 710,
			137 => 8240,
			138 => 352,
			139 => 8249,
			140 => 338,
			141 => 160, // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
			142 => 381,
			143 => 160, // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
			144 => 160, // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
			145 => 8216,
			146 => 8217,
			147 => 8220,
			148 => 8221,
			149 => 8226,
			150 => 8211,
			151 => 8212,
			152 => 732,
			153 => 8482,
			154 => 353,
			155 => 8250,
			156 => 339,
			157 => 160, // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
			158 => 382,
			159 => 376,
		);
		if( array_key_exists($number, $ill_chars) )
		{
			$number = $illchars[$number];
		}
	}

	if( $number < 2048 )
	{
		return chr(($number >> 6) + 192).chr(($number & 63) + 128);
	}

	if( $number < 65536 )
	{
		return chr(($number >> 12) + 224).chr((($number >> 6) & 63) + 128).chr(($number & 63) + 128);
	}

	if( $number < 2097152 )
	{
		return chr(($number >> 18) + 240).chr((($number >> 12) & 63) + 128).chr((($number >> 6) & 63) + 128).chr(($number & 63) + 128);
	}

	return FALSE;
}
