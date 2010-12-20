<?php

class Utf8StrlenTest extends TestLibTestCase
{
    public function test_utf8()
    {
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->is_equal(utf8_strlen($str), 20);
    }

	function test_utf8_invalid()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->is_equal(utf8_strlen($str), 20);
	}

	function test_ascii()
	{
		$str = 'ABC 123';
		$this->is_equal(utf8_strlen($str), 7);
	}

	function test_empty_str()
	{
		$str = '';
		$this->is_equal(utf8_strlen($str), 0);
	}
}
