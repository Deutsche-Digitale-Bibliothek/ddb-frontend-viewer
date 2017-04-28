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
use TYPO3\CMS\Core\Utility\ArrayUtility;

class RealUrlConfiguration
{
  /**
   * Add Kitodo specials to realurl configuration
   *
   * @access	public
   *
   * @param   array   $params Default configuration
   * @param   AutomaticConfigurator  $pObj   Parent object
   *
   * @return	string: The left and right download url
   */
  public function addKitodoConfig($params, &$pObj)
  {
    return ArrayUtility::mergeRecursiveWithOverrule ($params['config']['_DEFAULT'], [
      'postVarSets' => [
        '_DEFAULT' => [
          'dlf' => [
            'id' => [ 'GETvar' => 'tx_dlf[id]' ],
            'page' => [ 'GETvar' => 'tx_dlf[page]' ],
            'double' => [ 'GETvar' => 'tx_dlf[double]' ],
            'pagegrid' => [ 'GETvar' => 'tx_dlf[pagegrid]' ]
          ],
          'ddb' => [
            'id' => [ 'GETvar' => 'tx_ddbfrontendviewer[id]' ],
            'page' => [ 'GETvar' => 'tx_dlf[page]' ],
            'double' => [ 'GETvar' => 'tx_dlf[double]' ],
            'pagegrid' => [ 'GETvar' => 'tx_dlf[pagegrid]' ]
          ]
        ]
      ]
    ]);
  }
}
