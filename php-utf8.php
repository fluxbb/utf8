<?php
/**
 * The dynamic loader for the PHP-UTF8 library.
 * 
 * It checks whether you have the mbstring extension available and includes
 * relevant files on that basis, falling back to the native (as in written in
 * PHP) version if mbstring is unavailabe.
 *
 * It's probably easiest to use this, if you don't want to understand the
 * dependencies involved, in conjunction with PHP versions etc. At the same time,
 * you might get better performance by managing loading yourself. The smartest
 * way to do this, bearing in mind performance, is probably to "load on demand"
 * - i.e. just before you use these functions in your code, load the version you
 * need.
 *
 * It makes sure the the following functions are available;
 * utf8_strlen, utf8_strpos, utf8_strrpos, utf8_substr, utf8_strtolower, utf8_strtoupper
 *
 * Other functions in the ./native directory depend on these six functions being available
 *
 * @package php-utf8
 */

// Check whether PCRE has been compiled with UTF-8 support
$UTF8_ar = array( );
if( preg_match('/^.{1}$/u', "ñ", $UTF8_ar) != 1 )
{
	trigger_error('PCRE is not compiled with UTF-8 support', E_USER_ERROR);
}
unset($UTF8_ar);

/**
 * UTF8 constant, holds the current directory.
 */
if( !defined('UTF8') )
{
	define('UTF8', dirname(__FILE__));
}

/**
 * PHP_UTF8_MODE constant, will be 'native' or 'mbstring'.
 */
if(!defined('PHP_UTF8_MODE'))
{
	if( extension_loaded('mbstring') )
	{
		define('PHP_UTF8_MODE', 'mbstring');
	}
	else
	{
		define('PHP_UTF8_MODE', 'native');
	}
}

if( PHP_UTF8_MODE == 'mbstring' )
{
	// If string overloading is active, it will break many of the native implementations
	if( ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING )
	{
		trigger_error('String functions are overloaded by mbstring, must be set to 0, 1 or 4 in php.ini for PHP-UTF8 to work.', E_USER_ERROR);
	}
	// Also need to check we have the correct internal mbstring encoding
	mb_language('uni');
	mb_internal_encoding('UTF-8');

}
elseif( PHP_UTF8_MODE == 'native' )
{
	if( !defined('UTF8_CORE') )
	{
		require UTF8.'/utils/unicode.php';
	}
}

if( !defined('UTF8_CORE') )
{
	require UTF8.'/core/'.PHP_UTF8_MODE.'.php';
}

require UTF8.'/core/functions.php';