<?php

/**
 * 
 */
class S_Sitemaps_Handler_Ajax_PostHandler extends S_Sitemaps_Handler_Ajax_WPContentHandler
{
	public function __construct(S_Sitemaps_Provider $provider)
	{
		if (! ($provider instanceof S_Sitemaps_Provider_Post)) {
			throw new InvalidArgumentException(sprintf(
				'expect a provider of type "%s", type "%s" provided.',
				'S_Sitemaps_Provider_Post',
				get_class($provider)
			));
		}

		parent::__construct($provider);
	}

	/**
	 * Get posts action
	 *
	 * Response should contain UNESCAPED contents.
	 */
	public function get_posts_action()
	{
		$items = array();

		if (($post_type = S_Framework_Util::get_request_var('group'))
			&& ($title = S_Framework_Util::get_request_var('q'))
		) {
			$posts = $this->provider->get_public_posts_by_title($post_type, $title);

			foreach ($posts as $post) {
				$items[] = array(
					'id'    => (int) $post->ID,
					'title' => $post->post_title
				);
			}
		}

		$this->response_with(array('items' => $items));
	}

	/**
	 * Get excluded posts action
	 *
	 * Response should contain ESCAPED contents
	 */
	public function get_excluded_posts_action()
	{
		$items = array();

		if (($post_type = S_Framework_Util::get_request_var('group'))
			&& ($excluded_items = $this->excluder->get_excluded_items($post_type))
		) {
			$posts = $this->provider->get_public_posts(
				$post_type, $excluded_items
			);

			/* @var $post WP_Post */
			foreach ($posts as $post) {
				$items[] = array(
					'id'    => (int) $post->ID,
					'title' => esc_html($post->post_title)
				);
			}
		}

		$this->response_with($items);
	}
}
