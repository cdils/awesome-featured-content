(function( window, $, undefined ) {
	'use strict';
	function format(icon) {
		return '<span class="awesomeness"><i class="fa ' + icon.id + '"></i>' + icon.text + '</span>';
	}
	$("#widgets-right select.font-awesome").select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) { return m; }
	});
	// Make all select elements in the widget select2.
	$("#widgets-right select.awesome-select").select2({
		minimumResultsForSearch: 6
	});
	$(document).ajaxSuccess(function(e, xhr, settings) {
		var widget_id_base = 'awesome-feature';

		var format = function(){};

		if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
			format = function format(icon) {
				return '<span class="awesomeness"><i class="fa ' + icon.id + '"></i>' + icon.text + '</span>';
			};
			$("#widgets-right select.font-awesome").select2({
				formatResult: format,
				formatSelection: format,
				escapeMarkup: function(m) { return m; }
			});
		}
		// Make all select elements in the widget select2.
		$("#widgets-right select.awesome-select").select2({
			minimumResultsForSearch: 6
		});
	});
})( this, jQuery );
