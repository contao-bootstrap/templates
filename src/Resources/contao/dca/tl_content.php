<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;

if (! isset($GLOBALS['TL_DCA']['tl_content']['fields']['playerAspect'])) {
    PaletteManipulator::create()
        ->addField('playerAspect', 'source_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('vimeo', 'tl_content')
        ->applyToPalette('youtube', 'tl_content');

    $GLOBALS['TL_DCA']['tl_content']['fields']['playerAspect'] = [
        'label'     => &$GLOBALS['TL_LANG']['tl_content']['playerAspect'],
        'exclude'   => true,
        'inputType' => 'select',
        'options'   => ['16:9', '16:10', '21:9', '4:3'],
        'reference' => &$GLOBALS['TL_LANG']['tl_content']['player_aspect'],
        'eval'      => ['includeBlankOption' => true, 'nospace' => true, 'tl_class' => 'w50'],
        'default'   => 'none',
        'sql'       => "varchar(8) NOT NULL default ''",
    ];
}
