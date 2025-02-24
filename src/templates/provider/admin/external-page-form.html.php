<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
	// default form data
	$page = isset($data['page']) ? $data['page'] : array();

	$page = array_merge(array(
		'frequency'     => 'auto',
		'priority'      => 1.0,
		'url'           => null,
		'last_modified' => null
	), $page);
?>

<form action="" method="POST" accept-charset="utf-8">
	<div class="s-form-group">
		<label class="s-label-required" for="external-page-url"><?php _e('Absolute URL to page', $this->domain); ?></label>
		<input class="s-form-control s-popover-focus" type="text" name="url"
			data-content="<?php _e('Each page must have a unique URL, '
				. 'so if you provide an existing URL, '
				. 'the page with that URL will be updated with new data provided here.', $this->domain); ?>"
			data-placement="auto bottom"
			id="external-page-url" value="<?php esc_attr_e($page['url']) ?>" />
	</div>

	<div class="s-form-group s-form-group-sm">
		<label for="external-page-frequency"><?php _e('Change frequency', $this->domain); ?></label>
		<select name="frequency" id="external-page-frequency">
			<option value="auto"><?php _e('Calculate using "Last modified"', $this->domain); ?></option>
<?php foreach ($data['frequencies'] as $label => $value) : ?>
			<option value="<?php esc_attr_e($value); ?>" <?php selected($page['frequency'], $value); ?>><?php echo esc_html($label); ?></option>
<?php endforeach; ?>
		</select>
	</div>

	<div class="s-form-group s-form-group-xs">
		<label for="external-page-priority"><?php _e('Priority', $this->domain); ?></label>
		<select id="external-page-priority" name="priority">
<?php foreach ($data['priorities'] as $label => $value) : ?>
			<option value="<?php esc_attr_e($value); ?>" <?php selected($page['priority'], $value); ?>><?php echo esc_html($label); ?></option>
<?php endforeach; ?>
		</select>
	</div>

	<div class="s-form-group s-form-group-sm">
		<label for="external-page-last-modified"><?php _e('Last modified (time is optional)', $this->domain); ?></label>
		<input class="s-form-control s-form-control-with-icon s-datepicker"
			type="text" name="last_modified"
			id="external-page-last-modified" value="<?php esc_attr_e($page['last_modified']) ?>" />
		<span class="dashicons dashicons-calendar s-form-control-icon"
			title="<?php _e('Click to open a calendar', $this->domain); ?>"></span>
	</div>

	<span class="s-form-help-block s-form-help-block-last">
		<strong><?php _e('Important', $this->domain); ?></strong>:
		<?php printf(__('Please specify "Last modified" in your <a href="%s" target="_blank">local timezone</a>.', $this->domain), admin_url('options-general.php#timezone_string')); ?>
	</span>

	<input type="hidden" name="action" value="s-mb-submit-external-page" />
	<input type="hidden" name="_ajax_nonce" value="<?php echo wp_create_nonce('s_mb_manage_external_page'); ?>" />
</form>
