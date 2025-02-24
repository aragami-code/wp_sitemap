<?php

if (!defined('ABSPATH')) { exit; }

// r4 2015-12-15
// merge google news settings into extensions settings when needed
if (! $this->is_option_key_valid(S_MB_GOOGLE_NEWS)) {
	return;
}

$this->update_some_options(S_MB_EXTENSIONS, get_option(S_MB_GOOGLE_NEWS));
