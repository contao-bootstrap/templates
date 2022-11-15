<?php

declare(strict_types=1);

use Contao\Config;
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('bootstrap_legend', '')
    ->addField(['bs_templates_disable_mapping', 'bs_gravatar_size', 'bs_gravatar_default'], 'bootstrap_legend')
    ->applyToPalette('default', 'tl_theme');

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_theme']['fields']['bs_templates_disable_mapping'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_theme']['bs_templates_disable_mapping'],
    'inputType' => 'checkbox',
    'eclude'    => true,
    'eval'      => ['tl_class' => 'clr w50'],
    'sql'       => "char(1) NULL default \'\'",
];

$GLOBALS['TL_DCA']['tl_theme']['fields']['bs_gravatar_size'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_theme']['bs_gravatar_size'],
    'inputType' => 'text',
    'eclude'    => true,
    'eval'      => [
        'tl_class' => 'clr w50',
        'rgxp'     => 'natural',
    ],
    'sql'       => 'int(10) NULL default NULL',
];

$GLOBALS['TL_DCA']['tl_theme']['fields']['bs_gravatar_default'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_theme']['bs_gravatar_default'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => [
        'filesOnly'  => true,
        'fieldType'  => 'radio',
        'mandatory'  => false,
        'tl_class'   => 'clr',
        'extensions' => Config::get('validImageTypes'),
    ],
    'sql'       => 'binary(16) NULL',
];
