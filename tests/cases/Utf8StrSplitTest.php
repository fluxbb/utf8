<?php

require_once UTF8.'/functions/str_split.php';


class Utf8StrSplitTest extends TestLibTestCase
{
	protected $name = 'utf8_str_split()';

	function test_split_one_char()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$array = array(
			'I','ñ','t','ë','r','n','â','t','i','ô','n','à','l','i',
			'z','æ','t','i','ø','n',
			);

		$this->is_equal(utf8_str_split($str), $array);
	}

	function test_split_five_chars()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$array = array(
			'Iñtër','nâtiô','nàliz','ætiøn',
			);

		$this->is_equal(utf8_str_split($str, 5), $array);
	}

	function test_split_six_chars()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$array = array(
			'Iñtërn','âtiônà', 'lizæti','øn',
			);

		$this->is_equal(utf8_str_split($str, 6), $array);
	}

	function test_split_long()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$array = array(
			'Iñtërnâtiônàlizætiøn',
			);

		$this->is_equal(utf8_str_split($str, 40), $array);
	}

	function test_split_newline()
	{
		$str = "Iñtërn\nâtiônàl\nizætiøn\n";
		$array = array(
			'I','ñ','t','ë','r','n',"\n",'â','t','i','ô','n','à','l',"\n",'i',
			'z','æ','t','i','ø','n',"\n",
			);

		$this->is_equal(utf8_str_split($str), $array);
	}

}
