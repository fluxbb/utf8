<?php

require_once UTF8.'/utils/unicode.php';
require_once UTF8.'/utils/specials.php';


class Utf8StripSpecialsTest extends TestLibTestCase
{
	protected $name = 'utf8_strip_specials()';

	protected function test_empty_string()
	{
		$this->is_equal(utf8_strip_specials(''), '');
	}

	protected function test_strip()
	{
		$str = 'Hello '.
			chr(0xe0 | (0x2234 >> 12)).
			chr(0x80 | ((0x2234 >> 6) & 0x003f)).
			chr(0x80 | (0x2234 & 0x003f)).
			' World';

		$this->is_equal(utf8_strip_specials($str), 'HelloWorld');
	}
}
