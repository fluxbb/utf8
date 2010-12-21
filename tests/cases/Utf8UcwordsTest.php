<?php

class Utf8UcwordsTest extends TestLibTestCase
{
	protected $name = 'utf8_ucwords()';

	function test_ucword()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$ucwords = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ucwords($str), $ucwords);
	}

	function test_ucwords()
	{
		$str = 'iñt ërn âti ônà liz æti øn';
		$ucwords = 'Iñt Ërn Âti Ônà Liz Æti Øn';
		$this->is_equal(utf8_ucwords($str), $ucwords);
	}

	function test_ucwords_newline()
	{
		$str = "iñt ërn âti\n ônà liz æti  øn";
		$ucwords = "Iñt Ërn Âti\n Ônà Liz Æti  Øn";
		$this->is_equal(utf8_ucwords($str), $ucwords);
	}

	function test_empty_string()
	{
		$str = '';
		$ucwords = '';
		$this->is_equal(utf8_ucwords($str), $ucwords);
	}

	function test_one_char()
	{
		$str = 'ñ';
		$ucwords = 'Ñ';
		$this->is_equal(utf8_ucwords($str), $ucwords);
	}

	function test_linefeed()
	{
		$str = "iñt ërn âti\n ônà liz æti øn";
		$ucwords = "Iñt Ërn Âti\n Ônà Liz Æti Øn";
		$this->is_equal(utf8_ucwords($str), $ucwords);
	}
}
