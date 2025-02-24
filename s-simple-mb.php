<?php
/*
Plugin Name: MB Sitemaps XML
Description: Easy to make sitemap XML.
Version: 1.0
Text Domain: mb-sitemap-xml
Domain Path: /languages/
Author: NGOUMA TIMOTHEE FREDY

*/

/**
 */
// in case someone integrates this plugin in a theme or calling this directly
global $s_mb;

if ((isset($s_mb) && $s_mb instanceof S_Sitemaps) || !defined('ABSPATH'))
	return;

// require libs manually if PHP version is lower than 5.3.2
// @todo remove this when WordPress drops support for PHP version < 5.3.2
if (version_compare(PHP_VERSION, '5.3.2', '<'))
{
	require_once dirname(__FILE__) . '/autoload.php';
}
else
{
	// load dependencies using composer autoload
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Global instance of the plugin
 *
 * `
 *
 * @var S_Sitemaps
 */
$s_mb = new S_Sitemaps(array(
	'title'   => '',
	'version' => '',
	'domain'  => 'mb-sitemaps-xml'
));
