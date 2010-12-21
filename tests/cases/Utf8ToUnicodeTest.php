<?php

require_once UTF8.'/utils/unicode.php';


class Utf8ToUnicodeTest extends TestLibTestCase
{
	protected $name = 'utf8_to_unicode()';

	function test_empty_string()
	{
		$this->is_equal(utf8_to_unicode(''), array());
	}

	function test_string()
	{
		$unicode = array();
		$unicode[0] = 73;
		$unicode[1] = 241;
		$unicode[2] = 116;
		$unicode[3] = 235;
		$unicode[4] = 114;
		$unicode[5] = 110;
		$unicode[6] = 226;
		$unicode[7] = 116;
		$unicode[8] = 105;
		$unicode[9] = 244;
		$unicode[10] = 110;
		$unicode[11] = 224;
		$unicode[12] = 108;
		$unicode[13] = 105;
		$unicode[14] = 122;
		$unicode[15] = 230;
		$unicode[16] = 116;
		$unicode[17] = 105;
		$unicode[18] = 248;
		$unicode[19] = 110;

		$this->is_equal(utf8_to_unicode('Iñtërnâtiônàlizætiøn'), $unicode);
	}
}
