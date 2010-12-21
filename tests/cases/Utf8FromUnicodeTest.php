<?php

require_once UTF8.'/utils/unicode.php';


class Utf8FromUnicodeTest extends TestLibTestCase
{
	protected $name = 'utf8_from_unicode()';

	protected function test_empty_array()
	{
		$this->is_equal(utf8_from_unicode(array()), '');
	}

	protected function test_array()
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

		$this->is_equal(utf8_from_unicode($unicode), 'Iñtërnâtiônàlizætiøn');
	}
}
