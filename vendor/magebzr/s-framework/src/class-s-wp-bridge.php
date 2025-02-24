<?php

/**
 * 
 */

/**
 */
class S_WP_Bridge
{
	protected $wp_version;

	public function __construct($wp_version = 'latest')
	{
		$this->wp_version = $wp_version;
	}

	public function __call($name, $params)
	{
		if (!function_exists($name))
			throw new InvalidArgumentException(sprintf('Invalid WP utility function "%s"', $name));

		return call_user_func_array($name, $params);
	}

	/**
	 * Translate a string
	 *
	 * @param string $key
	 * @param string $domain
	 */
	public function t($key, $domain = 'default')
	{
		return __($key, $domain);
	}

	/**
	 * Translate and echo a string
	 *
	 * @param string $key
	 * @param string $domain
	 */
	public function te($key, $domain = 'default')
	{
		_e($key, $domain);
	}

	/**
	 * A wrapper for @see wp_cache_get()
	 *
	 * @since rev 165
	 */
	public function wp_cache_get($key, $group = '', $force = false, &$found = null)
	{
		return wp_cache_get($key, $group, $force, $found);
	}
}
