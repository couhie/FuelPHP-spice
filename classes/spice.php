<?php
namespace Spice;

class Spice
{

	public static function controller_name($str)
	{
		return strtolower(str_replace('Controller_', '', $str));
	}

	public static function fgetcsv(&$handle, $length = null, $d = ',', $e = '"')
	{
		$encoding_list = array(
			'UTF-8',
			'sjis-win',
			'eucjp-win',
		);

		$d = preg_quote($d);
		$e = preg_quote($e);
		$_line = "";
		$eof = false;

		while (($eof != true) and ( ! feof($handle)))
		{
			$_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
			$itemcnt = preg_match_all('/'.$e.'/', $_line, $dummy);
			if ($itemcnt % 2 == 0) $eof = true;
		}

		$_csv_line = preg_replace('/(?:\\r\\n|[\\r\\n])?$/', $d, trim($_line));
		$_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
		preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
		$_csv_data = $_csv_matches[1];

		$_enc_to = mb_internal_encoding();

		for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++)
		{
			$_csv_data[$_csv_i] = preg_replace('/^'.$e.'(.*)'.$e.'$/s','$1',$_csv_data[$_csv_i]);
			$_csv_data[$_csv_i] = str_replace($e.$e, $e, $_csv_data[$_csv_i]);
			$_enc_from = mb_detect_encoding($_csv_data[$_csv_i], $encoding_list);
			if ($_enc_to === $_enc_from) continue;
			mb_convert_variables($_enc_to, $_enc_from, $_csv_data[$_csv_i]);
		}

		return empty($_line) ? false : $_csv_data;
	}

}