config.disableWrapInBaseClass=1

# map GET parameter tx_ddbfrontendviewer[id] --> tx_dlf[id]
[globalString = GP:tx_ddbfrontendviewer|id != /^$/]
plugin.tx_dlf._DEFAULT_PI_VARS.id {
	stdWrap.data = GP:tx_ddbfrontendviewer|id
	stdWrap.wrap = https://api.deutsche-digitale-bibliothek.de/items/|/source
}
[global]

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

plugin.tx_dlf_toc {
	pages = {$config.storagePid}
	excludeOther = 0
	targetPid.data = TSFE:page|uid
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/toc.tmpl
	menuConf {
		expAll = 0
		1 = TMENU
		1.noBlur = 1
		1.wrap = <ul class="toc">|</ul>
		1.NO = 1
		1.NO.stdWrap.crop = 155 | &nbsp;... | 1
		1.NO.stdWrap.ifEmpty.field = type
		1.NO.stdWrap.ifEmpty.append = TEXT
		1.NO.stdWrap.ifEmpty.append.fieldRequired = volume
		1.NO.stdWrap.ifEmpty.append.field = volume
		1.NO.stdWrap.ifEmpty.append.wrap = &nbsp;|
		1.NO.stdWrap.dataWrap = | <span class="pagination">{field:pagination}</span>
		1.NO.doNotLinkIt.field = doNotLinkIt
		1.NO.ATagTitle.field = title
		1.NO.allWrap = <span class="a">|</span>
		1.NO.allWrap.fieldRequired = doNotLinkIt
		1.NO.wrapItemAndSub = <li>|</li>
		1.IFSUB < .1.NO
		1.IFSUB.wrapItemAndSub = <li class="submenu">|</li>
		1.CUR < .1.NO
		1.CUR.wrapItemAndSub = <li class="current">|</li>
		1.CURIFSUB < .1.NO
		1.CURIFSUB.wrapItemAndSub = <li class="current submenu">|</li>
		1.ACT < .1.NO
		1.ACT.wrapItemAndSub = <li class="active">|</li>
		1.ACTIFSUB < .1.NO
		1.ACTIFSUB.wrapItemAndSub = <li class="active submenu">|</li>
		2 < .1
		2.wrap = <ul>|</ul>
		3 < .2
		4 < .3
		5 < .4
		6 < .5
		7 < .6
	}
}

plugin.tx_dlf_metadata {
	pages = {$config.storagePid}
	excludeOther = 0
	linkTitle = 0
	getTitle = 0
	showFull = 1
	rootline = 1
	separator = #
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/metadata.tmpl
}

lib.tools.toolsFulltext = USER
lib.tools.toolsFulltext {
	includeLibs = typo3conf/ext/dlf/plugins/toolbox/class.tx_dlf_toolbox.php
	userFunc = tx_dlf_toolbox->main
	pages = {$config.storagePid}
	tools = tx_dlf_toolsFulltext
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/toolbox.tmpl
}
plugin.tx_dlf_toolsFulltext {
	toolTemplateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/fulltext.tmpl
}

lib.tools.toolsImagemanipulation = USER
lib.tools.toolsImagemanipulation {
	includeLibs = typo3conf/ext/dlf/plugins/toolbox/class.tx_dlf_toolbox.php
	userFunc = tx_dlf_toolbox->main
	pages = {$config.storagePid}
	tools = tx_dlf_toolsImagemanipulation
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/toolbox.tmpl
}

plugin.tx_dlf_toolsImagemanipulation {
	toolTemplateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/imagemanipulation.tmpl

}

plugin.tx_dlf_pageview {
	pages = {$config.storagePid}
	excludeOther = 0
	features =
	elementId = tx-dlf-map
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/pageview.tmpl

}

plugin.tx_dlf_pagegrid {
	pages = {$config.storagePid}
	limit = 24
	placeholder =
	targetPid = #
	templateFile = EXT:ddb_frontend_viewer/Resources/Private/Templates/Plugins/Kitodo/pagegrid.tmpl
}
