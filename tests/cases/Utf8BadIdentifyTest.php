<?php

require_once UTF8.'/utils/bad.php';


class Utf8BadIdentifyTest extends TestLibTestCase
{
	function test_valid_utf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_false(utf8_bad_identify($str, $i));
		$this->is_null($i);
	}

	function test_valid_utf8_ascii()
	{
		$str = 'testing';
		$this->is_false(utf8_bad_identify($str, $i));
		$this->is_null($i);
	}

	function test_invalid_utf8()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 15);
	}

	function test_invalid_utf8_ascii()
	{
		$str = "this is an invalid char '\xe9' here";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 25);
	}

	function test_invalid_utf8_start()
	{
		$str = "\xe9Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 0);
	}

	function test_invalid_utf8_end()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe9";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 27);
	}

	function test_valid_two_octet_id()
	{
		$str = "abc\xc3\xb1";
		$this->is_false(utf8_bad_identify($str, $i));
		$this->is_null($i);
	}

	function test_invalid_two_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 28);
	}

	function test_invalid_id_between_two_and_three()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQID);
		$this->is_equal($i, 27);
	}

	function test_valid_three_octet_id()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->is_false(utf8_bad_identify($str, $i));
		$this->is_null($i);
	}

	function test_invalid_three_octet_sequence_second()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 27);
	}

	function test_invalid_three_octet_sequence_third()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 28);
	}

	function test_valid_four_octet_id()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->is_false(utf8_bad_identify($str, $i));
		$this->is_null($i);
	}

	function test_invalid_four_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->is_equal($i, 27);
	}

	function test_invalid_five_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_5OCTET);
		$this->is_equal($i, 27);
	}

	function test_invalid_six_octet_sequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->is_equal(utf8_bad_identify($str, $i),PHP_UTF8_BAD_6OCTET);
		$this->is_equal($i, 27);
	}
}
