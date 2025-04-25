<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;
use Override;

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

            if ((bool) ($this->item['nofollow'] ?? false)) {
                $this->setAttribute('rel', 'nofollow');
            }
        } else {
            $this->setAttribute('itemprop', 'name');

            if ((bool) ($this->item['isActive'] ?? false)) {
                $this->addClass('active');
            }
        }

        $attributes = ['accesskey', 'tabindex', 'target'];
        foreach ($attributes as $attribute) {
            if (! (bool) ($item[$attribute] ?? false)) {
                continue;
            }

            $this->setAttribute($attribute, $item[$attribute]);
        }

        $title = $this->item['pageTitle'] ?: $this->item['title'];
        $this->setAttribute('title', $title);

        $this->initializeItemClasses();
    }

    #[Override]
    public function getItemClass(bool $asArray = false): string
    {
        return implode(' ', $this->itemClass);
    }

    /**
     * {@inheritdoc}
     */
    #[Override]
    public function getItemClassAsArray(): array
    {
        return $this->itemClass;
    }

    #[Override]
    public function getTag(): string
    {
        return $this->item['isActive'] ? 'strong' : 'a';
    }

    #[Override]
    public function hasDivider(): bool
    {
        return false;
    }

    /**
     * Initialize the item classes.
     */
    private function initializeItemClasses(): void
    {
        if (! (bool) ($this->item['class'] ?? false)) {
            return;
        }

        $classes = StringUtil::trimsplit(' ', $this->item['class']);
        foreach ($classes as $class) {
            $this->itemClass[] = (string) $class;
        }

        if (! in_array('trail', $this->itemClass, true)) {
            return;
        }

        $this->itemClass[] = 'active';
    }
}
