<?php

/**
 *
 */
abstract class S_Sitemaps_Provider
{
	protected $plugin;

	protected $bridge;

	protected $excluder;

	public function __construct(S_Sitemaps $plugin, S_Sitemaps_Excluder $excluder)
	{
		$this->plugin = $plugin;
		$this->bridge = $plugin->get_bridge();

		$this->excluder = $excluder;
	}

	public function get_exluder()
	{
		return $this->excluder;
	}

	public function get_bridge()
	{
		return $this->bridge;
	}

	public function get_domain()
	{
		return $this->plugin->domain;
	}
}
