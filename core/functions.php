<?php
/**
 * Facade functions for the PHP-UTF8 core replacement functions.
 *
 * @package php-utf8
 * @subpackage functions
 */

/**
 * Facade function for the PHP-UTF8 strlen replacement function.
 *
 * @uses mbstring_strlen
 * @uses native_strlen
 * @param string $str
 * @return string
 */
function utf8_strlen($str)
{
	return call_user_func(PHP_UTF8_MODE.'_strlen', $str);
}

/**
 * Facade function for the PHP-UTF8 strpos replacement function.
 *
 * @uses mbstring_strpos
 * @uses native_strpos
 * @param string $str
 * @param string $search
 * @param int $offset
 * @return int
 */
function utf8_strpos($str, $search, $offset = FALSE)
{
	return call_user_func(PHP_UTF8_MODE.'_strpos',$str, $search, $offset);
}

/**
 * Facade function for the PHP-UTF8 strrpos function.
 *
 * @uses mbstring_strrpos
 * @uses native_strrpos
 * @param string $str
 * @param string $search
 * @param int $offset
 * @return int
 */
function utf8_strrpos($str, $search, $offset = false)
{
	return call_user_func(PHP_UTF8_MODE.'_strrpos',$str, $search, $offset);
}

/**
 * Facade function for the PHP-UTF8 substr function.
 *
 * @uses mbstring_substr
 * @uses native_substr
 * @param string $str
 * @param int $offset
 * @param int $length
 * @return string
 */
function utf8_substr($str, $offset, $length = false)
{
	return call_user_func(PHP_UTF8_MODE.'_substr',$str, $offset, $length);
}

/**
 * Facade function for the PHP-UTF8 strtolower function.
 *
 * @uses mbstring_strtolower
 * @uses native_strtolower
 * @param string $str
 * @return string
 */
function utf8_strtolower($str)
{
	return call_user_func(PHP_UTF8_MODE.'_strtolower', $str);
}

/**
 * Facade function for the PHP-UTF8 strtoupper function.
 *
 * @uses mbstring_strtoupper
 * @uses native_strtoupper
 * @param string $str
 * @return string
 */
function utf8_strtoupper($str)
{
	return call_user_func(PHP_UTF8_MODE.'_strtoupper', $str);
}