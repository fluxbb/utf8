<?php

class Utf8SubstrTest extends TestLibTestCase
{
	protected $name = 'utf8_substr()';

	function test_utf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0, 2), 'Iñ');
	}

	function test_utf8_two()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 2, 2), 'të');
	}

	function test_utf8_zero()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0), 'Iñtërnâtiônàlizætiøn');
	}

	function test_utf8_zero_zero()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0, 0), '');
	}

	function test_start_great_than_length()
	{
		$str = 'Iñt';
		$this->is_empty(utf8_substr($str, 4));
	}

	function test_compare_start_great_than_length()
	{
		$str = 'abc';
		$this->is_equal(utf8_substr($str, 4), substr($str, 4));
	}

	function test_length_beyond_string()
	{
		$str = 'Iñt';
		$this->is_equal(utf8_substr($str, 1, 5),'ñt');
	}

	function test_compare_length_beyond_string()
	{
		$str = 'abc';
		$this->is_equal(utf8_substr($str, 1, 5), substr($str, 1, 5));
	}

	function test_start_negative()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, -4), 'tiøn');
	}

	function test_length_negative()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 10, -2), 'nàlizæti');
	}

	function test_start_length_negative()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, -4, -2), 'ti');
	}

	function test_linefeed()
	{
		$str = "Iñ\ntërnâtiônàlizætiøn";
		$this->is_equal(utf8_substr($str, 1, 5), "ñ\ntër");
	}

	function test_long_length()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0, 15536), 'Iñtërnâtiônàlizætiøn');
	}
}
