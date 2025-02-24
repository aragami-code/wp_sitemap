<?php

/**
 */
class S_Sitemaps_Sitemap_Sanitizer_Xml_FrequencySanitizer extends S_Sitemaps_Sitemap_Sanitizer
{
	/**
	 * {@inheritDoc}
	 */
	public function sanitize($value)
	{
		$frequencies = $this->get_option('frequencies');
		if (! $frequencies || ! in_array($value, $frequencies)) {
			$value = $this->get_option('default_frequency');
		}

		if (! $value) {
			return null;
		}

		return $value;
	}

	protected function set_default_options()
	{
		$this->options = array(
			'frequencies'       => array(),
			'default_frequency' => 'daily'
		);
	}
}
