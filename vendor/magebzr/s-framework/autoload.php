<?php

if (!function_exists('_s_framework_autoloader')) {
	function _s_framework_autoloader($class_name)
	{
		$class_maps = include dirname(__FILE__) . '/vendor/composer/autoload_classmap.php';

		//  classes
		if (stripos($class_name, 'S') === false) {
			return;
		}

		if (array_key_exists($class_name, $class_maps)) {
			require $class_maps[$class_name];
		}
	}

	spl_autoload_register('_s_framework_autoloader');
}
