<?php

error_reporting(E_ALL);

// Testing against a particular "engine"
// Define PHP_UTF8_MODE if an engine is specified. Otherwise let php-utf8 choose
// en engine (PHP_UTF8_MODE will be defined in ../php-utf8.php).
if (isset($_GET['engine']) && ($_GET['engine'] == 'mbstring' || $_GET['engine'] == 'native'))
	define('PHP_UTF8_MODE', $_GET['engine']);


require_once '../php-utf8.php';
require_once './testlib.php';


header('Content-type: text/plain; charset=utf-8');

$tester = new TestLib('php-utf8 Unit Tests ('.PHP_UTF8_MODE.')', './cases');

echo $tester->run_tests()
            ->text_report();
