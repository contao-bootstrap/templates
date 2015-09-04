<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Bootstrap\Templates;

/**
 * Class Modifier provides modifier callbacks.
 *
 * @package Netzmacht\Bootstrap\Templates
 */
class Modifier
{
    /**
     * Replace image classes.
     *
     * @param \Template $template The template being parsed.
     *
     * @return void
     */
    public static function replaceImageClasses(\Template $template)
    {
        if (empty($template->imgSize) && empty($template->picture['img'])) {
            return;
        }

        $cssClasses   = $template->class;
        $cssClasses   = trimsplit(' ', $cssClasses);
        $imageClasses = array();

        foreach ($cssClasses as $index => $cssClass) {
            if (substr($cssClass, 0, 4) == 'img-') {
                $imageClasses[] = $cssClass;
                unset($cssClasses[$index]);
            }
        }

        if (count($imageClasses)) {
            $imageClasses       = implode(' ', $imageClasses);
            $template->class    = implode(' ', $cssClasses);
            $template->imgSize .= sprintf(' class="%s"', $imageClasses);

            if (!empty($template->picture['img'])) {
                $picture                = $template->picture;
                $picture['attributes'] .= sprintf(' class="%s"', $imageClasses);

                $template->picture = $picture;
            }
        }
    }

    /**
     * Replace table classes.
     *
     * @param \Template $template The template being parsed.
     *
     * @return void
     */
    public static function replaceTableClasses(\Template $template)
    {
        $cssClasses   = $template->class;
        $cssClasses   = trimsplit(' ', $cssClasses);
        $tableClasses = array();

        foreach ($cssClasses as $index => $cssClass) {
            if ($cssClass === 'table' || substr($cssClass, 0, 6) == 'table-') {
                $tableClasses[] = $cssClass;
                unset($cssClasses[$index]);
            }
        }

        if (count($tableClasses)) {
            if (!in_array('table', $tableClasses)) {
                $tableClasses[] = 'table';
            }

            $template->class = implode(' ', $cssClasses);

            // reset sortable, to avoid double class attributes
            if ($template->sortable) {
                $tableClasses[]     = 'sortable';
                $template->sortable = null;
            }

            $template->id = sprintf('%s" class="%s', $template->id, implode(' ', $tableClasses));
        }
    }
}
