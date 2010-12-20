<?php


class Utf8AccentsToAsciiTest extends TestLibTestCase
{
	function test_empty_str()
	{
		$this->is_equal(utf8_accents_to_ascii(''), '');
	}

	function test_lowercase()
	{
		$str = 'ô';
		$this->is_equal(utf8_accents_to_ascii($str, 'lower'), 'o');
	}

	function test_uppercase()
	{
		$str = 'Ô';
		$this->is_equal(utf8_accents_to_ascii($str, 'upper'), 'O');
	}

	function test_both()
	{
		$str = 'ôÔ';
		$this->is_equal(utf8_accents_to_ascii($str, 'both'), 'oO');
	}
}
