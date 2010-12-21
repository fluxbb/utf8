<?php

require_once UTF8.'/utils/ascii.php';


class Utf8ToAsciiTest extends TestLibTestCase
{
	protected $name = 'utf8_to_ascii()';

	function test_utf8()
	{
		$str = 'testiñg';
		$this->is_equal(utf8_to_ascii($str), 'testig');
	}

	function test_ascii()
	{
		$str = 'testing';
		$this->is_equal(utf8_to_ascii($str), 'testing');
	}

	function test_invalid_char()
	{
		$str = "tes\xe9ting";
		$this->is_equal(utf8_to_ascii($str), 'testing');
	}

	function testE_empty_str()
	{
		$str = '';
		$this->is_equal(utf8_to_ascii($str), '');
	}

	function test_nul_and_non_7_bit()
	{
		$str = "a\x00ñ\x00c";
		$this->is_equal(utf8_to_ascii($str, 'both'), 'ac');
	}

	function test_nul()
	{
		$str = "a\x00b\x00c";
		$this->is_equal(utf8_to_ascii($str, 'ctrl_chars'), 'abc');
	}
}
