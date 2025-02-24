/* global jQuery,ajaxurl,s_gxs */
function s_reset_exclude_form($, $t, type) {
	// init advanced dropdown
	$('#select-exclude-' + type).select2({
			ajax: {
				url: ajaxurl,
				dataType: 'json',
				data: function(params) {
					return {
						action: 's-mb-get-' + type,
						group: $t.val(),
						q: params.term
					};
				},
				processResults: function(data) {
					return {
						results: data.items
					};
				},
			},
			minimumInputLength: 2,
			templateResult: function(items) {
				return items.title;
			},
			templateSelection: function(selection) {
				return selection.title;
			}
	});

	// reset selected items
	$('#select-exclude-' + type).val(null).trigger('change');

	// reset datatable if needed
	if ($.fn.dataTable.isDataTable('#table-excluded-' + type)) {
		$('#table-excluded-' + type).DataTable().clear().destroy();
		$('#wrapper-excluded-' + type).addClass('s-no-display');
	}
}

function s_select_exclude_post_cb($, $t) {
	s_reset_exclude_form($, $t, 'posts');
}

function s_select_exclude_term_cb($, $t) {
	s_reset_exclude_form($, $t, 'terms');
}

function s_add_rows_to_table(tbl, r) {
	tbl
		.columns.adjust()
		.clear()
		.rows.add(r)
		.draw();
}

function s_add_row_to_table(tbl, row) {
	tbl
		.columns.adjust()
		.row.add(row)
		.draw();
}

function s_remove_table_row(tbl, row) {
	tbl
		.row(row)
		.remove()
		.draw(false);
}

function s_view_excluded_items($, $t, hide_loader_cb, type) {
	var select_id = type == 'posts' ? 'select_exclude_post_type' : 'select_exclude_taxonomy';

	// init datatable if not already done so
	if (! $.fn.dataTable.isDataTable('#table-excluded-' + type)) {
		$.get(ajaxurl, {
			action: 's-mb-get-excluded-' + type,
			group: $('#' + select_id).val()
		}, function(r) {
			var tbl = $('#table-excluded-' + type).DataTable({
				deferRender: true,
				autoWidth: false,
				columns: [{
					data: 'id',
					width: '15%'
				}, {
					data: 'title',
					width: '65%'
				}, {
					data: 'id',
					render: function(data) {
						return '<button type="button" '
							+ 'data-item-id="' + data + '" '
							+ 'title="' + s_mb.text.exclude_items.remove_title + '" '
							+ 'class="button-secondary s-button s-ua-remove">'
							+ '<span class="dashicons dashicons-trash"></span>'
							+ '</button>'
						;
					},
					orderable: false,
					width: '20%'
				}]
			});

			s_add_rows_to_table(tbl, r);
			hide_loader_cb();
		}, 'json');
	} else {
		// hide loader immediately
		hide_loader_cb();
	}
}

function s_button_view_excluded_posts_cb($, $t, hide_loader_cb) {
	s_view_excluded_items($, $t, hide_loader_cb, 'posts');
}

function s_button_view_excluded_terms_cb($, $t, hide_loader_cb) {
	s_view_excluded_items($, $t, hide_loader_cb, 'terms');
}

function s_button_add_new_external_page_cb($, r) {
	// no data, nothing to do
	if (! r.data) {
		return;
	}

	// no table, nothing to do
	if (! $.fn.dataTable.isDataTable('#table-external-pages')) {
		return;
	}

	var tbl = $('#table-external-pages').DataTable();

	// new page, add new row
	if (! r.updated) {
		s_add_row_to_table(tbl, r.data);
	} else {
		// update existing row
		tbl
			.row(function(i, data, node) {
				return data.url === r.data.url;
			})
			.data(r.data);
	}
}

function s_button_view_external_pages_cb($, $t, hide_loader_cb) {
	// init datatable if not already done so
	if (! $.fn.dataTable.isDataTable('#table-external-pages')) {
		$.get(ajaxurl, {
				action: 's-mb-get-external-pages'
		}, function(r) {
			var tbl = $('#table-external-pages').DataTable({
				deferRender: true,
				autoWidth: false,
				order: [
					[3, 'desc']
				],
				columns: [{
					data: 'url',
					width: '55%',
					render: function(data) {
						return '<a target="_blank" href="'
							+ data + '">'
							+ data + '</a>';
					}
				}, {
					data: 'frequency'
				}, {
					data: 'priority'
				}, {
					data: 'last_modified'
				}, {
					data: 'url',
					render: function(data) {
						// edit
						return '<button type="button" '
							+ 'data-item-id="' + data + '" '
							+ 'data-toggle="modal"'
							+ 'data-target="#modal-external-page"'
							+ 'title="' + s_mb.text.external_pages.edit_title + '" '
							+ 'class="button-secondary s-button s-ua-edit">'
							+ '<span class="dashicons dashicons-edit"></span>'
							+ '</button>'
							+ ' '
							// remove
							+ '<button type="button" '
							+ 'data-item-id="' + data + '" '
							+ 'title="' + s_mb.text.external_pages.remove_title + '" '
							+ 'class="button-secondary s-button s-ua-remove">'
							+ '<span class="dashicons dashicons-trash"></span>'
							+ '</button>'
						;
					},
					orderable: false,
					width: '10%'
				}]
			});

			s_add_rows_to_table(tbl, r);
			hide_loader_cb();
		}, 'json');
	} else {
		// hide loader immediately
		hide_loader_cb();
	}
}

function s_remove_excluded_item($, $t, group, type) {
	s_bootbox.confirm(s_mb.text.exclude_items.remove_warning, function() {
		jQuery.post(ajaxurl, {
			action: 's-mb-remove-excluded-' + type,
			_ajax_nonce: s_mb.nonce.remove_excluded_item,
			group: group,
			id: $t.data('itemId')
		}, function(r) {
			if (r != 1) {
				return;
			}

			if ($.fn.dataTable.isDataTable('#table-excluded-' + type + 's')) {
				s_remove_table_row($('#table-excluded-' + type + 's').DataTable(), $t.parents('tr'));
			}
		});
	});
}

jQuery(function($){
	"use strict";

	// init datetime input mask
	$('#external-page-last-modified').inputmask('y-m-d[ h:s]', {
		placeholder: 'yyyy-mm-dd hh:mm',
		showMaskOnHover: false,
		removeMaskOnSubmit: true
	});

	// remove an excluded post
	$('#table-excluded-posts').on('click', '.s-ua-remove', function(e) {
		e.preventDefault();
		s_remove_excluded_item($, $(this), $('#select_exclude_post_type').val(), 'post');
	});

	// remove an excluded term
	$('#table-excluded-terms').on('click', '.s-ua-remove', function(e) {
		e.preventDefault();
		s_remove_excluded_item($, $(this), $('#select_exclude_taxonomy').val(), 'term');
	});

	// remove an external page
	$('#table-external-pages').on('click', '.s-ua-remove', function(e) {
		e.preventDefault();

		var $t = $(this);

		s_bootbox.confirm(s_mb.text.external_pages.remove_warning, function() {
			jQuery.post(ajaxurl, {
				action: 's-mb-remove-external-page',
				_ajax_nonce: s_mb.nonce.remove_external_page,
				url: $t.data('itemId')
			}, function(r) {
				if (r != 1) {
					return;
				}

				if ($.fn.dataTable.isDataTable('#table-external-pages')) {
					s_remove_table_row($('#table-external-pages').DataTable(), $t.parents('tr'));
				}
			});
		});
	});

	// edit an external page
	$('#modal-external-page').on('show.bs.modal', function(e, v) {
		var $btn  = $(e.relatedTarget);
		var $form = $(this).find('form');

		// not an edit action, nothing to do
		if (!$btn.is('.s-ua-edit')) {
			return;
		}

		// no table, nothing to do
		if (! $.fn.dataTable.isDataTable('#table-external-pages')) {
			return;
		}

		var tbl = $('#table-external-pages').DataTable();
		var data = tbl.row($btn.parents('tr')).data();

		$form.find(':input[type!="hidden"]').val(function () {
			return data[this.name];
		});
	})
});
