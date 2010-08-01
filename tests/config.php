<?php
error_reporting(E_ALL);
if (!defined('UTF8DATA'))
{
	define('UTF8DATA', dirname(__FILE__).'/data');
}

if (!defined('SIMPLE_TEST'))
{
	// Should point at SimpleTest (absolute path required with trailing slash)
	// or to your include path
	define('SIMPLE_TEST', 'simpletest/');
}

require_once SIMPLE_TEST.'unit_tester.php';
require_once SIMPLE_TEST.'mock_objects.php';

function &getTestReporter()
{
	if (php_sapi_name() != 'cli')
	{
		$R = new HtmlReporter('UTF-8');
	}
	else
	{
		require dirname(__FILE__).'/cli_reporter.php';
		$R = & new CLIReporter();
	}

	return $R;
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
