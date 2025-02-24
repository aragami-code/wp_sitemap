<?php if (!defined('ABSPATH')) { exit; } ?>

<div id="wrapper-external-pages" class="s-inline-form-wrapper s-inline-form-wrapper-full">
	<div class="s-button-group">
		<!----><button type="button" data-target="#modal-external-page"
			class="button-secondary s-button-modal"
			name="add_external_page"><?php _e('Add new page', $this->domain); ?></button>
		&nbsp;
		<button type="button" class="button-secondary s-switch-button"
			data-callback="s_button_view_external_pages_cb"
			data-target="wrapper-list-external-pages"
			data-loader="loader-external-pages"><?php _e('Show/Hide external pages', $this->domain); ?></button>
		<span id="loader-external-pages" style="display: none;"><em><?php _e('... loading', $this->domain); ?></em></span>
	</div>

	<div id="wrapper-list-external-pages" class="s-no-display">
		<table id="table-external-pages"
			class="wp-list-table widefat striped hover s-table s-table-inline"
			border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th><?php _e('Url', $this->domain); ?></th>
					<th><?php _e('Change frequency', $this->domain); ?></th>
					<th><?php _e('Priority', $this->domain); ?></th>
					<th><?php _e('Last modified', $this->domain); ?></th>
					<th><?php _e('Actions', $this->domain); ?></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
