<?php

require_once UTF8.'/utils/validation.php';


class Utf8CompliantTest extends TestLibTestCase
{
	protected $name = 'utf8_compliant()';

	protected function test_valid_utf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_true(utf8_compliant($str));
	}

	protected function test_valid_utf8_ascii()
	{
		$str = 'ABC 123';
		$this->is_true(utf8_compliant($str));
	}

	protected function test_invalid_utf8()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_invalid_utf8_ascii()
	{
		$str = "this is an invalid char '\xe9' here";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_empty_string()
	{
		$str = '';
		$this->is_true(utf8_compliant($str));
	}

	protected function test_valid_two_octet_id()
	{
		$str = "\xc3\xb1";
		$this->is_true(utf8_compliant($str));
	}

	protected function test_invalid_two_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_invalid_id_between_twoAnd_three()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_valid_three_octet_id()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->is_true(utf8_compliant($str));
	}

	protected function test_invalid_three_octet_sequence_second()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_invalid_three_octet_sequence_third()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_valid_four_octet_id()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->is_true(utf8_compliant($str));
	}

	protected function test_invalid_four_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_invalid_five_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}

	protected function test_invalid_six_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_compliant($str));
	}
}
