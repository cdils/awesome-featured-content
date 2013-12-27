jQuery(document).ready(function($) {
	function format(icon) {
		return '<span class="awesomeness"><i class="fa ' + icon.id + '"></i>' + icon.text + '</span>';
	}
	$("#widgets-right select.font-awesome").select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) { return m; }
	});
	$(document).ajaxSuccess(function(e, xhr, settings) {
		var widget_id_base = 'awesome-feature';

		if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
			function format(icon) {
				return '<span class="awesomeness"><i class="fa ' + icon.id + '"></i>' + icon.text + '</span>';
			}
			$("#widgets-right select.font-awesome").select2({
				formatResult: format,
				formatSelection: format,
				escapeMarkup: function(m) { return m; }
			});
		}
	});
});