<?php

if (!defined('SIMPLE_TEST'))
	// Should point at SimpleTest (absolute path required with trailing slash)
	define('SIMPLE_TEST', '/srv/http/nginx/php/simpletest/'); // Use your include path

if (!defined('UTF8'))
	define('UTF8', realpath(dirname(__FILE__).'/../'));

if (!defined('UTF8DATA'))
	define('UTF8DATA', dirname(__FILE__).'/data');

// Load SimpleTest and main JPSpan
if (file_exists(SIMPLE_TEST.'unit_tester.php'))
{
	require_once SIMPLE_TEST.'unit_tester.php';
	require_once SIMPLE_TEST.'mock_objects.php';
	#require_once SIMPLE_TEST.'reporter.php';
}
else
	trigger_error('Unable to load SimpleTest: configure SIMPLE_TEST in config.php');

function & getTestReporter()
{
	if (php_sapi_name() != 'cli')
		$R = new HtmlReporter('UTF-8');
	else
	{
		require dirname(__FILE__).'/cli_reporter.php';
		$R = & new CLIReporter();
	}

	return $R;
}

// Testing against a particular "engine"
if (!isset($_GET['engine']))
	$_GET['engine'] = 'auto';
elseif ($_GET['engine'] == 'mbstring')
	define('UTF8_USE_MBSTRING', true);
elseif ($_GET['engine'] == 'native')
	define('UTF8_USE_NATIVE', true);

require_once UTF8.'/utf8.php';
