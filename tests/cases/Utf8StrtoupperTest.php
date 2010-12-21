<?php

class Utf8StrtoupperTest extends TestLibTestCase
{
	protected $name = 'utf8_strtoupper()';

	function test_upper()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$upper = 'IÑTËRNÂTIÔNÀLIZÆTIØN';
		$this->is_equal(utf8_strtoupper($str), $upper);
	}

	function test_empty_string()
	{
		$str = '';
		$upper = '';
		$this->is_equal(utf8_strtoupper($str), $upper);
	}
}
