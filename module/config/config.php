<?php

// replace image css classes
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceImageClasses'] = array
(
	'type'      => 'callback',
	'callback'  => array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceImageClasses'),
	'templates' => 'ce_*',
);

// replace image css classes
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceTableClasses'] = array
(
	'type'      => 'callback',
	'callback'  => array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceTableClasses'),
	'templates' => 'ce_table*',
);