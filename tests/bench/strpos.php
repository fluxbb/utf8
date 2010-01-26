<?php

require dirname(__FILE__).'/../benchconfig.php';
$page = file_get_contents(UTF8DATA.'/utf8.html');

foreach (range('A', 'Z') as $char)
    echo utf8_strpos($page, $char)."\n";
