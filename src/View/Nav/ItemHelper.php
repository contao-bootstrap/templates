<?php

/**
 * Contao Bootstrap templates.
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2018 netzmacht David Molineus. All rights reserved.
 * @license    https://github.com/contao-bootstrap/templates/blob/master/LICENSE LGPL 3.0-or-later
 * @filesource
 */

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

/**
 * Interface ItemHelper describes an navigation item helper.
 *
 * @package ContaoBootstrap\Templates\View\Nav
 */
interface ItemHelper
{
    /**
     * Get the item class as combined string.
     *
     * @return string
     */
    public function getItemClass(): string;

    /**
     * Get the item class as array.
     *
     * @return array
     */
    public function getItemClassAsArray(): array;

    /**
     * Get the tag of the item depending on active state.
     *
     * @return string
     */
    public function getTag(): string;

    /**
     * Check if an divider should be added before the item.
     *
     * @return bool
     */
    public function hasDivider(): bool;

    /**
     * Generates the item attributes.
     *
     * @return string
     */
    public function __toString(): string;
}
