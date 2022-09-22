<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

class NavItemHelper extends AbstractItemHelper
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $item)
    {
        parent::__construct($item);

        $this->addClass('nav-link');
        $this->itemClass[] = 'nav-item';

        if (! $this->item['subitems']) {
            return;
        }

        $this->itemClass[] = 'dropdown';
        $this->addClass('dropdown-toggle');

        $this->setAttribute('data-toggle', 'dropdown');
        $this->setAttribute('aria-haspopup', 'true');
        $this->setAttribute('aria-expanded', 'false');
    }
}
