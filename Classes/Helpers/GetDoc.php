<?php
namespace Slub\DdbFrontendViewer\Helpers;

/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Core\Utility\GeneralUtility;

class GetDoc
{
    public $extKey = 'ddb_frontend_viewer';

  /**
  	 * This holds the current document
  	 *
  	 * @var	tx_dlf_document
  	 * @access protected
  	 */
  	protected $doc;

  /**
   * Get page's download link
   *
   * @access	public
   *
   * @param	integer	$pagenumber:The current page numbert
   *
   * @return	string: The left and right download url
   */
  public function getPageLink($pagenumber)
  {

    if (!$this->init()) {
      return '';
    }

    $details = $this->doc->physicalPagesInfo[$this->doc->physicalPages[$pagenumber]];
		$file = $details['files']['DOWNLOAD'];

		if (!empty($file)) {

			$pageLink = $this->doc->getFileLocation($file);

    }

    return $pageLink;
  }

  /**
   * Get work's download link
   *
   * @access	public
   *
   * @return	string: The left and right download url
   */
  public function getWorkLink()
  {

    if (!$this->init()) {
      return '';
    }

    // Get work link.
  		if (!empty($this->doc->physicalPagesInfo[$this->doc->physicalPages[0]]['files']['DOWNLOAD'])) {

  			$workLink = $this->doc->getFileLocation($this->doc->physicalPagesInfo[$this->doc->physicalPages[0]]['files']['DOWNLOAD']);

  		} else {

  			$details = $this->doc->getLogicalStructure($this->doc->toplevelId);

  			if (!empty($details['files']['DOWNLOAD'])) {

  				$workLink = $this->doc->getFileLocation($details['files']['DOWNLOAD']);

  			}

  		}

      return $workLink;
  }

  /**
   * get xpath result
   *
   * @access	public
   *
   * @param	string		$content: The PlugIn content
   *
   * @return	string		The content that is displayed on the website
   */
  public function getXpath($xpath)
  {
    if (!$this->init()) {
      return '';
    }
      return $this->doc->mets->xpath($xpath);
  }

  /**
     * Initialize and load the document
     *
     * @access	protected
     *
     * @return	boolean
     */
    protected function init()
    {
      // Load current document.
      $this->loadDocument();

      if ($this->doc === null) {

        // Quit without doing anything if required variables are not set.
        return null;

      }

      $this->doc->mets->registerXPathNamespace('mets', 'http://www.loc.gov/METS/');
      $this->doc->mets->registerXPathNamespace('mods', 'http://www.loc.gov/mods/v3');
      $this->doc->mets->registerXPathNamespace('dv', 'http://dfg-viewer.de/');

      return true;
    }

  /**
     * Loads the current document into $this->doc
     *
     * @access	protected
     *
     * @return	void
     */
    protected function loadDocument()
    {
        $piVarsDDB = GeneralUtility::_GPmerged('tx_ddbfrontendviewer');
        $piVars = GeneralUtility::_GPmerged('tx_dlf');

        if (!empty($piVarsDDB['id'])) {
          $piVars['id'] = 'https://api.deutsche-digitale-bibliothek.de/items/' . $piVarsDDB['id'] . '/source';
        }

        // Check for required variable.
        if (!empty($piVars['id'])) {

            // Get instance of tx_dlf_document.
            $this->doc =& \tx_dlf_document::getInstance($piVars['id'], 0);

            if (!$this->doc->ready) {

                // Destroy the incomplete object.
                $this->doc = null;

                if (TYPO3_DLOG) {
                    \TYPO3\CMS\Core\Utility\GeneralUtility::devLog('[tx_dlf_plugin->loadDocument()] Failed to load document with UID "'.$piVars['id'].'"', $this->extKey, SYSLOG_SEVERITY_ERROR);
                }
            } else {

                // Set configuration PID.
                $this->doc->cPid = $this->conf['pages'];
            }
        } else {
            if (TYPO3_DLOG) {
                \TYPO3\CMS\Core\Utility\GeneralUtility::devLog('[tx_dlf_plugin->loadDocument()] Failed to load document with record ID "'.$this->piVars['recordId'].'"', $this->extKey, SYSLOG_SEVERITY_ERROR);
            }
        }
    }
}
