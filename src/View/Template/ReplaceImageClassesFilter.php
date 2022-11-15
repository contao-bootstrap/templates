<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Template;

use Contao\StringUtil;
use Contao\Template;
use ContaoBootstrap\Core\View\Template\Filter\PreRenderFilter;

use function array_unique;
use function array_unshift;
use function count;
use function implode;
use function strpos;

final class ReplaceImageClassesFilter implements PreRenderFilter
{
    public function supports(Template $template): bool
    {
        return strpos($template->getName(), 'ce_hyperlink') === 0;
    }

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

        if (! count($btnClasses)) {
            return;
        }

        array_unshift($btnClasses, 'btn');

        $template->class          = implode(' ', $cssClasses);
        $template->hyperlinkClass = ' ' . implode(' ', array_unique($btnClasses));
    }
}
