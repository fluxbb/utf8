<?php

class Utf8StrtoupperTest extends TestLibTestCase
{
	protected $name = 'utf8_strtoupper()';

	protected function test_upper()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$upper = 'IÑTËRNÂTIÔNÀLIZÆTIØN';
		$this->is_equal(utf8_strtoupper($str), $upper);
	}

	protected function test_empty_string()
	{
		$str = '';
		$upper = '';
		$this->is_equal(utf8_strtoupper($str), $upper);
	}
}
