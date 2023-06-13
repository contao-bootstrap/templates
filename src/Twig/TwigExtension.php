<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\Twig;

use ContaoBootstrap\Templates\View\Spacing;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TwigExtension extends AbstractExtension
{
    public function __construct(private readonly Spacing $spacing)
    {
    }

    /** {@inheritDoc} */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('contao_bootstrap_margin', [$this->spacing, 'margin']),
            new TwigFunction('contao_bootstrap_padding', [$this->spacing, 'padding']),
        ];
    }
}
