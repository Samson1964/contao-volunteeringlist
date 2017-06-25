<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'VolunteeringlistClass'        => 'system/modules/volunteeringlist/classes/Volunteeringlist.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_volunteeringlist_default' => 'system/modules/volunteeringlist/templates',
	'mod_volunteeringlist_mini'    => 'system/modules/volunteeringlist/templates',
)); 
