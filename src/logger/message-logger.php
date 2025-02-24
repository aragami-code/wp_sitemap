<?php

/**

 */
class S_Sitemaps_Logger_MessageLogger extends S_Sitemaps_Logger
{
	/**
	 * {@inheritDoc}
	 */
	public function log(S_Sitemaps_Logger_LogItem $item)
	{
		if (!($item instanceof S_Sitemaps_Logger_Message_LogItem)) {
			throw new InvalidArgumentException(sprintf('expect an item of type S_Sitemaps_Logger_Message_LogItem, "%s" provded.', get_class($item)));
		}

		parent::log($item);
	}
}
