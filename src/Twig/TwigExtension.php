<?php

/**
 * Contao Bootstrap templates.
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2022 netzmacht David Molineus. All rights reserved.
 * @license    https://github.com/contao-bootstrap/templates/blob/master/LICENSE LGPL 3.0-or-later
 * @filesource
 */

declare(strict_types=1);

namespace ContaoBootstrap\Templates\Twig;

use Contao\StringUtil;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use function array_unique;
use function array_unshift;
use function implode;

final class TwigExtension extends AbstractExtension
{
    /** {@inheritDoc} */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'contao_bootstrap_extract_btn_classes',
                [$this, 'extractBtnClasses'],
                ['needs_context' => true]
            )
        ];
    }

    public function extractBtnClasses(array &$context): array
    {
        $cssClasses = StringUtil::trimsplit(' ', $context['element_css_classes']);
        $btnClasses = [];

        foreach ($cssClasses as $index => $cssClass) {
            if (str_starts_with($cssClass, 'btn-')) {
                $btnClasses[] = $cssClass;
                unset($cssClasses[$index]);
            } elseif ($cssClass === 'btn') {
                $btnClasses[] = $cssClass;
                unset($cssClasses[$index]);
            }
        }

        if (! count($btnClasses)) {
            return $context;
        }

        array_unshift($btnClasses, 'btn');

        $context['element_css_classes'] = implode(' ', $cssClasses);

        return array_unique($btnClasses);
    }
}
