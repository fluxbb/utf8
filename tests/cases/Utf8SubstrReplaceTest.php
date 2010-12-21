<?php

require_once UTF8.'/functions/substr_replace.php';


class Utf8SubstrReplaceTest extends TestLibTestCase
{
	protected $name = 'utf8_substr_replace()';

	protected function test_replace_start()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'IñtërnâtX';
		$this->is_equal(utf8_substr_replace($str, 'X', 8), $replaced);
	}

	protected function test_empty_string()
	{
		$str = '';
		$replaced = 'X';
		$this->is_equal(utf8_substr_replace($str, 'X', 8), $replaced);
	}

	protected function test_negative()
	{
		$str = 'testing';
		$replaced = substr_replace($str, 'foo', -2, -2);
		$this->is_equal(utf8_substr_replace($str, 'foo', -2, -2), $replaced);
	}

	protected function test_zero()
	{
		$str = 'testing';
		$replaced = substr_replace($str, 'foo', 0, 0);
		$this->is_equal(utf8_substr_replace($str, 'foo', 0, 0), $replaced);
	}

	protected function test_linefeed()
	{
		$str = "Iñ\ntërnâtiônàlizætiøn";
		$replaced = "Iñ\ntërnâtX";
		$this->is_equal(utf8_substr_replace($str, 'X', 9), $replaced);
	}

	protected function test_linefeed_replace()
	{
		$str = "Iñ\ntërnâtiônàlizætiøn";
		$replaced = "Iñ\ntërnâtX\nY";
		$this->is_equal(utf8_substr_replace($str, "X\nY", 9), $replaced);
	}
}
