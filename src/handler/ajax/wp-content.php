<?php

/**
 * 
 */
abstract class S_Sitemaps_Handler_Ajax_WPContentHandler extends S_Sitemaps_Handler_AjaxHandler
{
	/**
	 * @var S_Sitemaps_Provider
	 */
	protected $provider;

	/**
	 * @var S_Sitemaps_Excluder
	 */
	protected $excluder;

	public function __construct(S_Sitemaps_Provider $provider)
	{
		$this->provider = $provider;
		$this->excluder = $provider->get_exluder();
		$this->bridge   = $provider->get_bridge();
	}

	/**
	 * Remove excluded item action
	 */
	public function remove_excluded_item_action()
	{
		$this->bridge->check_ajax_referer('s_mb_remove_excluded_item');

		if (($group = S_Framework_Util::get_request_var('group'))
			&& ($id = S_Framework_Util::get_request_var('id'))
		) {
			$excluded_items = $this->excluder->get_excluded_items($group);

			$key = array_search($id, $excluded_items);

			if ($key !== false) {
				unset($excluded_items[$key]);
				$this->excluder->update_excluded_items($group, $excluded_items);
				$this->succeed();
			}
		}

		$this->fail();
	}
}
