lib.navigation_viewfunction = USER
lib.navigation_viewfunction {
	includeLibs = typo3conf/ext/dlf/plugins/navigation/class.tx_dlf_navigation.php
	userFunc = tx_dlf_navigation->main
	pages = {$config.storagePid}
	pageStep = 10
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/navigation-viewfunction.tmpl
}

lib.navigation_pagecontrol = USER
lib.navigation_pagecontrol {
	includeLibs = typo3conf/ext/dlf/plugins/navigation/class.tx_dlf_navigation.php
	userFunc = tx_dlf_navigation->main
	pages = {$config.storagePid}
	pageStep = 10
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/navigation-pagecontrol.tmpl
}
