<?php
/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Plugin 'SRU Client eID script'
  */

class tx_ddbfrontendviewer_sru_eid extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {

	/**
	 *
	 */
	public $cObj;


	/**
	 * The main method of the eID-Script
	 *
	 * @access	public
	 *
	 * @return string JSON encoded return value
	 */
	public function main() {

		$this->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');

		$this->extKey = 'ddb_frontend_viewer';

		$this->scriptRelPath = 'plugins/sru/class.tx_ddbfrontendviewer_sru_eid.php';

		$this->LLkey = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('L') ? \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('L') : 'default';

		$this->pi_loadLL();

		$url = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('sru') . '?operation=searchRetrieve&version=1.2&startRecord=1&maximumRecords=10&amp;recordSchema=dfg-viewer/page&amp;query=' . urlencode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('q'));

		// make request to SRU service
		$xmlData = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($url);

		$sruXML = simplexml_load_string($xmlData);

		if ($sruXML !== FALSE) {

			// the result may be a valid <srw:searchRetrieveResponse> or some HTML code

			$sruResponse = $sruXML->xpath('/srw:searchRetrieveResponse');

			if ($sruResponse === FALSE) {

				$results['error'] =  $this->pi_getLL('label.noresults') . ' ' . \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('q') ;

			} else {

				$sruRecords = $sruXML->xpath('/srw:searchRetrieveResponse/srw:records/srw:record');

				if ($sruRecords === FALSE || empty($sruRecords) ) {

					$results['error'] =  $this->pi_getLL('label.noresults') . ' ' . \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('q') ;

				}

				foreach ($sruRecords as $id => $record) {

					$fullTextHit = $record->xpath('//srw:recordData');

					$pageAttributes = '';

					foreach($fullTextHit[$id]->children('http://dfg-viewer.de/')->page->attributes() as $key => $val) {

						$pageAttributes[$key] = $val;

					}

					$hitFound = array();

					// there may be multiple hits on a page per search query
					foreach ($fullTextHit[$id]->children('http://dfg-viewer.de/')->page->fulltexthit as $hit) {

						$hitAttributes = array();

						foreach ($hit->attributes() as $key => $val) {

							$hitAttributes[$key] = $val;

						}

						$hitFound[] = array('text' => $hit->span, 'attributes' => $hitAttributes);
					}

					$page = (string)$pageAttributes['id'];

					// get METS file of search hit
					$parentUrl = (string)$fullTextHit[$id]->children('http://dfg-viewer.de/')->page->parent->attributes()->url;

					// unset $hightlightParams but make sure, it's an array()
					$highlightParams = array();

					// get highlight boxes for all results of a page
					foreach ($hitFound as $key => $hit) {

						$highlightField = $hit['attributes']['x1'] . ',' . $hit['attributes']['y1'] . ',' . $hit['attributes']['x2'] . ',' . $hit['attributes']['y2'];

						if (!in_array($highlightField, $highlightParams)) {

							$highlightParams[] = $highlightField;

						}

					}

					foreach ($hitFound as $key => $hit) {

						unset($spanPreview);

						unset($spanText);

						if (!empty($hit['attributes']['preview'])) {

							$spanPreview = '<span class="sru-preview"><img src="'.$hit['attributes']['preview'].'"></span>';

						}

						if (is_object($hit['text'])) {

							$spanText = '<span class="sru-textsnippet">';

							foreach ($hit['text'] as $key => $text) {

								if ($text->attributes()->class[0] == 'highlight') {

									$spanText .= '<span class="highlight">'.$text.'</span>';

								} else {

									$spanText .= $text;

								}

							}

							$spanText .= '</span>';

						}

						$origImageParams = '0,' . $pageAttributes['width'] . ',' . $pageAttributes ['height'];

						unset($data);

						$data['link'] = $parentUrl;
						$data['page'] = $page;
						$data['text'] = $spanText;
						$data['previewImage'] = $spanPreview;
						$data['previewText'] = $spanText;
						$data['origImage'] = $origImageParams;
						$data['highlight'] = urlencode(serialize($highlightParams));

						$results[] = $data;
					}
				}

			}

		} else {

			$results['error'] =  $this->pi_getLL('label.noresults') . ' ' . \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('q') ;

		}

		echo json_encode($results);

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ddb_frontend_viewer/plugins/search/class.tx_ddbfrontendviewer_sru_eid.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ddb_frontend_viewer/plugins/search/class.tx_ddbfrontendviewer_sru_eid.php']);
}

$cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_ddbfrontendviewer_sru_eid');

$cObj->main();
