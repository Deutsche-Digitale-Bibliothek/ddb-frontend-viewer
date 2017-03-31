<?php
namespace Slub\DdbFrontendViewer\ViewHelpers;

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

/**
 * ViewHelper to get page and work download links
 *
 * # Example: Basic example
 * <code>
 * <si:pageInfo type="page-left" pagenumber="1">
 *	<span>123</span>
 * </code>
 * <output>
 * Will output the url to single / left page
 * </output>
 *
 * @package TYPO3
 */
class DownloadLinksViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Return elements found
     *
     * @param string $type type of download ('page-left', 'page-right' or 'work')
     * @param integer $pagenumber current page number
     * @return string
     */
    public function render($type = 'page-left', $pagenumber = 1)
    {
        $doc = GeneralUtility::makeInstance(\SLUB\DdbFrontendViewer\Helpers\GetDoc::class);

        switch ($type) {
          case 'page-right':
                    $result = $doc->getPageLink((int)$pagenumber + 1);
                    break;
          case 'work':
                    $result = $doc->getWorkLink((int)$pagenumber);
                    break;
          case 'page-left':
          default:
                    $result = $doc->getPageLink((int)$pagenumber);
                    break;
        }

        return $result;
    }
}
