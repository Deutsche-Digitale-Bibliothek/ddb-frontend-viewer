plugin.tx_ddbfrontendviewer_sru {
	pages = {$config.storagePid}
	templateFile = EXT:ddb_frontend_viewer/plugins/sru/template.tmpl
	targetPid.data = TSFE:page|uid
}
