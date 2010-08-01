<?php
require dirname(__FILE__).'/../benchconfig.php';
echo utf8_strlen(file_get_contents(UTF8DATA.'/utf8.html'))."\n";
