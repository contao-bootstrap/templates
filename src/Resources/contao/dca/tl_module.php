<?php

declare(strict_types=1);

use ContaoCommunityAlliance\MetaPalettes\MetaPalettes;

/*
 * Palettes
 */

MetaPalettes::appendFields('tl_module', 'navigation', 'template', ['bs_nav_class']);
MetaPalettes::appendFields('tl_module', 'customnav', 'template', ['bs_nav_class']);
MetaPalettes::appendFields('tl_module', 'quicklink', 'template', ['bs_nav_class']);

/*
 * Fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_nav_class'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_nav_class'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(100) NOT NULL default ''",
];
