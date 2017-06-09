# DDB Frontend Viewer

This TYPO3 extension provides the configuration and setup for the DDB Frontend Viewer.

##  Installation
This extension needs to reside in a folder called `ddb_frontend_viewer` in TYPO3 extension folder ('typoconf/ext'). 

## Frontend development (based on Grunt)

The extension comes with a Grunt (see https://gruntjs.com/getting-started) setup which uses some typical NPM packages like jshint, uglify, less aso.

You can simply get it running by installing the local needings of NPM with npm install on your command line from the source folder of this extension (`typoconf/ext/ddb_frontend_viewer`).

After that just type grunt to start the processing which watches all the LESS and JS folders to generate new asset files on the fly if anythings changes.

## Dependencies
- TYPO3 CMS Frontend (cms)
- CSS styled content (css_styled_content)
- Extbase Framework (Extbase)
- Fluid Templating Engine (fluid)
- RealURL (realurl)
- Kitodo.Presentatioin (dlf)
