# -------------------------------
# PAGE SETUP
# -------------------------------
page {
  typeNum = 0
  bodyTag = <body class="ddb-viewer">

  adminPanelStyles = 0
  shortcutIcon = EXT:ddb_frontend_viewer/Resources/Public/Images/favicon.png

	10 = FLUIDTEMPLATE
	10 {
	  file = EXT:ddb_frontend_viewer/Resources/Private/Templates/Main.html
	  layoutRootPath = EXT:ddb_frontend_viewer/Resources/Private/Layouts/
	  partialRootPath = EXT:ddb_frontend_viewer/Resources/Private/Partials/

		variables {
			pageTitle = TEXT
			pageTitle.data = page:title

			content < styles.content.get
			contentRight < styles.content.getRight

			rootPageId = TEXT
			rootPageId.value = {$config.rootPid}

      kitodoPageView = TEXT
			kitodoPageView.value = {$config.kitodoPageView}

      piwik_hostname = TEXT
			piwik_hostname.value = {$config.piwik_hostname}

      piwik_idsite = TEXT
			piwik_idsite.value = {$config.piwik_idsite}

      piwik_domains = TEXT
			piwik_domains.value = {$config.piwik_domains}

      gp-page = TEXT
      gp-page.data = GP:tx_dlf|page
      gp-page.ifEmpty = 1

      gp-double = TEXT
      gp-double.data = GP:tx_dlf|double

      gp-id = TEXT
      gp-id.data = GP:tx_dlf|id // GP:tx_ddbfrontendviewer|id

      gp-pagegrid = TEXT
      gp-pagegrid.data = GP:tx_dlf|pagegrid

		}
	}

	meta {
				keywords.field = keywords
				description.field = description
        author   = Deutsche Digitale Bibliothek
        robots = noindex,nofollow
    }
}

# -------------------------------
# Diverses
# -------------------------------
