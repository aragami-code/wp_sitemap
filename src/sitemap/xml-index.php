<?php

/**
 */

/**
 * The XML sitemap index
 *
 * This follows closely @link http://www.sitemaps.org/protocol.html#index
 *
 * @author Khang Minh <contact@betterwp.net>
 */
class S_Sitemaps_Sitemap_XmlIndex extends S_Sitemaps_Sitemap
{
	/**
	 * {@inheritDoc}
	 */
	protected function set_xml_headers()
	{
		$this->xml_headers['xsi:schemaLocation'] = 'http://www.sitemaps.org/schemas/sitemap/0.9 '
			. 'http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function set_properties()
	{
		$this->xml_root_tag = 'sitemapindex';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function get_xml_item_body(array $item)
	{
		$sitemap = S_Sitemaps_Sitemap_Tag::create_compound_tag('sitemap');

		$sitemap->add_tag(S_Sitemaps_Sitemap_Tag::create_single_tag('loc', $item['location']));

		if (!empty($item['lastmod'])) {
			$sitemap->add_tag(S_Sitemaps_Sitemap_Tag::create_single_tag('lastmod', $item['lastmod']));
		}

		return $sitemap->get_xml();
	}
}
