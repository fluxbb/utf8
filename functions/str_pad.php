<?php

/**
 * UTF-8 aware alternative to str_pad.
 *
 * $pad_str may contain multi-byte characters.
 *
 * @author Oliver Saunders <oliver@osinternetservices.com>
 * @package php-utf8
 * @subpackage functions
 * @see http://www.php.net/str_pad
 * @uses utf8_substr
 * @param string $input
 * @param int $length
 * @param string $pad_str
 * @param int $type ( same constants as str_pad )
 * @return string
 */
function utf8_str_pad($input, $length, $pad_str=' ', $type = STR_PAD_RIGHT)
{
	$input_len = utf8_strlen($input);
	if ($length <= $input_len)
		return $input;

	$pad_str_len = utf8_strlen($pad_str);
	$pad_len = $length - $input_len;

	if ($type == STR_PAD_RIGHT)
	{
		$repeat_times = ceil($pad_len / $pad_str_len);
		return utf8_substr($input.str_repeat($pad_str, $repeat_times), 0, $length);
	}

	if ($type == STR_PAD_LEFT)
	{
		$repeat_times = ceil($pad_len / $pad_str_len);
		return utf8_substr(str_repeat($pad_str, $repeat_times), 0, floor($pad_len)).$input;
	}

	if ($type == STR_PAD_BOTH)
	{
		$pad_len /= 2;
		$pad_amount_left = floor($pad_len);
		$pad_amount_right = ceil($pad_len);
		$repeat_times_left = ceil($pad_amount_left / $pad_str_len);
		$repeat_times_right = ceil($pad_amount_right / $pad_str_len);

		$padding_left = utf8_substr(str_repeat($pad_str, $repeat_times_left), 0, $pad_amount_left);
		$padding_right = utf8_substr(str_repeat($pad_str, $repeat_times_right), 0, $pad_amount_right);

		return $padding_left.$input.$padding_right;
	}

	trigger_error('utf8_str_pad: Unknown padding type ('.$type.')', E_USER_ERROR);
}
