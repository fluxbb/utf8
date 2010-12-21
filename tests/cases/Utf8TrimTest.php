<?php

require_once UTF8.'/functions/trim.php';


class Utf8TrimTest extends TestLibTestCase
{
	protected $name = 'utf8_trim()';

	function test_trim()
	{
		$str = 'ñtërnâtiônàlizætiø';
		$trimmed = 'tërnâtiônàlizæti';
		$this->is_equal(utf8_trim($str, 'ñø'), $trimmed);
	}

	function test_no_trim()
	{
		$str = ' Iñtërnâtiônàlizætiøn ';
		$trimmed = ' Iñtërnâtiônàlizætiøn ';
		$this->is_equal(utf8_trim($str, 'ñø'), $trimmed);
	}

	function test_empty_string()
	{
		$str = '';
		$trimmed = '';
		$this->is_equal(utf8_trim($str), $trimmed);
	}
}
