/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

$(document).ready(function() {

	$("#tx_ddbfrontendviewer-sru-form").submit(function( event ) {

		// Stop form from submitting normally
		event.preventDefault();

		$('#tx_ddbfrontendviewer-sru-results-loading').show();
		$('#tx_ddbfrontendviewer-sru-results-clearing').hide();
		$('#tx_ddbfrontendviewer-sru-results ul').remove();

		// Send the data using post
		$.post(
			window.location.pathname,
			{
				eID: "tx_ddbfrontendviewer_sru_eid",
				q: $( "input[name='tx_dlf[query]']" ).val(),
				L: $( "input[name='tx_ddbfrontendviewer[L]']" ).val(),
				id: $( "input[name='tx_ddbfrontendviewer[id]']" ).val(),
				sru: $( "input[name='tx_ddbfrontendviewer[sru]']" ).val(),
				action: $( "input[name='tx_ddbfrontendviewer[action]']" ).val(),
			},
			function(data) {

				var resultList = '<div class="sru-results-active-indicator"></div>';

				if (data.error) {

					resultList += '<ul><li>' + data.error + '</li></ul>';

				} else {

					var dataSorted;
					dataSorted = data.sort(function(a, b){return a.page > b.page});

					var pages = [];

					var previewText = '';

					var outputTextLink = {};
					var outputImageLink = {};

					$.each( dataSorted, function( index, value ){

						if (pages.indexOf(value.page) == -1) {
								previewText = '';
								pages.push(value.page);
						}

							if (previewText.length > 1) {
								previewText += ' [...] ' + value.previewText;
							} else {
								previewText = value.previewText;
							}

							var link_current = $(location).attr('href');

							var link_base = link_current.substring(0, link_current.indexOf('?'));
							var link_params = link_current.substring(link_base.length + 1, link_current.length);

							var link_id = link_params.match(/id=(\d)*/g);

							if (link_id) {

								link_params = link_id + '&';

							} else {

								link_params = '&';

							}

							var newlink = link_base + '?' + (link_params
							+ 'tx_dlf[id]=' + value.link
							+ '&tx_dlf[origimage]=' + value.origImage
							+ '&tx_dlf[highlight]=' + encodeURIComponent(value.highlight)
							+ '&tx_dlf[page]=' + (value.page))
							+ '&tx_dlf[query]=' + query;

							if (value.previewImage && outputImageLink[value.page] === undefined) {
								outputImageLink[value.page] = '<a href=\"' + newlink + '\">' + value.previewImage + '</a>';
							}
							if (value.previewText) {
								outputTextLink[value.page] = '<a href=\"' + newlink + '\">' + previewText + '</a>';
							}

						});

						var output = '';

						$.each(pages, function( index, value ){

							output += '<ul>';
							var page = $('ul#sru-' + value + ' li.page').text();
							if ($.isNumeric(value) === false) {
								var label = $('ul#sru-' + value + ' li.label').text();
								if (label.length == 0) {
									label = page;
								}
							} else {
								label = value;
							}
							var pageCurrent = $('ul#sru-' + value + ' li.current').text();
							var active = (page == pageCurrent) ? 'active' : '';
							output += '<li><h3 class="'+ active +'">Seite ' + label + '</h3></li>';
							output += '<li>' + outputImageLink[value] + '</li>';
							output += '<li>' + outputTextLink[value] + '</li>';
							output += '</ul>';

						});

				}
				$('#tx_ddbfrontendviewer-sru-results').html(output);

			},
			"json"
		)
		.done(function( data ) {
			$('#tx_ddbfrontendviewer-sru-results-loading').hide();
			$('#tx_ddbfrontendviewer-sru-results-clearing').show();
		});
	});

	// If we have a search query show the search tab and trigger a search
	var query = getUrlParameter('tx_dlf[query]');
	if(query) {
		$(".tab-search").click();
		$("input[name='tx_dlf[query]']" ).val(query);
 		$("#tx_ddbfrontendviewer-sru-form input[type='submit']").click();
	}

	// clearing button
	$('#tx_ddbfrontendviewer-sru-results-clearing').click(function() {
		$('.sru-results-active-indicator').remove();
		$('#tx_ddbfrontendviewer-sru-query').val('');
	});
});


var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
};
