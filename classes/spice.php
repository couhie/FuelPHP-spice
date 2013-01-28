<?php
namespace Spice;

class Spice
{

	public static function controller_name($str)
	{
		return strtolower(str_replace('Controller_', '', $str));
	}

}