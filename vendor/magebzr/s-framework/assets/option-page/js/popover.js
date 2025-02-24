/*global jQuery,ajaxurl*/
jQuery(function($) {
	'use strict';

	var get_html_content = function($t) {
		var id = $t.data('contentId');
		if (id) {
			return $('#' + id).html();
		}
	};

	var get_placement = function(p, t) {
		if ($(t).data('placement')) {
			return $(t).data('placement');
		}

		return 'auto top';
	};

	// need to use different wrapper (#wpcontent here and .wrap below) to
	// register popovers for hover and focus event, not sure if this is a bug
	$('#wpcontent').popover({
		selector: '.s-popover-hover',
		trigger: 'hover',
		viewport: {
			selector: '#wpcontent',
			padding: 10
		},
		placement: get_placement,
		html: true,
		content: get_html_content($(this))
	});

	$('.wrap').popover({
		selector: '.s-popover-focus',
		trigger: 'focus',
		viewport: {
			selector: '#wpcontent',
			padding: 10
		},
		placement: get_placement,
		html: true,
		content: get_html_content($(this)),
	});

	$('.wrap')
		.on('click', '.s-popover-switch', function(e) {
			e.preventDefault();

			var $t = $(this);

			if (! $t.data('bs.popover')) {
				$t.popover({
					trigger: 'manual',
					viewport: {
						selector: '#wpcontent',
						padding: 10
					},
					placement: get_placement,
					html: true,
					content: get_html_content($t)
				});
			}

			$t.popover('toggle');
		})
		.on('click', function(e) {
			var $t = $(e.target);

			// clicking on the popover does nothing
			if ($t.is('.s-popover') || $t.parents('.s-popover').length > 0) {
				return;
			}

			// hide all popovers if the current target is not a popover switch
			// itself, or it has a parent that is a popover switch
			if (! $t.is('.s-popover-switch') && ! $t.is('.s-popover-focus')
				&& ! $t.parents('.s-popover-switch').length > 0 && ! $t.parents('.s-popover-focus').length > 0
			) {
				$('.s-popover-switch').popover('hide');
			}
		})
		.on('show.bs.popover', '.s-popover-switch', function(e) {
			var $t = $(this);
			var $p = $t.data('bs.popover').$tip;
			var cb = $t.data('submitCallback');

			// register events for elements inside a popover, do this only once
			$p.on('click', '.s-popover-close', function(e) {
				e.preventDefault();
				$t.popover('hide');
			});

			$p.on('click', '.s-popover-submit', function(e) {
				e.preventDefault();

				// use the callback attached to the triggering element, or the popover
				// triggering element when appropriate
				var btn_cb = $(this).data('submitCallback');
				if (typeof btn_cb !== 'undefined') {
					window[btn_cb]($, $(this), $t, $p);
				} else if (typeof cb !== 'undefined') {
					window[cb]($, $(this), $t, $p);
				}

				$t.popover('hide');
			});
		})
		.on('hide.bs.popover', '.s-popover-switch', function(e) {
			var $t = $(this);
			var $p = $t.data('bs.popover').$tip;

			// unregister click events
			$p.off('click', '.s-popover-close');
			$p.off('click', '.s-popover-submit');
		})
	;

	$('.wrap').on('show.bs.popover', '.s-popover-hover, .s-popover-focus, .s-popover-switch', function() {
		var $t = $(this);
		var popover_class = $t.data('popoverClass');

		if (! popover_class) {
			return;
		}

		$t
			.data('bs.popover').$tip
			.addClass(popover_class);
	});
});
