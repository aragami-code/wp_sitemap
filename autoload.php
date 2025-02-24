<?php

function _s_mb_autoloader($class_name)
{
	$class_maps = include dirname(__FILE__) . '/vendor/composer/autoload_classmap.php';

	// only load classes
	if (stripos($class_name, 'S') === false) {
		return;
	}

	if (array_key_exists($class_name, $class_maps)) {
		require $class_maps[$class_name];
	}
}

spl_autoload_register('_s_mb_autoloader');
