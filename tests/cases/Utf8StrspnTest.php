<?php

require_once UTF8.'/functions/strspn.php';


class Utf8StrspnTest extends TestLibTestCase
{
	protected $name = 'utf8_strspn()';

	protected function test_match()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strspn($str, 'âëiônñrt'), 11);
	}

	protected function test_match_two()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strspn($str, 'iñtë'), 4);
	}

	protected function test_compare_strspn()
	{
		$str = 'aeioustr';
		$this->is_equal(utf8_strspn($str, 'saeiou'), strspn($str, 'saeiou'));
	}

	protected function test_match_ascii()
	{
		$str = 'internationalization';
		$this->is_equal(utf8_strspn($str, 'aeionrt'), strspn($str, 'aeionrt'));
	}

	protected function test_linefeed()
	{
		$str = "iñtërnât\niônàlizætiøn";
		$this->is_equal(utf8_strspn($str, 'âëiônñrt'), 8);
	}

	protected function test_linefeed_mask()
	{
		$str = "iñtërnât\niônàlizætiøn";
		$this->is_equal(utf8_strspn($str, "âëiônñrt\n"), 12);
	}
}
