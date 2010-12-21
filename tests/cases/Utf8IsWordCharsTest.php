<?php

require_once UTF8.'/utils/unicode.php';
require_once UTF8.'/utils/specials.php';


class Utf8IsWordCharsTest extends TestLibTestCase
{
	protected $name = 'utf8_is_word_chars()';

	protected function test_empty_string()
	{
		$this->is_true(utf8_is_word_chars(''));
	}

	protected function test_all_word_chars()
	{
		$this->is_true(utf8_is_word_chars('HelloWorld'));
	}

	protected function test_specials()
	{
		$str = 'Hello '.
			chr(0xe0 | (0x2234 >> 12)).
			chr(0x80 | ((0x2234 >> 6) & 0x003f)).
			chr(0x80 | (0x2234 & 0x003f)).
			' World';

		$this->is_false(utf8_is_word_chars($str));
	}
}
