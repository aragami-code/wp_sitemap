<?php if (!defined('ABSPATH')) { exit; } ?>

<div class="s-modal" id="modal-external-page">
	<div class="s-modal-dialog">
		<div class="s-modal-content">
			<div class="s-modal-header">
				<button type="button" class="s-close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="s-modal-title"><?php _e('Add/Update an external page', $this->domain); ?></h4>
			</div>
			<div class="s-modal-body">
				<?php echo $this->get_template_contents(
					'templates/provider/admin/external-page-form.html.php',
					array_merge($data, array(
					))
				); ?>
			</div>
			<div class="s-modal-footer">
				<span class="s-modal-message text-primary" style="display: none"
					data-working-text="<?php _e('working ...', $this->domain); ?>"></span>

				<button type="button" class="s-btn s-btn-default button-secondary"
					data-dismiss="modal"><?php _e('Close', $this->domain); ?></button>

				<button type="button" class="s-btn s-btn-default button-secondary s-button-modal-reset">
					<?php _e('Reset', $this->domain); ?>
				</button>

				<button type="button"
					data-ajax-callback="s_button_add_new_external_page_cb"
					class="s-btn s-btn-primary button-primary s-button-modal-submit">
					<?php _e('Save Changes', $this->domain); ?>
				</button>
			</div>
		</div>
	</div>
</div>
