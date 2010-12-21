<?php

require_once UTF8.'/utils/ascii.php';


class Utf8IsAsciiTest extends TestLibTestCase
{
	protected $name = 'utf8_is_ascii()';

	protected function test_utf8()
	{
		$str = 'testiñg';
		$this->is_false(utf8_is_ascii($str));
	}

	protected function test_ascii()
	{
		$str = 'testing';
		$this->is_true(utf8_is_ascii($str));
	}

	protected function test_invalid_char()
	{
		$str = "tes\xe9ting";
		$this->is_false(utf8_is_ascii($str));
	}

	protected function test_empty_str()
	{
		$str = '';
		$this->is_true(utf8_is_ascii($str));
	}
}
