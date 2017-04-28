###################################################
# Page header
###################################################

page = PAGE
page {

	includeCSS {
		style = EXT:ddb_frontend_viewer/Resources/Public/Css/allStyles.css
	}

	includeJSlibs {
		# we include jquery by t3jquery on page.9 below
		plugins = EXT:ddb_frontend_viewer/Resources/Public/Js/plugins.js
		uiscripts = EXT:ddb_frontend_viewer/Resources/Public/Js/allScripts.js
	}
	meta {
		keywords.field = keywords
		description.field = description
		author.field = author
		robots = all
		viewport = width=device-width, initial-scale=1
	}

}
