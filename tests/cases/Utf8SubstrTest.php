<?php

class Utf8SubstrTest extends TestLibTestCase
{
	protected $name = 'utf8_substr()';

	protected function test_utf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0, 2), 'Iñ');
	}

	protected function test_utf8_two()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 2, 2), 'të');
	}

	protected function test_utf8_zero()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0), 'Iñtërnâtiônàlizætiøn');
	}

	protected function test_utf8_zero_zero()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0, 0), '');
	}

	protected function test_start_great_than_length()
	{
		$str = 'Iñt';
		$this->is_empty(utf8_substr($str, 4));
	}

	protected function test_compare_start_great_than_length()
	{
		$str = 'abc';
		$this->is_equal(utf8_substr($str, 4), substr($str, 4));
	}

	protected function test_length_beyond_string()
	{
		$str = 'Iñt';
		$this->is_equal(utf8_substr($str, 1, 5),'ñt');
	}

	protected function test_compare_length_beyond_string()
	{
		$str = 'abc';
		$this->is_equal(utf8_substr($str, 1, 5), substr($str, 1, 5));
	}

	protected function test_start_negative()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, -4), 'tiøn');
	}

	protected function test_length_negative()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 10, -2), 'nàlizæti');
	}

	protected function test_start_length_negative()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, -4, -2), 'ti');
	}

	protected function test_linefeed()
	{
		$str = "Iñ\ntërnâtiônàlizætiøn";
		$this->is_equal(utf8_substr($str, 1, 5), "ñ\ntër");
	}

	protected function test_long_length()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_substr($str, 0, 15536), 'Iñtërnâtiônàlizætiøn');
	}
}
