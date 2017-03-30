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
 * ViewHelper to calculate two integers
 *
 * # Example: Basic example
 * <code>
 * <ddb:calc val1="1" val2="1" operator="+">
 *	<span>2</span>
 * </code>
 * <output>
 * Will output val1 + val2
 * </output>
 *
 * @package TYPO3
 */
class CalcViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Return result of calculation
     *
     * @param string $val1 first value
     * @param string $val2 second value
     * @param string $operator operator
     * @return string
     */
    public function render($val1, $val2, $operator = '+')
    {
        switch ($operator) {
          case '+': $result = (int)$val1 + (int)$val2;
                    break;
          case '-': $result = (int)$val1 - (int)$val2;
                    break;
          case '*': $result = (int)$val1 * (int)$val2;
                    break;
          case '/': $result = (int)((int)$val1 / (int)$val2);
                    break;
        }

        return $result;
    }
}
