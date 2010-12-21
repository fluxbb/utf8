<?php

require_once UTF8.'/functions/ucfirst.php';


class Utf8UcfirstTest extends TestLibTestCase
{
	protected $name = 'utf8_ucfirst()';

	protected function test_ucfirst()
	{
		$str = 'ñtërnâtiônàlizætiøn';
		$ucfirst = 'Ñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ucfirst($str), $ucfirst);
	}

	protected function test_ucfirst_space()
	{
		$str = ' iñtërnâtiônàlizætiøn';
		$ucfirst = ' iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ucfirst($str), $ucfirst);
	}

	protected function test_ucfirst_upper()
	{
		$str = 'Ñtërnâtiônàlizætiøn';
		$ucfirst = 'Ñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ucfirst($str), $ucfirst);
	}

	protected function test_empty_string()
	{
		$str = '';
		$this->is_equal(utf8_ucfirst($str), '');
	}

	protected function test_one_char()
	{
		$str = 'ñ';
		$ucfirst = "Ñ";
		$this->is_equal(utf8_ucfirst($str), $ucfirst);
	}

	protected function test_linefeed()
	{
		$str = "ñtërn\nâtiônàlizætiøn";
		$ucfirst = "Ñtërn\nâtiônàlizætiøn";
		$this->is_equal(utf8_ucfirst($str), $ucfirst);
	}
}
