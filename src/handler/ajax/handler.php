<?php

/**
 */
abstract class S_Sitemaps_Handler_AjaxHandler
{
	/**
	 * @var BWP_WP_Bridge
	 */
	protected $bridge;

	protected function response_with(array $data)
	{
		@header('Content-Type: application/json');

		echo json_encode($data);

		exit;
	}

	protected function fail()
	{
		echo 0; exit;
	}

	protected function succeed()
	{
		echo 1; exit;
	}
}
