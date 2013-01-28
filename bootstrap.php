<?php
Autoloader::add_core_namespace('Spice');
Autoloader::add_classes(
	array(
		'Spice\\Spice' => __DIR__.DS.'classes'.DS.'spice.php',
	)
);

require_once(__DIR__.DS.'vendor'.DS.'basics.php');
require_once(__DIR__.DS.'vendor'.DS.'dBug'.DS.'dBug.php');
