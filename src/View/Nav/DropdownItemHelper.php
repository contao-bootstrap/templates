<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

class DropdownItemHelper extends AbstractItemHelper
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $item)
    {
        parent::__construct($item);

        $this->addClass('dropdown-item');
        $this->addClasses($this->itemClass);
    }
}
