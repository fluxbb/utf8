<?php

require_once UTF8.'/functions/trim.php';


class Utf8RtrimTest extends TestLibTestCase
{
	protected $name = 'utf8_rtrim()';

	function test_trim()
	{
		$str = 'Iñtërnâtiônàlizætiø';
		$trimmed = 'Iñtërnâtiônàlizæti';
		$this->is_equal(utf8_rtrim($str, 'ø'), $trimmed);
	}

	function test_no_trim()
	{
		$str = 'Iñtërnâtiônàlizætiøn ';
		$trimmed = 'Iñtërnâtiônàlizætiøn ';
		$this->is_equal(utf8_rtrim($str, 'ø'), $trimmed);
	}

	function test_empty_string()
	{
		$str = '';
		$trimmed = '';
		$this->is_equal(utf8_rtrim($str), $trimmed);
	}

	function test_linefeed()
	{
		$str = "Iñtërnâtiônàlizætiø\nø";
		$trimmed = "Iñtërnâtiônàlizætiø\n";
		$this->is_equal(utf8_rtrim($str, 'ø'), $trimmed);
	}

	function test_linefeed_mask()
	{
		$str = "Iñtërnâtiônàlizætiø\nø";
		$trimmed = "Iñtërnâtiônàlizæti";
		$this->is_equal(utf8_rtrim($str, "ø\n"), $trimmed);
	}
}
