<?php

header('Content-type: text/plain; charset=utf-8');

require '../php-utf8.php';
require UTF8.'/utils/ascii.php';

require './testlib.php';

$tester = new TestLib('php-utf8 Unit Tests', './cases');

echo $tester->run_tests()
            ->text_report();
