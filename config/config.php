<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   bdf
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

/**
 * Backend-Bereich DSB anlegen, wenn noch nicht vorhanden
 */
if(!$GLOBALS['BE_MOD']['dsb']) 
{
	$dsb = array(
		'dsb' => array()
	);
	array_insert($GLOBALS['BE_MOD'], 0, $dsb);
}

$GLOBALS['BE_MOD']['dsb']['volunteeringlist'] = array
(
	'tables'         => array('tl_volunteeringlist', 'tl_volunteeringlist_items'),
	'icon'           => 'system/modules/volunteeringlist/assets/images/icon.png',
);

/**
 * -------------------------------------------------------------------------
 * CONTENT ELEMENTS
 * -------------------------------------------------------------------------
 */
$GLOBALS['TL_CTE']['schach']['volunteeringlist'] = 'Samson\Volunteeringlist\Volunteeringlist';

// Konfiguration für ProSearch
$GLOBALS['PS_SEARCHABLE_MODULES']['volunteeringlist'] = array(
	'icon'           => 'system/modules/volunteeringlist/assets/images/icon.png',
	'title'          => array('title','name'),
	'searchIn'       => array('title','name', 'info'),
	'tables'         => array('tl_volunteeringlist', 'tl_volunteeringlist_items'),
	'shortcut'       => 'vlist'
);
