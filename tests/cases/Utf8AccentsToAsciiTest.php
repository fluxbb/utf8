<?php

require_once UTF8.'/utils/ascii.php';


class Utf8AccentsToAsciiTest extends TestLibTestCase
{
	protected $name = 'utf8_accents_to_ascii()';

	protected function test_empty_str()
	{
		$this->is_equal(utf8_accents_to_ascii(''), '');
	}

	protected function test_lowercase()
	{
		$str = 'ô';
		$this->is_equal(utf8_accents_to_ascii($str, 'lower'), 'o');
	}

	protected function test_uppercase()
	{
		$str = 'Ô';
		$this->is_equal(utf8_accents_to_ascii($str, 'upper'), 'O');
	}

	protected function test_both()
	{
		$str = 'ôÔ';
		$this->is_equal(utf8_accents_to_ascii($str, 'both'), 'oO');
	}
}
