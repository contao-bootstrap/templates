<?php

/**
 * Contao Bootstrap templates.
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2019 netzmacht David Molineus. All rights reserved.
 * @license    https://github.com/contao-bootstrap/templates/blob/master/LICENSE LGPL 3.0-or-later
 * @filesource
 */

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;

if (!isset($GLOBALS['TL_DCA']['tl_content']['fields']['playerAspect'])) {
    PaletteManipulator::create()
        ->addField('playerAspect', 'source_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('vimeo', 'tl_content')
        ->applyToPalette('youtube', 'tl_content');

    $GLOBALS['TL_DCA']['tl_content']['fields']['playerAspect'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['playerAspect'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'options'                 => array('16:9', '16:10', '21:9', '4:3'),
        'reference'               => &$GLOBALS['TL_LANG']['tl_content']['player_aspect'],
        'eval'                    => array('includeBlankOption' => true, 'nospace'=>true, 'tl_class'=>'w50'),
        'default'                 => 'none',
        'sql'                     => "varchar(8) NOT NULL default ''"
    );
}
