###################################################
# Page header
###################################################

page = PAGE
page {

	includeCSS {
		style = EXT:ddb_frontend_viewer/Resources/Public/Css/allStyles.css
	}

	includeJSLibs {
		# we include jquery by t3jquery on page.9 below
		uiscripts = EXT:ddb_frontend_viewer/Resources/Public/Js/allScripts.js
	}
	meta {
		keywords.field = keywords
		description.field = description
		author.field = author
		robots = all
		viewport = width=device-width, initial-scale=1
		# force
		# Content-Security-Policy = upgrade-insecure-requests
		# Content-Security-Policy.httpEquivalent = 1
	}

}
