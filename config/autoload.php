<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Samson',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Samson\Volunteeringlist\Volunteeringlist' => 'system/modules/volunteeringlist/classes/Volunteeringlist.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_volunteeringlist_default' => 'system/modules/volunteeringlist/templates',
	'mod_volunteeringlist_mini'    => 'system/modules/volunteeringlist/templates',
));
