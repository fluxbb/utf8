<?php
if( !defined('UTF8DATA') )
{
	define('UTF8DATA', dirname(__FILE__).'/data');
}

// Testing against a particular "engine"
if (!isset($_GET['engine']))
{
	$_GET['engine'] = 'auto';
}
elseif ($_GET['engine'] == 'mbstring' || $_GET['engine'] == 'native')
{
	define('PHP_UTF8_MODE', $_GET['engine']);
}

require_once '../php-utf8.php';
