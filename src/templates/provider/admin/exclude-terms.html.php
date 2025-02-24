<?php if (!defined('ABSPATH')) { exit; } ?>

<div id="wrapper-exclude-terms" class="s-inline-form-wrapper s-inline-form-wrapper-md s-no-display s-clear">
	<div class="s-form-group s-form-group-first">
		<select data-placeholder="<?php _e('Search for terms to exclude', $this->domain); ?>"
			class="s-typeahead" name="select-exclude-terms[]" id="select-exclude-terms"
			multiple>
		</select>
	</div>

	<div class="s-button-group">
		<button type="submit" class="button-primary" name="exclude_terms"><?php _e('Exclude selected items', $this->domain); ?></button>
		&nbsp;
		<button type="button" class="button-secondary s-switch-button"
			data-callback="s_button_view_excluded_terms_cb"
			data-target="wrapper-excluded-terms"
			data-loader="loader-excluded-terms"><?php _e('Show/Hide excluded items', $this->domain); ?></button>
		<span id="loader-excluded-terms" style="display: none;"><em><?php _e('... loading', $this->domain); ?></em></span>
	</div>

	<div id="wrapper-excluded-terms" class="s-no-display">
		<table id="table-excluded-terms"
			class="wp-list-table widefat striped hover s-table s-table-inline"
			border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th><?php _e('ID'); ?></th>
					<th><?php _ex('Name', 'term name', $this->domain); ?></th>
					<th><?php _e('Remove', $this->domain); ?></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
