<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

interface ItemHelper
{
    /**
     * Get the item class as combined string.
     */
    public function getItemClass(): string;

    /**
     * Get the item class as array.
     *
     * @return list<string>
     */
    public function getItemClassAsArray(): array;

    /**
     * Get the tag of the item depending on active state.
     */
    public function getTag(): string;

    /**
     * Check if a divider should be added before the item.
     */
    public function hasDivider(): bool;

    /**
     * Generates the item attributes.
     */
    public function __toString(): string;
}
