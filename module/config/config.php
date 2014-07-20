<?php

// replace image css classes
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceImageClasses']['type']        = 'callback';
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceImageClasses']['callback']    = array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceImageClasses');
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceImageClasses']['templates'][] = 'ce_*';

// replace table css classes
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceTableClasses']['type']        = 'callback';
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceTableClasses']['callback']    = array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceTableClasses');
$GLOBALS['BOOTSTRAP']['templates']['modifiers']['callback.replaceTableClasses']['templates'][] = 'ce_table*';