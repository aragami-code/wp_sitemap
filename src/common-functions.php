<?php

function s_mb_get_filename($sitemap_name)
{
	global $s_mb;

	// cache filename, use gz all the time to save space
	// @todo save both .xml version and .xml.gz version
	// append home_url to be WPMS compatible
	$filename  = 'mb_' . md5($sitemap_name . '_' . home_url());
	$filename .= '.xml.gz';

	return trailingslashit($s_mb->get_cache_directory()) . $filename;
}

function s_mb_format_header_time($time)
{
	return gmdate('D, d M Y H:i:s \G\M\T', (int) $time);
}
