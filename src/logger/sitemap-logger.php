<?php

/**
 * 
 */
class S_Sitemaps_Logger_SitemapLogger extends S_Sitemaps_Logger
{
	/**
	 * {@inheritDoc}
	 */
	public function log(S_Sitemaps_Logger_LogItem $item)
	{
		if (!($item instanceof S_Sitemaps_Logger_Sitemap_LogItem)) {
			throw new InvalidArgumentException(sprintf('expect an item of type S_Sitemaps_Logger_Sitemap_LogItem, "%s" provded.', get_class($item)));
		}

		// replace existing item
		$this->items[$item->get_sitemap_slug()] = $item;
	}

	/**
	 * Get a log item based on sitemap slug
	 *
	 * @param string $slug
	 * @return S_Sitemaps_Logger_Sitemap_LogItem
	 */
	public function get_sitemap_log_item($slug)
	{
		foreach ($this->items as $item) {
			if ($item->get_sitemap_slug() === $slug) {
				return $item;
			}
		}
	}
}
