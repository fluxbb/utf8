<?php

class Utf8StrrposTest extends TestLibTestCase
{
	protected $name = 'utf8_strrpos()';

	protected function test_utf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strrpos($str, 'i'), 17);
	}

	protected function test_utf8_offset()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strrpos($str, 'n', 11), 19);
	}

	protected function test_utf8_invalid()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->is_equal(utf8_strrpos($str, 'æ'), 15);
	}

	protected function test_ascii()
	{
		$str = 'ABC ABC';
		$this->is_equal(utf8_strrpos($str, 'B'), 5);
	}

	protected function test_vs_strpos()
	{
		$str = 'ABC 123 ABC';
		$this->is_equal(utf8_strrpos($str, 'B'), strrpos($str, 'B'));
	}

	protected function test_empty_str()
	{
		$str = '';
		$this->is_false(utf8_strrpos($str, 'x'));
	}

	protected function test_linefeed()
	{
		$str = "Iñtërnâtiônàlizætiø\nn";
		$this->is_equal(utf8_strrpos($str, 'i'), 17);
	}

	protected function test_linefeed_search()
	{
		$str = "Iñtërnâtiônàlizætiø\nn";
		$this->is_equal(utf8_strrpos($str, "\n"), 19);
	}
}
