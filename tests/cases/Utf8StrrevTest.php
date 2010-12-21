<?php

require_once UTF8.'/functions/strrev.php';


class Utf8StrrevTest extends TestLibTestCase
{
	protected $name = 'utf8_strrev()';

	protected function test_reverse()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$rev = 'nøitæzilànôitânrëtñI';
		$this->is_equal(utf8_strrev($str), $rev);
	}

	protected function test_empty_str()
	{
		$str = '';
		$rev = '';
		$this->is_equal(utf8_strrev($str), $rev);
	}

	protected function test_linefeed()
	{
		$str = "Iñtërnâtiôn\nàlizætiøn";
		$rev = "nøitæzilà\nnôitânrëtñI";
		$this->is_equal(utf8_strrev($str), $rev);
	}
}
