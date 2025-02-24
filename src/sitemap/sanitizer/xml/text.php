<?php

/*
 * 
 */
class S_Sitemaps_Sitemap_Sanitizer_Xml_TextSanitizer extends S_Sitemaps_Sitemap_Sanitizer
{
	/**
	 * {@inheritDoc}
	 */
	public function sanitize($value)
	{
		return trim(htmlspecialchars(strip_tags($value), ENT_QUOTES));
	}
}
