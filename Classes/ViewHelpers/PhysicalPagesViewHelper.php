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
 * ViewHelper to get mapping of physical pages, labels and image numbers
 *
 * # Example: Basic example
 * <code>
 * <si:physicalPages />
 *	<span>123</span>
 * </code>
 * <output>
 * Will output the mapping as list
 * </output>
 *
 * @package TYPO3
 */
class PhysicalPagesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Return elements found
     *
     * @return string
     */
    public function render()
    {
        $doc = GeneralUtility::makeInstance(\SLUB\DdbFrontendViewer\Helpers\GetDoc::class);

        $result = $doc->getPhysicalPageMap();

        return $result;
    }
}
