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

namespace ContaoBootstrap\Templates\View\Nav;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

/**
 * Class HeaderItemHelper creates the header navigation item.
 */
final class HeaderItemHelper extends Attributes implements ItemHelper
{
    /**
     * Current item.
     *
     * @var array
     */
    protected $item;

    /**
     * Item classes.
     *
     * @var array
     */
    protected $itemClass = array();

    /**
     * AbstractItemHelper constructor.
     *
     * @param array $item Navigation item.
     *
     * @throws InvalidArgumentException When invalid attributes are given.
     */
    public function __construct(array $item)
    {
        parent::__construct();

        $this->item = $item;
        $this->addClass('dropdown-header');

        $this->initializeItemClasses();
    }

    /**
     * {@inheritdoc}
     */
    public function getItemClass(): string
    {
        return implode(' ', $this->itemClass);
    }

    /**
     * {@inheritdoc}
     */
    public function getItemClassAsArray(): array
    {
        return $this->itemClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getTag(): string
    {
        return 'div';
    }

    /**
     * {@inheritdoc}
     */
    public function hasDivider(): bool
    {
        return !in_array('first', $this->getItemClassAsArray());
    }

    /**
     * Initialize the item classes.
     *
     * @return void
     */
    private function initializeItemClasses(): void
    {
        if ($this->item['class']) {
            $classes = StringUtil::trimsplit(' ', $this->item['class']);
            foreach ($classes as $class) {
                $this->itemClass[] = $class;
            }

            if (in_array('trail', $this->itemClass)) {
                $this->itemClass[] = 'active';
            }
        }
    }
}
