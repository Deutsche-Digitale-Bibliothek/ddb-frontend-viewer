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

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, 'plugins/sru/class.tx_ddbfrontendviewer_sru.php', '_sru', 'list_type', TRUE);

// Register eID handlers.
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['tx_ddbfrontendviewer_sru_eid'] = 'EXT:'.$_EXTKEY.'/plugins/sru/class.tx_ddbfrontendviewer_sru_eid.php';
