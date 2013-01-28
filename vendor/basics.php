<?php
/**
 * basics.php
 * @author kohei hieda
 *
 */

/**
 * d
 * @param $data
 */
if (!function_exists('d')) {
	function d($data, $recursive = 0) {
		if (!empty($GLOBALS['DEBUG'])) {
			$ret = array();
			$backtrace = debug_backtrace();
			for ($i = $recursive; $i > 0; $i--) {
				$call = array();
				if (!empty($backtrace[$i])) {
					$call['file'] = empty($backtrace[$i]['file']) ? null : $backtrace[$i]['file'];
					$call['line'] = empty($backtrace[$i]['line']) ? null : $backtrace[$i]['line'];
					$call['function'] = empty($backtrace[$i]['function']) ? null : $backtrace[$i]['function'];
					$call['class'] = empty($backtrace[$i]['class']) ? null : $backtrace[$i]['class'];
				}
				$ret["call[{$i}]"] = $call;
			}
			$call = array();
			$call['file'] = $backtrace[0]['file'];
			$call['line'] = $backtrace[0]['line'];
			$call['function'] = empty($backtrace[0]['function']) ? null : $backtrace[0]['function'];
			$call['class'] = empty($backtrace[0]['class']) ? null : $backtrace[0]['class'];
			$ret["call[0]"] = $call;
			$ret['data'] = $data;
			new dBug($ret);
		}
	}
}

/**
 * l
 * @param $data
 */
if (!function_exists('l')) {
	function l($data) {
		if (\Fuel::$profiling)
		{
			\Profiler::console($data);
		}
	}
}

/**
 * nl2sp
 * @param $str
 * @return string
 */
if (!function_exists('nl2sp')) {
	function nl2sp($str) {
		return strlen($str) > 0 ? $str : '&nbsp;';
	}
}

/**
 * emoji
 * @param $code
 * @return string
 */
if (!function_exists('emoji')) {
	function emoji($code) {
		return pack('H*', $code);
	}
}

/**
 * br2nl
 * @param $str
 * @return string
 */
if (!function_exists('br2nl')) {
	function br2nl($str) {
		return preg_replace('/<br\s*?\/?>/i', "\n", $str);
	}
}

/**
 * formatNumber
 * @param $str
 * @return string
 */
if (!function_exists('formatNumber')) {
	function formatNumber($str) {
		if (is_numeric($str)) {
			$str = number_format($str);
		}
		return $str;
	}
}

/**
 * arrtoupper
 * @param $data
 * @param $kyes
 * @return array
 */
if (!function_exists('arrtoupper')) {
	function arrtoupper($data, $keys) {
		array_walk_recursive($data, create_function(
				'&$value, $key, $keys',
				'in_array($key, $keys) and ($value = strtoupper($value));'
			), $keys);
		return $data;
	}
}

/**
 * arrtolower
 * @param $data
 * @param $kyes
 * @return array
 */
if (!function_exists('arrtolower')) {
	function arrtolower($data, $keys) {
		array_walk_recursive($data, create_function(
				'&$value, $key, $keys',
				'in_array($key, $keys) and ($value = strtolower($value));'
			), $keys);
		return $data;
	}
}
