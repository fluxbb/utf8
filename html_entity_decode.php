<?php

//
// http://sourceforge.net/tracker/?func=detail&aid=1783133&group_id=142846&atid=753845
//

function utf8_html_entity_decode($string)
{
	static $trans_tbl;

	// Replace numeric entities
	$string = preg_replace('~&#x([0-9a-f]+);~ei', 'code2utf(hexdec("\\1"))', $string);
	$string = preg_replace('~&#([0-9]+);~e', 'code2utf(\\1)', $string);

	// Replace literal entities
	if (!isset($trans_tbl))
	{
		$trans_tbl = array();

		foreach (get_html_translation_table(HTML_ENTITIES) as $val=>$key)
			$trans_tbl[$key] = utf8_encode($val);
	}

	return strtr($string, $trans_tbl);
}

// Returns the utf string corresponding to the unicode value (from php.net, courtesy - romans@void.lv)
function code2utf($number)
{
	if ($number < 0) return false;
	if ($number < 128) return chr($number);

	// Removing / Replacing Windows Illegals Characters
	if ($number < 160)
	{
		if ($number==128)     $number=8364;
		elseif ($number==129) $number=160; // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
		elseif ($number==130) $number=8218;
		elseif ($number==131) $number=402;
		elseif ($number==132) $number=8222;
		elseif ($number==133) $number=8230;
		elseif ($number==134) $number=8224;
		elseif ($number==135) $number=8225;
		elseif ($number==136) $number=710;
		elseif ($number==137) $number=8240;
		elseif ($number==138) $number=352;
		elseif ($number==139) $number=8249;
		elseif ($number==140) $number=338;
		elseif ($number==141) $number=160; // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
		elseif ($number==142) $number=381;
		elseif ($number==143) $number=160; // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
		elseif ($number==144) $number=160; // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
		elseif ($number==145) $number=8216;
		elseif ($number==146) $number=8217;
		elseif ($number==147) $number=8220;
		elseif ($number==148) $number=8221;
		elseif ($number==149) $number=8226;
		elseif ($number==150) $number=8211;
		elseif ($number==151) $number=8212;
		elseif ($number==152) $number=732;
		elseif ($number==153) $number=8482;
		elseif ($number==154) $number=353;
		elseif ($number==155) $number=8250;
		elseif ($number==156) $number=339;
		elseif ($number==157) $number=160; // (Rayo:) #129 using no relevant sign, thus, mapped to the saved-space #160
		elseif ($number==158) $number=382;
		elseif ($number==159) $number=376;
	}

	if ($number < 2048)
		return chr(($number >> 6) + 192).chr(($number & 63) + 128);

	if ($number < 65536)
		return chr(($number >> 12) + 224).chr((($number >> 6) & 63) + 128).chr(($number & 63) + 128);

	if ($number < 2097152)
		return chr(($number >> 18) + 240).chr((($number >> 12) & 63) + 128).chr((($number >> 6) & 63) + 128).chr(($number & 63) + 128);

	return false;
}
