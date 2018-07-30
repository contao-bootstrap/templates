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

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

/**
 * Base helper for an navigation item.
 *
 * @package ContaoBootstrap\Templates\View\Nav
 */
abstract class AbstractItemHelper extends Attributes implements ItemHelper
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
     * @throws InvalidArgumentException If a broken html attribute is created.
     */
    public function __construct(array $item)
    {
        parent::__construct();

        $this->item = $item;

        if ($this->getTag() === 'a') {
            $this->setAttribute('href', $item['href']);
            $this->setAttribute('itemprop', 'url');

            if ($this->item['nofollow']) {
                $this->setAttribute('rel', 'nofollow');
            }
        } else {
            $this->setAttribute('itemprop', 'name');
        }

        $attributes = array('accesskey', 'tabindex', 'target');
        foreach ($attributes as $attribute) {
            if ($item[$attribute]) {
                $this->setAttribute($attribute, $item[$attribute]);
            }
        }

        $title = $this->item['pageTitle'] ?: $this->item['title'];
        $this->setAttribute('title', $title);

        $this->initializeItemClasses();
    }

    /**
     * {@inheritdoc}
     */
    public function getItemClass(bool $asArray = false): string
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
        return $this->item['isActive'] ? 'strong' : 'a';
    }

    /**
     * {@inheritdoc}
     */
    public function hasDivider(): bool
    {
        return false;
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

        if ($this->item['isActive'] && !in_array('active', $this->itemClass)) {
            $this->itemClass[] = 'active';
        }
    }
}
