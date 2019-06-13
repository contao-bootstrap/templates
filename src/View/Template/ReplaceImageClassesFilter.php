<?php

/**
 * Contao Bootstrap
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017-2019 netzmacht David Molineus. All rights reserved.
 * @license    LGPL-3.0-or-later https://github.com/contao-bootstrap/templates/blob/master/LICENSE
 * @filesource
 */

namespace ContaoBootstrap\Templates\View\Template;

use Contao\StringUtil;
use Contao\Template;
use ContaoBootstrap\Core\View\Template\Filter\PreRenderFilter;
use function array_unique;
use function array_unshift;
use function implode;
use function strpos;

/**
 * Class ReplaceImageClassesFilter
 */
class ReplaceImageClassesFilter implements PreRenderFilter
{
    /**
     * {@inheritDoc}
     */
    public function supports(Template $template): bool
    {
        return strpos($template->getName(), 'ce_hyperlink') === 0;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(Template $template): void
    {
        $cssClasses = $template->class;
        $cssClasses = StringUtil::trimsplit(' ', $cssClasses);
        $btnClasses = [];

        foreach ($cssClasses as $index => $cssClass) {
            if (strpos($cssClass, 'btn-') === 0) {
                $btnClasses[] = $cssClass;
                unset($cssClasses[$index]);
            } elseif ($cssClass === 'btn') {
                $btnClasses[] = $cssClass;
                unset($cssClasses[$index]);
            }
        }

        if (count($btnClasses)) {
            array_unshift($btnClasses, 'btn');

            $template->class          = implode(' ', $cssClasses);
            $template->hyperlinkClass = $btnClasses ? ' ' . implode(' ', array_unique($btnClasses)) : '';
        }
    }
}
