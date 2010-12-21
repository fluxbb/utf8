<?php

require_once UTF8.'/functions/trim.php';


class Utf8LtrimTest extends TestLibTestCase
{
	protected $name = 'utf8_ltrim()';

	protected function test_trim()
	{
		$str = 'ñtërnâtiônàlizætiøn';
		$trimmed = 'tërnâtiônàlizætiøn';
		$this->is_equal(utf8_ltrim($str, 'ñ'), $trimmed);
	}

	protected function test_no_trim()
	{
		$str = ' Iñtërnâtiônàlizætiøn';
		$trimmed = ' Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ltrim($str, 'ñ'), $trimmed);
	}

	protected function test_empty_string()
	{
		$str = '';
		$trimmed = '';
		$this->is_equal(utf8_ltrim($str), $trimmed);
	}

	protected function test_forward_slash()
	{
		$str = '/Iñtërnâtiônàlizætiøn';
		$trimmed = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ltrim($str, '/'), $trimmed);
	}

	protected function test_negate_char_class()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$trimmed = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ltrim($str, '^s'), $trimmed);
	}

	protected function test_linefeed()
	{
		$str = "ñ\nñtërnâtiônàlizætiøn";
		$trimmed = "\nñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_ltrim($str, 'ñ'), $trimmed);
	}

	protected function test_linefeed_mask()
	{
		$str = "ñ\nñtërnâtiônàlizætiøn";
		$trimmed = "tërnâtiônàlizætiøn";
		$this->is_equal(utf8_ltrim($str, "ñ\n"), $trimmed);
	}
}
