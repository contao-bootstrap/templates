<?php

/**
 * Contao Bootstrap templates.
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2018 netzmacht David Molineus. All rights reserved.
 * @license    https://github.com/contao-bootstrap/templates/blob/master/LICENSE LGPL 3.0-or-later
 * @filesource
 */

declare(strict_types=1);

/*
 * Palette
 */

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
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
    'eval'      => [
        'tl_class' => 'clr w50',
    ],
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
        'extensions' => \Contao\Config::get('validImageTypes'),
    ],
    'sql'       => "binary(16) NULL",
];
