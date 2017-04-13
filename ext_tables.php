<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'DDB Frontend Viewer');

// Register modules.
if (TYPO3_MODE == 'BE') {

    // Module "setup".
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule('txdlfmodules', 'txddbfrontendviewersetup', '', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'modules/setup/');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('_MOD_txdlfmodules_txddbfrontendviewersetup', 'EXT:ddb_frontend_viewer/modules/setup/locallang_mod.xml');
}