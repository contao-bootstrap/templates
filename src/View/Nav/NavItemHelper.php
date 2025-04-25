<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

/** @psalm-suppress PropertyNotSetInConstructor */
final class NavItemHelper extends AbstractItemHelper
{
    /**
     * {@inheritDoc}
     */
    public function __construct(array $item)
    {
        parent::__construct($item);

        $this->addClass('nav-link');
        $this->itemClass[] = 'nav-item';

        /** @psalm-suppress RiskyTruthyFalsyComparison */
        if (! ($this->item['subitems'] ?? false)) {
            return;
        }

        $this->itemClass[] = 'dropdown';
        $this->addClass('dropdown-toggle');

        $this->setAttribute('data-toggle', 'dropdown');
        $this->setAttribute('aria-haspopup', 'true');
        $this->setAttribute('aria-expanded', 'false');
    }
}
