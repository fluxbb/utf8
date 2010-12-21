<?php

require_once UTF8.'/functions/stristr.php';


class Utf8StristrTest extends TestLibTestCase
{
	protected $name = 'utf8_stristr()';

	protected function test_substr()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$search = 'NÂT';
		$this->is_equal(utf8_stristr($str, $search), 'nâtiônàlizætiøn');
	}

	protected function test_substr_no_match()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$search = 'foo';
		$this->is_false(utf8_stristr($str, $search));
	}

	protected function test_empty_search()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$search = '';
		$this->is_equal(utf8_stristr($str, $search), 'iñtërnâtiônàlizætiøn');
	}

	protected function test_empty_str()
	{
		$str = '';
		$search = 'NÂT';
		$this->is_false(utf8_stristr($str, $search));
	}

	protected function test_empty_both()
	{
		$str = '';
		$search = '';
		$this->is_equal(utf8_stristr($str, $search), '');
	}

	protected function test_linefeed_str()
	{
		$str = "iñt\nërnâtiônàlizætiøn";
		$search = 'NÂT';
		$this->is_equal(utf8_stristr($str, $search), 'nâtiônàlizætiøn');
	}

	protected function test_linefeed_both()
	{
		$str = "iñtërn\nâtiônàlizætiøn";
		$search = "N\nÂT";
		$this->is_equal(utf8_stristr($str, $search), "n\nâtiônàlizætiøn");
	}
}
