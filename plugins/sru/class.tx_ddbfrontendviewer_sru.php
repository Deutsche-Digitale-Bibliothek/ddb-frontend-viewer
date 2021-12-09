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
 * Plugin 'SRU Client'
 *
 */

class tx_ddbfrontendviewer_sru extends tx_dlf_plugin {

	public $extKey = 'ddb_frontend_viewer';

	public $scriptRelPath = 'plugins/sru/class.tx_ddbfrontendviewer_sru.php';

	/**
	 * The main method of the PlugIn
	 *
	 * @access	public
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 *
	 * @return	string		The content that is displayed on the website
	 */
	public function main($content, $conf) {

		$this->init($conf);

		// Load current document.
		$this->loadDocument();

		if ($this->doc === NULL) {

			// Quit without doing anything if required variables are not set.
			return $content;

		}

		// Get digital provenance information.
		$digiProv = $this->doc->mets->xpath('//mets:amdSec/mets:digiprovMD/mets:mdWrap[@OTHERMDTYPE="DVLINKS"]/mets:xmlData');

		if ($digiProv) {

			$links = $digiProv[0]->children('http://dfg-viewer.de/')->links;

			// if no children found with given namespace, skip the following section
			if ($links) {

				if ($links->sru) {

					$sruLink = htmlspecialchars(trim((string) $links->sru));

				}

			}

		}

		if (empty($sruLink)) {

			// Quit without doing anything if required variables are not set.
			return $content;

		}

		// Load template file.
		if (!empty($this->conf['templateFile'])) {

			$this->template = $this->cObj->getSubpart($this->cObj->fileResource($this->conf['templateFile']), '###TEMPLATE###');

		} else {

			$this->template = $this->cObj->getSubpart($this->cObj->fileResource('EXT:ddb_frontend_viewer/plugins/sru/template.tmpl'), '###TEMPLATE###');

		}

		$this->addSearchFormJS();

		$this->addSruResultsJS();

		// Configure @action URL for form.
		$linkConf = array (
			'parameter' => $GLOBALS['TSFE']->id,
			'forceAbsoluteUrl' => 1
		);

		// Fill markers.
		$markerArray = array (
			'###ACTION_URL###' => $this->cObj->typoLink_URL($linkConf),
			'###LABEL_QUERY###' => $this->pi_getLL('label.query'),
			'###LABEL_DELETE_SEARCH###' => $this->pi_getLL('label.delete_search'),
			'###LABEL_LOADING###' => $this->pi_getLL('label.loading'),
			'###SRU_URL###' => $sruLink,
			'###LANG_ID###' => $this->LLkey,
			'###LABEL_SUBMIT###' => $this->pi_getLL('label.submit'),
			'###FIELD_QUERY###' => $this->prefixId.'[query]',
			'###QUERY###' => htmlspecialchars($lastQuery),
			'###CURRENT_DOCUMENT###' => $this->doc->location,
		);

		// Display search form.
		$content .= $this->cObj->substituteSubpart($this->cObj->substituteMarkerArray($this->template, $markerArray), '###EXT_SEARCH_ENTRY###', $extendedSearch);

		return $this->pi_wrapInBaseClass($content);

	}

	/**
	 * Adds the JS files necessary for search form
	 *
	 * @access	protected
	 *
	 * @return	void
	 */
	protected function addSearchFormJS() {

		// Add javascript to page header.
        $GLOBALS['TSFE']->additionalHeaderData[$this->prefixId.'_sru'] = '<script type="text/javascript" src="'.\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath($this->extKey).'plugins/sru/tx_ddbfrontendviewer_sru.js"></script>';

	}

	/**
	 * Adds SRU Search result javascript
	 *
	 * @access	protected
	 *
	 * @return	string		Viewer script tags ready for output
	 */

	protected function addSruResultsJS() {


		if (!empty($this->piVars['highlight']) && !empty($this->piVars['origimage'])) {

			$highlight = unserialize(urldecode($this->piVars['highlight']));
			$origImage = $this->piVars['origimage'];

			// Add SRU Results if any
			$javascriptFooter = '
			<script type="text/javascript">$(window).load(function(){';

			foreach ($highlight as $field) {
				$javascriptFooter .= 'tx_dlf_viewer.addHighlightField(['.$field.'],'.$origImage.');';
			}

			$javascriptFooter .= '
			})</script>';

			$GLOBALS['TSFE']->additionalFooterData['tx-ddbfrontendviewer-footer'] .= $javascriptFooter;
		}

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ddb_frontend_viewer/plugins/sru/class.tx_ddbfrontendviewer_sru.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ddb_frontend_viewer/plugins/sru/class.tx_ddbfrontendviewer_sru.php']);
}
