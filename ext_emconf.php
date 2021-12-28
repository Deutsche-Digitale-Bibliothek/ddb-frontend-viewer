<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'DDB Frontend Viewer',
	'description' => 'Viewer based on Kitodo.Presentation, customized for DDB',
	'category' => 'templates',
	'version' => '1.0.2',
	'state' => 'stable',
	'uploadfolder' => 0,
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author' => 'Alexander Bigga',
	'author_email' => 'typo3@slub-dresden.de',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-7.6.99',
			'dlf' => '2.3.0-2.3.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'autoload' => [
		'classmap' => ['Classes']
	],

);
