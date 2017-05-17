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
 * ViewHelper to get content by xpath query
 *
 * # Example: Basic example
 * <code>
 * <ddb:xpath xpath="//mets...">
 *	<span>//mets...</span>
 * </code>
 * <output>
 * Will output the found values or an empty string.
 * </output>
 *
 * @package TYPO3
 */
class XpathViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Return elements found
     *
     * @param string $xpath xpath of elements
     *
     * @return array
     */
    public function render($xpath)
    {
        $doc = GeneralUtility::makeInstance(\Slub\DdbFrontendViewer\Helpers\GetDoc::class);

        $result = $doc->getXpath($xpath);

        if (is_array($result)) {
          foreach ($result as $row) {
            $output .= trim($row) . ' ';
          }
        } else {
          $output = trim($result);
        }

        return htmlspecialchars($output);
    }
}
