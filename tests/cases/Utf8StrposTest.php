<?php

class Utf8StrposTest extends TestLibTestCase
{
	protected $name = 'utf8_strpos()';

	protected function test_utf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strpos($str, 'â'), 6);
	}

	protected function test_utf8_offset()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strpos($str, 'n', 11), 19);
	}

	protected function test_utf8_invalid()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->is_equal(utf8_strpos($str, 'æ'), 15);
	}

	protected function test_ascii()
	{
		$str = 'ABC 123';
		$this->is_equal(utf8_strpos($str, 'B'), 1);
	}

	protected function test_vs_strpos()
	{
		$str = 'ABC 123 ABC';
		$this->is_equal(utf8_strpos($str, 'B', 3), strpos($str, 'B', 3));
	}

	protected function test_empty_str()
	{
		$str = '';
		$this->is_false(utf8_strpos($str, 'x'));
	}
}
