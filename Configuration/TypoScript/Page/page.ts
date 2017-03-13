# -------------------------------
# PAGE SETUP
# -------------------------------
page {
  typeNum = 0
  bodyTag = <body class="">

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

			productName = TEXT
			productName.value = {$config.productName}

			pageHideInMenu = TEXT
			pageHideInMenu.data = page:nav_hide

			content < styles.content.get
			contentRight < styles.content.getRight

			rootPageId = TEXT
			rootPageId.value = {$config.rootPid}

		}
	}

	meta {
				keywords.field = keywords
				description.field = description
        author   = DDB
        robots	 = all
    }
}

# -------------------------------
# Diverses
# -------------------------------
