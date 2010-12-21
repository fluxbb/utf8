<?php

require_once UTF8.'/functions/str_ireplace.php';


class Utf8StrIreplaceTest extends TestLibTestCase
{
	protected $name = 'utf8_ireplace()';

	protected function test_replace()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'Iñtërnâtiônàlisetiøn';
		$this->is_equal(utf8_ireplace('lIzÆ', 'lise', $str), $replaced);
	}

	protected function test_replace_no_match()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ireplace('foo', 'bar', $str), $replaced);
	}

	protected function test_empty_string()
	{
		$str = '';
		$replaced = '';
		$this->is_equal(utf8_ireplace('foo', 'bar', $str), $replaced);
	}

	protected function test_empty_search()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_ireplace('', 'x', $str), $replaced);
	}

	protected function test_replace_count()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'IñtërXâtiôXàlizætiøn';
		$this->is_equal(utf8_ireplace('n', 'X', $str, 2), $replaced);
	}

	protected function test_replace_different_search_replace_length()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'IñtërXXXâtiôXXXàlizætiøXXX';
		$this->is_equal(utf8_ireplace('n', 'XXX', $str), $replaced);
	}

	protected function test_replace_array_ascii_search()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'Iñyërxâyiôxàlizæyiøx';
		$this->is_equal(utf8_ireplace(array('n', 't'), array('x', 'y'), $str), $replaced);
	}

	protected function test_replace_array_utf8_search()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'I?tërnâti??nàliz????ti???n';
		$this->is_equal(
			utf8_ireplace(
				array('Ñ', 'ô', 'ø', 'Æ'),
				array('?', '??', '???', '????'),
				$str),
			$replaced);
	}

	protected function test_replace_array_string_replace()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'I?tërnâti?nàliz?ti?n';
		$this->is_equal(
			utf8_ireplace(
				array('Ñ', 'ô', 'ø', 'Æ'),
				'?',
				$str),
			$replaced);
	}

	protected function test_replace_array_single_array_replace()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$replaced = 'I?tërnâtinàliztin';
		$this->is_equal(
			utf8_ireplace(
				array('Ñ', 'ô', 'ø', 'Æ'),
				array('?'),
				$str),
			$replaced);
	}

	protected function test_replace_linefeed()
	{
		$str = "Iñtërnâti\nônàlizætiøn";
		$replaced = "Iñtërnâti\nônàlisetiøn";
		$this->is_equal(utf8_ireplace('lIzÆ', 'lise', $str), $replaced);
	}

	protected function test_replace_linefeed_search()
	{
		$str = "Iñtërnâtiônàli\nzætiøn";
		$replaced = "Iñtërnâtiônàlisetiøn";
		$this->is_equal(utf8_ireplace("lI\nzÆ", 'lise', $str), $replaced);
	}
}
