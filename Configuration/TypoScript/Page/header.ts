###################################################
# Page header
###################################################

page = PAGE
page {

	includeCSS {
		style = EXT:ddb_frontend_viewer/Resources/Public/Css/ddb_frontend_viewer.css
	}

	includeJSlibs {
    # we include jquery by t3jquery on page.9 below
    plugins = EXT:ddb_frontend_viewer/Resources/Public/Js/plugins.js
  }

}

# include t3jquery
includeLibs.t3jquery = EXT:t3jquery/class.tx_t3jquery.php
page.9 = USER_INT
page.9.userFunc = tx_t3jquery->addJqJS
