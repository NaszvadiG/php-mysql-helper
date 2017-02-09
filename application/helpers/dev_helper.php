<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('pd'))
{
	function pd($d)
	{
		echo '<pre>';
			print_r($d);
		echo '</pre>';
		die();
	}
}

if(!function_exists('vd'))
{
	function vd($d)
	{
		echo '<pre>';
			var_dump($d);
		echo '</pre>';
		die();
	}
}

if(!function_exists('pp'))
{
	function pp($d)
	{
		echo '<pre>';
			print_r($d);
		echo '</pre>';
	}
}

if(!function_exists('vp'))
{
	function vp($d)
	{
		echo '<pre>';
			print_r($d);
		echo '</pre>';
	}
}

if(!function_exists('is_os_windows'))
{
	function is_os_windows()
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		  return TRUE;
		} else {
		  return FALSE;
		}
	}
}

