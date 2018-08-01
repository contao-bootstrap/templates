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
 * Navigation item helper for a nav item.
 *
 * @package ContaoBootstrap\Templates\View\Nav
 */
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

        if ($this->item['subitems']) {
            $this->itemClass[] = 'dropdown';
            $this->addClass('dropdown-toggle');

            $this->setAttribute('data-toggle', 'dropdown');
            $this->setAttribute('aria-haspopup', 'true');
            $this->setAttribute('aria-expanded', 'false');
        }
    }
}
