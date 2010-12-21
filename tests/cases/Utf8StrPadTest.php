<?php

require_once UTF8.'/functions/str_pad.php';


class Utf8StrPadTest extends TestLibTestCase
{
	protected $name = 'utf8_str_pad()';

	public function test_str_pad()
	{
		$toPad = '<IñtërnëT>'; // 10 characters
		$padding = 'ø__'; // 4 characters

		$this->is_equal(utf8_str_pad($toPad, 20), $toPad.'          ');
		$this->is_equal(utf8_str_pad($toPad, 20, ' ', STR_PAD_LEFT), '          '.$toPad);
		$this->is_equal(utf8_str_pad($toPad, 20, ' ', STR_PAD_BOTH), '     '.$toPad.'     ');

		$this->is_equal(utf8_str_pad($toPad, 10), $toPad);
		$this->is_equal(str_pad('5char', 4), '5char'); // str_pos won't truncate input string
		$this->is_equal(utf8_str_pad($toPad, 8), $toPad);

		$this->is_equal(utf8_str_pad($toPad, 20, $padding, STR_PAD_RIGHT), $toPad.'ø__ø__ø__ø');
		$this->is_equal(utf8_str_pad($toPad, 20, $padding, STR_PAD_LEFT), 'ø__ø__ø__ø'.$toPad);
		$this->is_equal(utf8_str_pad($toPad, 20, $padding, STR_PAD_BOTH), 'ø__ø_'.$toPad.'ø__ø_');
	}
}
