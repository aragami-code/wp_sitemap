<?php

/**
 
 */
class S_Sitemaps_Sitemap_Sanitizer_Factory
{
	protected $plugin;

	protected $priority_sanitizer;

	protected $frequency_sanitizer;

	public function __construct(S_Sitemaps $plugin)
	{
		$this->plugin = $plugin;
	}

	/**
	 * @return S_Sitemaps_Sitemap_Sanitizer_Xml_PrioritySanitizer
	 */
	public function get_priority_sanitizer()
	{
		$this->priority_sanitizer = $this->priority_sanitizer
			? $this->priority_sanitizer
			: new S_Sitemaps_Sitemap_Sanitizer_Xml_PrioritySanitizer(array(
				'default_priority' => $this->plugin->options['select_default_pri']
			));

		return $this->priority_sanitizer;
	}

	/**
	 * @return S_Sitemaps_Sitemap_Sanitizer_Xml_FrequencySanitizer
	 */
	public function get_frequency_sanitizer()
	{
		$this->frequency_sanitizer = $this->frequency_sanitizer
			? $this->frequency_sanitizer
			: new S_Sitemaps_Sitemap_Sanitizer_Xml_FrequencySanitizer(array(
				'frequencies'       => $this->plugin->frequencies,
				'default_frequency' => $this->plugin->options['select_default_freq']
			));

		return $this->frequency_sanitizer;
	}
}
