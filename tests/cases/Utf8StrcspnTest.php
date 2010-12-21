<?php

require_once UTF8.'/functions/strcspn.php';


class Utf8StrcspnTest extends TestLibTestCase
{
	protected $name = 'utf8_strcspn()';

	protected function test_no_match_single_byte_search()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strcspn($str, 't'), 2);
	}

	protected function tes_no_match_multi_byte_search()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strcspn($str, 'â'), 6);
	}

	protected function test_compare_strspn()
	{
		$str = 'aeioustr';
		$this->is_equal(utf8_strcspn($str, 'tr'), strcspn($str, 'tr'));
	}

	protected function test_match_ascii()
	{
		$str = 'internationalization';
		$this->is_equal(utf8_strcspn($str, 'a'), strcspn($str, 'a'));
	}

	protected function test_linefeed()
	{
		$str = "i\nñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_strcspn($str, 't'), 3);
	}

	protected function test_linefeed_mask()
	{
		$str = "i\nñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_strcspn($str, "\n"), 1);
	}
}
