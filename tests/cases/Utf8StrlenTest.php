<?php

class Utf8StrlenTest extends TestLibCase
{
    public function test_utf8()
    {
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->equal(utf8_strlen($str), 20);
    }

	function test_utf8_invalid()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->equal(utf8_strlen($str), 20);
	}

	function test_ascii()
	{
		$str = 'ABC 123';
		$this->equal(utf8_strlen($str), 7);
	}

	function test_empty_str()
	{
		$str = '';
		$this->equal(utf8_strlen($str), 0);
	}
}
