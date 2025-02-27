<?php

/**
 * 
 */
abstract class S_Sitemaps_Sitemap_Sanitizer
{
	/**
	 * Sanitizer options
	 *
	 * @var array
	 */
	protected $options;

	public function __construct(array $options = array())
	{
		$this->set_default_options();

		$this->options = array_merge($this->options, $options);
	}

	/**
	 * Sanitize a value for sitemap rendering
	 *
	 * This should always return a string representation of the value
	 *
	 * @param mixed $value
	 * @return string|null null if the sanitized value is not valid
	 */
	abstract public function sanitize($value);

	/**
	 * Set default options for this sanitizer
	 */
	protected function set_default_options()
	{
		$this->options = array();
	}

	protected function get_option($key)
	{
		return isset($this->options[$key]) ? $this->options[$key] : null;
	}
}
