<?php

/**
 * 
 */
class S_Sitemaps_Handler_Ajax_TaxonomyHandler extends S_Sitemaps_Handler_Ajax_WPContentHandler
{
	public function __construct(S_Sitemaps_Provider $provider)
	{
		if (! ($provider instanceof S_Sitemaps_Provider_Taxonomy)) {
			throw new InvalidArgumentException(sprintf(
				'expect a provider of type "%s", type "%s" provided.',
				'S_Sitemaps_Provider_Taxonomy',
				get_class($provider)
			));
		}

		parent::__construct($provider);
	}

	/**
	 * Get taxonomies action
	 *
	 * Response should contain ESCAPED contents.
	 */
	public function get_taxonomies_action()
	{
		$items = array();

		if ($post_type = S_Framework_Util::get_request_var('post_type')) {
			$taxonomies = $this->provider->get_taxonomies($post_type);

			foreach ($taxonomies as $taxonomy) {
				$items[] = array(
					'name'  => esc_attr($taxonomy->name),
					'title' => esc_html($taxonomy->labels->singular_name)
				);
			}
		}

		$this->response_with($items);
	}

	/**
	 * Get terms action
	 *
	 * Response should contain UNESCAPED contents.
	 */
	public function get_terms_action()
	{
		$items = array();

		if (($taxonomy = S_Framework_Util::get_request_var('group'))
			&& ($name = S_Framework_Util::get_request_var('q'))
		) {
			$terms = $this->provider->get_terms_by_name($taxonomy, $name);

			foreach ($terms as $term) {
				$items[] = array(
					'id'    => (int) $term->term_id,
					'title' => $term->name
				);
			}
		}

		$this->response_with(array('items' => $items));
	}

	/**
	 * Get excluded terms action
	 *
	 * Response should contain ESCAPED contents
	 */
	public function get_excluded_terms_action()
	{
		$items = array();

		if (($taxonomy = S_Framework_Util::get_request_var('group'))
			&& ($excluded_items = $this->excluder->get_excluded_items($taxonomy))
		) {
			$terms = $this->provider->get_terms(
				$taxonomy, $excluded_items
			);

			foreach ($terms as $term) {
				$items[] = array(
					'id'    => (int) $term->term_id,
					'title' => esc_html($term->name)
				);
			}
		}

		$this->response_with($items);
	}
}
