<?php

/**
 *
 */

/**
 * Provides caching mechanism for smb plugins
 *
 * @author Khang Minh <contact@betterwp.net>
 */
class S_Cache
{
	protected $bridge;

	/**
	 * The group to store all items under
	 *
	 * @var string
	 */
	protected $group;

	public function __construct(S_WP_Bridge $bridge, $group)
	{
		$this->bridge = $bridge;
		$this->group  = $group;
	}

	/**
	 * Set cached value of a property
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param bool $shared whether to share with other plugins
	 * @uses wp_cache_set
	 * @return true if successful, false if failed
	 */
	public function set($key, $value, $shared = false)
	{
		return $this->bridge->wp_cache_set($key, $value, $shared ? 's_plugins' : $this->group);
	}

	/**
	 * Get cached value of a property
	 *
	 * @param string $key
	 * @param bool $shared whether to get shared value
	 * @param mixed $not_found_value value to return when key not found in cache
	 *
	 * @uses wp_cache_get
	 * @return mixed
	 */
	public function get($key, $shared = false, $not_found_value = null)
	{
		$value = $this->bridge->wp_cache_get($key, $shared ? 's_plugins' : $this->group, false, $found);

		if ($found) {
			return $value;
		}

		return $not_found_value;
	}
}
