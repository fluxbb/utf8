<?php

class Utf8StrtolowerTest extends TestLibTestCase
{
	protected $name = 'utf8_strtolower()';

	protected function test_lower()
	{
		$str = 'IÑTËRNÂTIÔNÀLIZÆTIØN';
		$lower = 'iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strtolower($str), $lower);
	}

	protected function test_empty_string()
	{
		$str = '';
		$lower = '';
		$this->is_equal(utf8_strtolower($str), $lower);
	}
}
