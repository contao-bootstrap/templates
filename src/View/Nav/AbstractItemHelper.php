<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

use function implode;
use function in_array;

abstract class AbstractItemHelper extends Attributes implements ItemHelper
{
    /**
     * Current item.
     *
     * @var array<string,mixed>
     */
    protected array $item;

    /**
     * Item classes.
     *
     * @var list<string>
     */
    protected array $itemClass = [];

    /**
     * @param array<string,mixed> $item Navigation item.
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

            if ($this->item['isActive']) {
                $this->addClass('active');
            }
        }

        $attributes = ['accesskey', 'tabindex', 'target'];
        foreach ($attributes as $attribute) {
            if (! $item[$attribute]) {
                continue;
            }

            $this->setAttribute($attribute, $item[$attribute]);
        }

        $title = $this->item['pageTitle'] ?: $this->item['title'];
        $this->setAttribute('title', $title);

        $this->initializeItemClasses();
    }

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

    public function getTag(): string
    {
        return $this->item['isActive'] ? 'strong' : 'a';
    }

    public function hasDivider(): bool
    {
        return false;
    }

    /**
     * Initialize the item classes.
     */
    private function initializeItemClasses(): void
    {
        if (! $this->item['class']) {
            return;
        }

        $classes = StringUtil::trimsplit(' ', $this->item['class']);
        foreach ($classes as $class) {
            $this->itemClass[] = $class;
        }

        if (! in_array('trail', $this->itemClass)) {
            return;
        }

        $this->itemClass[] = 'active';
    }
}
