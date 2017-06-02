<?php
/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

// Define metadata elements.
// @see http://dfg-viewer.de/en/profile-of-the-metadata/
$metadata = array (
	'format' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:physicalDescription/mods:extent',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'owner' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:name[./mods:role/mods:roleTerm="own"]/mods:displayForm',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'licencer' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:name[./mods:role/mods:roleTerm="lso"]/mods:displayForm',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'copyright' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:name[./mods:role/mods:roleTerm="cph"]/mods:displayForm',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'creator' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:name[./mods:role/mods:roleTerm="cre"]/mods:displayForm',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'volume' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:part/mods:detail/mods:number',
				'xpath_sorting' => './mods:part[@type="host"]/@order',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.if.value.field = type\nvalue.if.equals = volume\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'issue' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:part/mods:detail/mods:number',
				'xpath_sorting' => './mods:part[@type="host"]/@order',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.if.value.field = type\nvalue.if.equals = issue\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'parentPlace' => array (
		'hidden' => 1,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:relatedItem[@type="host"]/mods:originInfo[@eventType="production" or @eventType="publication" or not(./mods:edition="[Electronic ed.]")]/mods:place/mods:placeTerm',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => '',
		'is_listed' => 0,
	),
	'publicationRun' => array (
		'hidden' => 1,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => 'concat(./mods:originInfo[@eventType="production" or @eventType="publication" or not(./mods:edition="[Electronic ed.]")]/mods:dateIssued[@point="start"]," - ",./mods:originInfo[@eventType="production" or @eventType="publication" or not(./mods:edition="[Electronic ed.]")]/mods:dateIssued[@point="end"])',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.replacement.1.search = /^-$/\nvalue.replacement.1.replace.field = year // parentYear\nvalue.replacement.1.useRegExp = 1\nvalue.replacement.2.search = /([0-9]{4})-([0-1]?[0-9])-([0-3]?[0-9])/\nvalue.replacement.2.replace = $3.$2.$1\nvalue.replacement.2.useRegExp = 1\nvalue.required = 1\nvalue.noTrimWrap = ||, |\nall.substring = 0,-2\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'year' => array (
		'hidden' => 0,
		'format' => array (),
		'default_value' => '',
		'wrap' => '',
		'is_listed' => 0,
	),
	'parentYear' => array (
		'hidden' => 1,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:relatedItem[@type="host"]/mods:originInfo[@eventType="production" or @eventType="publication" or not(./mods:edition="[Electronic ed.]")]/mods:dateIssued[@keyDate="yes"]',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => '',
		'is_listed' => 0,
	),
	'vd16' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:identifier[@type="vd16"]',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.setContentToCurrent = 1\nvalue.required = 1\nvalue.typolink.parameter.current = 1\nvalue.typolink.parameter.rawUrlEncode = 1\nvalue.typolink.parameter.prepend = TEXT\nvalue.typolink.parameter.prepend.value = http://gateway-bayern.bib-bvb.de/aleph-cgi/bvb_suche?sid=VD16&find_code_1=WVD&find_request_1=\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'vd17' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:identifier[@type="vd17"]',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.setContentToCurrent = 1\nvalue.required = 1\nvalue.typolink.parameter.current = 1\nvalue.typolink.parameter.rawUrlEncode = 1\nvalue.typolink.parameter.prepend = TEXT\nvalue.typolink.parameter.prepend.value = http://gso.gbv.de/xslt/DB=1.28/SET=1/TTL=1/CMD?ACT=SRCHA&IKT=8002&TRM=\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'publisher' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:originInfo/mods:publisher',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'series' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:relatedItem[@type="series"]/mods:titleInfo/mods:title[not(@lang="ger")]',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'place' => array (
		'hidden' => 0,
		'format' => array (),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'urn' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:identifier[@type="urn"]',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.setContentToCurrent = 1\nvalue.typolink.parameter.current = 1\nvalue.typolink.parameter.prepend = TEXT\nvalue.typolink.parameter.prepend.value = http://nbn-resolving.de/\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'purl' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:identifier[@type="purl"]',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.setContentToCurrent = 1\nvalue.typolink.parameter.current = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'author' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:relatedItem[@type="host"]/mods:name[./mods:role/mods:roleTerm[@authority="marcrelator"][@type="code"]="aut"]/mods:displayForm',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'subtitle' => array (
		'hidden' => 1,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => './mods:titleInfo[not(@type="alternative")]/mods:subTitle',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt>|</dt>\n\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
		'is_listed' => 1,
	),
	'title' => array (
		'hidden' => 0,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => 'concat(./mods:titleInfo[not(@type="alternative")]/mods:nonSort," ",./mods:titleInfo[not(@type="alternative")]/mods:title," ",./mods:titleInfo[not(@type="alternative")]/mods:subtitle," ",./mods:titleInfo[not(@type="alternative")]/mods:partNumber," ",./mods:titleInfo[not(@type="alternative")]/mods:partName)',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt class=\"tx-dlf-title\">|</dt>\nvalue.ifEmpty.field = parentTitle\nvalue.ifEmpty.wrap = [|]\nvalue.required = 1\nvalue.wrap = <dd class=\"tx-dlf-title\">|</dd>",
		'is_listed' => 1,
	),
	'parentTitle' => array (
		'hidden' => 1,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => 'concat(./mods:relatedItem[@type="host"]/mods:titleInfo[not(@type="alternative")]/mods:nonSort," ",./mods:relatedItem[@type="host"]/mods:titleInfo[not(@type="alternative")]/mods:title)',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => '',
		'is_listed' => 0,
	),
	'genre' => array (
		'hidden' => 1,
		'format' => array (
			array (
				'encoded' => 1,
				'xpath' => '/mods:genre',
				'xpath_sorting' => '',
			),
		),
		'default_value' => '',
		'wrap' => "key.wrap = <dt class=\"tx-dlf-type\">|</dt>\nvalue.required = 1\nvalue.wrap = <dd class=\"tx-dlf-type\">|</dd>",
		'is_listed' => 1,
	),
	'type' => array (
		'hidden' => 0,
		'format' => array (),
		'default_value' => '',
		'wrap' => "key.wrap = <dt class=\"tx-dlf-type\">|</dt>\nvalue.required = 1\nvalue.override.field = genre\nvalue.override.insertData = 1\nvalue.override.fieldRequired = genre\nvalue.wrap = <dd class=\"tx-dlf-type\">|</dd>",
		'is_listed' => 1,
	),
);
