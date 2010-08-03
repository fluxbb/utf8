<?php

/**
* @version $Id: utf8_bad.test.php,v 1.6 2006/02/26 13:39:37 harryf Exp $
* @package utf8
* @subpackage Tests
*/

/**
* Includes
* @package utf8
* @subpackage Tests
*/
require_once dirname(__FILE__).'/../config.php';
require_once UTF8.'/utils/patterns.php';
require_once UTF8.'/utils/bad.php';

/**
* @package utf8
* @subpackage Tests
*/
class test_utf8_bad_find extends UnitTestCase
{
	function test_utf8_bad_find()
	{
		$this->UnitTestCase('utf8_bad_find()');
	}

	function testValidUtf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->assertFalse(utf8_bad_find($str));
	}

	function testValidUtf8Ascii()
	{
		$str = 'testing';
		$this->assertFalse(utf8_bad_find($str));
	}

	function testInvalidUtf8()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 15);
	}

	function testInvalidUtf8Ascii()
	{
		$str = "this is an invalid char '\xe9' here";
		$this->assertEqual(utf8_bad_find($str), 25);
	}

	function testInvalidUtf8Start()
	{
		$str = "\xe9Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 0);
	}

	function testInvalidUtf8End()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe9";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testValidTwoOctetId()
	{
		$str = "abc\xc3\xb1";
		$this->assertFalse(utf8_bad_find($str));
	}

	function testInvalidTwoOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 28);
	}

	function testInvalidIdBetweenTwoAndThree()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testValidThreeOctetId()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->assertFalse(utf8_bad_find($str));
	}

	function testInvalidThreeOctetSequenceSecond()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testInvalidThreeOctetSequenceThird()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testValidFourOctetId()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertFalse(utf8_bad_find($str));
	}

	function testInvalidFourOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testInvalidFiveOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str),27);
	}

	function testInvalidSixOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testValidUtf8All()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->assertFalse(utf8_bad_find($str, FALSE));
	}

	function testValidUtf8AsciiAll()
	{
		$str = 'testing';
		$this->assertFalse(utf8_bad_find($str, FALSE));
	}

	function testInvalidUtf8All()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$test = array(15);
		$this->assertEqual(utf8_bad_find($str, FALSE), $test);
	}

	function testInvalidUtf8AsciiAll()
	{
		$str = "this is an invalid char '\xe9' here";
		$test = array(25);
		$this->assertEqual(utf8_bad_find($str, FALSE), $test);
	}

	function testInvalidUtf8MultipleAll()
	{
		$str = "\xe9Iñtërnâtiôn\xe9àlizætiøn\xe9";
		$test = array(0, 16, 29);
		$this->assertEqual(utf8_bad_find($str, FALSE), $test);
	}

	function testValidTwoOctetIdAll()
	{
		$str = "abc\xc3\xb1";
		$this->assertFalse(utf8_bad_find($str, FALSE));
	}

	function testInvalidTwoOctetSequenceAll()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str, FALSE), array(28));
	}

	function testInvalidIdBetweenTwoAndThreeAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str, FALSE), array(27, 28));
	}

	function testValidThreeOctetIdAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->assertFalse(utf8_bad_find($str, FALSE));
	}

	function testInvalidThreeOctetSequenceSecondAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str, FALSE), array(27, 29));
	}

	function testInvalidThreeOctetSequenceThirdAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str), 27);
	}

	function testValidFourOctetIdAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertFalse(utf8_bad_find($str, FALSE));
	}

	function testInvalidFourOctetSequenceAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str, FALSE), array(27, 29, 30));
	}

	function testInvalidFiveOctetSequenceAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str, FALSE), range(27, 31));
	}

	function testInvalidSixOctetSequenceAll()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_find($str, FALSE), range(27, 32));
	}
}


/**
* @package utf8
* @subpackage Tests
*/
class test_utf8_bad_clean extends UnitTestCase
{
	function test_utf8_bad_clean()
	{
		$this->UnitTestCase('test_utf8_bad_clean()');
	}

	function testValidUtf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->assertEqual(utf8_bad_clean($str), $str);
	}

	function testValidUtf8Ascii()
	{
		$str = 'testing';
		$this->assertEqual(utf8_bad_clean($str), $str);
	}

	function testInvalidUtf8()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), 'Iñtërnâtiônàlizætiøn');
	}

	function testInvalidUtf8Ascii()
	{
		$str = "this is an invalid char '\xe9' here";
		$this->assertEqual(utf8_bad_clean($str), "this is an invalid char '' here");
	}

	function testInvalidUtf8Multiple()
	{
		$str = "\xe9Iñtërnâtiôn\xe9àlizætiøn\xe9";
		$this->assertEqual(utf8_bad_clean($str), 'Iñtërnâtiônàlizætiøn');
	}

	function testValidTwoOctetId()
	{
		$str = "abc\xc3\xb1";
		$this->assertEqual(utf8_bad_clean($str), $str);
	}

	function testInvalidTwoOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$stripped = "Iñtërnâtiônàlizætiøn \x28 Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testInvalidIdBetweenTwoAndThree()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$stripped = "IñtërnâtiônàlizætiønIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testValidThreeOctetId()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $str);
	}

	function testInvalidThreeOctetSequenceSecond()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$stripped = "Iñtërnâtiônàlizætiøn(Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testInvalidThreeOctetSequenceThird()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$stripped = "Iñtërnâtiônàlizætiøn(Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testValidFourOctetId()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $str);
	}

	function testInvalidFourOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$stripped = "Iñtërnâtiônàlizætiøn(Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testInvalidFiveOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$stripped = "IñtërnâtiônàlizætiønIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testInvalidSixOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$stripped = "IñtërnâtiônàlizætiønIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str), $stripped);
	}

	function testValidUtf8Replace()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->assertEqual(utf8_bad_clean($str, '?'), $str);
	}

	function testValidUtf8AsciiReplace()
	{
		$str = 'testing';
		$this->assertEqual(utf8_bad_clean($str, '?'), $str);
	}

	function testInvalidUtf8Replace()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), 'Iñtërnâtiôn?àlizætiøn');
	}

	function testInvalidUtf8WithXReplace()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, 'X'), 'IñtërnâtiônXàlizætiøn');
	}

	function testInvalidUtf8AsciiReplace()
	{
		$str = "this is an invalid char '\xe9' here";
		$this->assertEqual(utf8_bad_clean($str, '?'), "this is an invalid char '?' here");
	}

	function testInvalidUtf8MultipleReplace()
	{
		$str = "\xe9Iñtërnâtiôn\xe9àlizætiøn\xe9";
		$this->assertEqual(utf8_bad_clean($str, '?'), '?Iñtërnâtiôn?àlizætiøn?');
	}

	function testValidTwoOctetIdReplace()
	{
		$str = "abc\xc3\xb1";
		$this->assertEqual(utf8_bad_clean($str, '?'), $str);
	}

	function testInvalidTwoOctetSequenceReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn ?( Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}

	function testInvalidIdBetweenTwoAndThreeReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn??Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}

	function testValidThreeOctetIdReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $str);
	}

	function testInvalidThreeOctetSequenceSecondReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn?(?Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}

	function testInvalidThreeOctetSequenceThirdReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn??(Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}

	function testValidFourOctetIdReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $str);
	}

	function testInvalidFourOctetSequenceReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn?(??Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}

	function testInvalidFiveOctetSequenceReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn?????Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}

	function testInvalidSixOctetSequenceReplace()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$replaced = "Iñtërnâtiônàlizætiøn??????Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_clean($str, '?'), $replaced);
	}
}

/**
* @package utf8
* @subpackage Tests
*/
class test_utf8_bad_identify extends UnitTestCase
{
	function test_utf8_bad_identify()
	{
		$this->UnitTestCase('utf8_bad_identify()');
	}

	function testValidUtf8()
	{
		$str = 'Iñtërnâtiônàlizætiøn';
		$this->assertFalse(utf8_bad_identify($str, $i));
		$this->assertNull($i);
	}

	function testValidUtf8Ascii()
	{
		$str = 'testing';
		$this->assertFalse(utf8_bad_identify($str, $i));
		$this->assertNull($i);
	}

	function testInvalidUtf8()
	{
		$str = "Iñtërnâtiôn\xe9àlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 15);
	}

	function testInvalidUtf8Ascii()
	{
		$str = "this is an invalid char '\xe9' here";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 25);
	}

	function testInvalidUtf8Start()
	{
		$str = "\xe9Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 0);
	}

	function testInvalidUtf8End()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe9";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 27);
	}

	function testValidTwoOctetId()
	{
		$str = "abc\xc3\xb1";
		$this->assertFalse(utf8_bad_identify($str, $i));
		$this->assertNull($i);
	}

	function testInvalidTwoOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn \xc3\x28 Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 28);
	}

	function testInvalidIdBetweenTwoAndThree()
	{
		$str = "Iñtërnâtiônàlizætiøn\xa0\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQID);
		$this->assertEqual($i, 27);
	}

	function testValidThreeOctetId()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\xa1Iñtërnâtiônàlizætiøn";
		$this->assertFalse(utf8_bad_identify($str, $i));
		$this->assertNull($i);
	}

	function testInvalidThreeOctetSequenceSecond()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x28\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 27);
	}

	function testInvalidThreeOctetSequenceThird()
	{
		$str = "Iñtërnâtiônàlizætiøn\xe2\x82\x28Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 28);
	}

	function testValidFourOctetId()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x90\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertFalse(utf8_bad_identify($str, $i));
		$this->assertNull($i);
	}

	function testInvalidFourOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf0\x28\x8c\xbcIñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_SEQINCOMPLETE);
		$this->assertEqual($i, 27);
	}

	function testInvalidFiveOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xf8\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_5OCTET);
		$this->assertEqual($i, 27);
	}

	function testInvalidSixOctetSequence()
	{
		$str = "Iñtërnâtiônàlizætiøn\xfc\xa1\xa1\xa1\xa1\xa1Iñtërnâtiônàlizætiøn";
		$this->assertEqual(utf8_bad_identify($str, $i),PHP_UTF8_BAD_6OCTET);
		$this->assertEqual($i, 27);
	}
}

/**
* @package utf8
* @subpackage Tests
*/
if (!defined('TEST_RUNNING'))
{
	define('TEST_RUNNING', true);

	$test = new GroupTest('utf8_bad');
	$test->addTestCase(new test_utf8_bad_find());
	$test->addTestCase(new test_utf8_bad_clean());
	$test->addTestCase(new test_utf8_bad_identify());

	$reporter = getTestReporter();
	$test->run($reporter);
}
