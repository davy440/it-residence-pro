<?php

namespace YahnisElsts\PluginUpdateChecker\v5p4;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory as MajorFactory;
use YahnisElsts\PluginUpdateChecker\v5p4\PucFactory as MinorFactory;

require __DIR__ . '/Puc/v5p4/Autoloader.php';
new Autoloader();

require __DIR__ . '/Puc/v5p4/PucFactory.php';
require __DIR__ . '/Puc/v5/PucFactory.php';

//Register classes defined in this version with the factory.
foreach (
	array(
		'Theme\\UpdateChecker'  => Theme\UpdateChecker::class
	)
	as $pucGeneralClass => $pucVersionedClass
) {
	MajorFactory::addVersion($pucGeneralClass, $pucVersionedClass, '5.4');
	//Also add it to the minor-version factory in case the major-version factory
	//was already defined by another, older version of the update checker.
	MinorFactory::addVersion($pucGeneralClass, $pucVersionedClass, '5.4');
}

