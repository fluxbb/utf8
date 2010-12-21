<?php

require_once UTF8.'/functions/strcasecmp.php';


class Utf8StrcasecmpTest extends TestLibTestCase
{
	protected $name = 'utf8_strcasecmp()';

	function test_compare_equal()
	{
		$str_x = 'iñtërnâtiônàlizætiøn';
		$str_y = 'IÑTËRNÂTIÔNÀLIZÆTIØN';
		$this->is_equal(utf8_strcasecmp($str_x, $str_y),0);
	}

	function test_less()
	{
		$str_x = 'iñtërnâtiônàlizætiøn';
		$str_y = 'IÑTËRNÂTIÔÀLIZÆTIØN';
		$this->is_true(utf8_strcasecmp($str_x, $str_y) < 0);
	}

	function test_greater()
	{
		$str_x = 'iñtërnâtiôàlizætiøn';
		$str_y = 'IÑTËRNÂTIÔNÀLIZÆTIØN';
		$this->is_true(utf8_strcasecmp($str_x, $str_y) > 0);
	}

	function test_empty_x()
	{
		$str_x = '';
		$str_y = 'IÑTËRNÂTIÔNÀLIZÆTIØN';
		$this->is_true(utf8_strcasecmp($str_x, $str_y) < 0);
	}

	function test_empty_y()
	{
		$str_x = 'iñtërnâtiôàlizætiøn';
		$str_y = '';
		$this->is_true(utf8_strcasecmp($str_x, $str_y) > 0);
	}

	function test_empty_both()
	{
		$str_x = '';
		$str_y = '';
		$this->is_true(utf8_strcasecmp($str_x, $str_y) == 0);
	}

	function test_linefeed()
	{
		$str_x = "iñtërnâtiôn\nàlizætiøn";
		$str_y = "IÑTËRNÂTIÔN\nÀLIZÆTIØN";
		$this->is_true(utf8_strcasecmp($str_x, $str_y) == 0);
	}

}
