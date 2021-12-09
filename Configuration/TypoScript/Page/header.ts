###################################################
# Page header
###################################################

page = PAGE
page {

	includeCSS {
		style = EXT:ddb_frontend_viewer/Resources/Public/Css/allStyles.css
	}
	includeJSFooterlibs {
		# jQuery is included by Kitodo.Presentation on head of page
		uiscripts = EXT:ddb_frontend_viewer/Resources/Public/Js/allScripts.js
	}
	meta {
		keywords.field = keywords
		description.field = description
		author.field = author
		robots = all
		viewport = width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no
		# force
		# Content-Security-Policy = upgrade-insecure-requests
		# Content-Security-Policy.httpEquivalent = 1
	}

}
