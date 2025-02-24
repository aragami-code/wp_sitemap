<?php

/**
 */
class S_Sitemaps_Sitemap_Sanitizer_Xml_PrioritySanitizer extends S_Sitemaps_Sitemap_Sanitizer
{
	/**
	 * {@inheritDoc}
	 */
	public function sanitize($value)
	{
		if ($value > 1 || $value < 0) {
			$value = $this->get_option('default_priority');
		}

		if (! $value) {
			return null;
		}

		return sprintf('%.1f', $value);
	}

	protected function set_default_options()
	{
		$this->options = array(
			'default_priority' => 0.5
		);
	}
}
