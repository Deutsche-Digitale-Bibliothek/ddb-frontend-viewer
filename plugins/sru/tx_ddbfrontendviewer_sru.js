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

			var resultList = '<div class="sru-results-active-indicator"></div><ul>';

			if (data.error) {

				resultList += '<li>' + data.error + '</li>';

			} else {

				for (var i=0; i < data.length; i++) {

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
					+ 'tx_dlf[id]=' + data[i].link
					+ '&tx_dlf[origimage]=' + data[i].origImage
					+ '&tx_dlf[highlight]=' + encodeURIComponent(data[i].highlight)
					+ '&tx_dlf[page]=' + (data[i].page));

					if (data[i].previewImage) {
						resultList += '<li><a href=\"' + newlink + '\">' + data[i].previewImage + '</li>';
					}
					if (data[i].previewText) {
						resultList += '<li><a href=\"' + newlink + '\">' + data[i].previewText + '</li>';
					}
				}

			}
			resultList += '</ul>';

			$('#tx_ddbfrontendviewer-sru-results').html(resultList);

		},
		"json"
	)
	.done(function( data ) {
		$('#tx_ddbfrontendviewer-sru-results-loading').hide();
		$('#tx_ddbfrontendviewer-sru-results-clearing').show();
	});
});

// clearing button
$('#tx_ddbfrontendviewer-sru-results-clearing').click(function() {
	$('#tx_ddbfrontendviewer-sru-results ul').remove();
	$('.sru-results-active-indicator').remove();
	$('#tx_ddbfrontendviewer-sru-query').val('');
});


});
