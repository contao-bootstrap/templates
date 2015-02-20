<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

return array(
    'templates' => array(
        'modifiers' => array(
            'callback_replace-image-classes' => array(
                'type'      => 'callback',
                'callback'  => array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceImageClasses'),
                'templates' => array('ce_*'),
            ),

            'callback_replace-table-classes' => array(
                'type'      => 'callback',
                'callback'  => array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceTableClasses'),
                'templates' => array('ce_table*'),
            ),

            'replace_pagination-active-class' => array
            (
                'type'        => 'replace',
                'key'         => 'items',
                'search'      => '<li><span class="current">',
                'replace'     => '<li class="active"><span>',
                'templates'   => array('pagination'),
            ),
        ),
    ),
);
