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

use ContaoCommunityAlliance\MetaPalettes\MetaPalettes;

/**
 * palettes
 */
MetaPalettes::appendFields('tl_module', 'navigation', 'template', ['bs_nav_class']);
MetaPalettes::appendFields('tl_module', 'customnav', 'template', ['bs_nav_class']);
MetaPalettes::appendFields('tl_module', 'quicklink', 'template', ['bs_nav_class']);


/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['bs_nav_class'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bs_nav_class'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class' => 'w50'),
    'sql'                     => "varchar(100) NOT NULL default ''",
);
