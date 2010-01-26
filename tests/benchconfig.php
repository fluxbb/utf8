<?php

if (!defined('UTF8'))
	define('UTF8', realpath(dirname(__FILE__).'/../'));

if (!defined('UTF8DATA'))
	define('UTF8DATA', dirname(__FILE__).'/data');

// Testing against a particular "engine"
if (!isset($_GET['engine']))
	$_GET['engine'] = 'auto';
elseif ($_GET['engine'] == 'mbstring')
	define('UTF8_USE_MBSTRING', true);
elseif ($_GET['engine'] == 'native')
	define('UTF8_USE_NATIVE', true);

require_once UTF8 . '/utf8.php';
