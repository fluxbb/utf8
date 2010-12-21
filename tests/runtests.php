<?php

error_reporting(E_ALL);
header('Content-type: text/plain; charset=utf-8');

require_once '../php-utf8.php';
require './testlib.php';

$tester = new TestLib('php-utf8 Unit Tests', './cases');

echo $tester->run_tests()
            ->text_report();
