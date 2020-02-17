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

$GLOBALS['BE_MOD']['content']['volunteeringlist'] = array
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

/**
 * -------------------------------------------------------------------------
 * Voreinstellungen
 * -------------------------------------------------------------------------
 */

$GLOBALS['TL_CONFIG']['volunteeringlist_picWidth'] = 60;
$GLOBALS['TL_CONFIG']['volunteeringlist_picHeight'] = 80;
