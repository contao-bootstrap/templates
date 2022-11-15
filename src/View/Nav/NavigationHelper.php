<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View\Nav;

use Contao\FrontendTemplate;
use Contao\PageModel;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

use function substr;

class NavigationHelper
{
    /**
     * Navigation item template.
     */
    private FrontendTemplate $template;

    /**
     * List attributes.
     */
    private Attributes $attributes;

    /**
     * Html tag.
     */
    private string $tag;

    /**
     * Navigation level.
     */
    private int $level;

    /**
     * @param FrontendTemplate $template Frontend template.
     * @param string           $navClass Additional nav class being added to the first level.
     *
     * @throws InvalidArgumentException When invalid attributes ar given.
     */
    public function __construct(FrontendTemplate $template, string $navClass = '')
    {
        $this->template   = $template;
        $this->attributes = new Attributes();
        $this->level      = (int) substr($this->template->level, 6);

        $attributes = $this->attributes;
        $attributes->addClass($this->template->level);

        if ($this->level === 1) {
            $this->tag = 'ul';
            $attributes->addClass('nav');

            if ($navClass) {
                $attributes->addClass($navClass);
            }
        } else {
            $this->tag = 'div';
        }

        if ($this->level !== 2) {
            return;
        }

        $attributes->addClass('dropdown-menu');
    }

    /**
     * Create a new instance for a template.
     *
     * @param FrontendTemplate $template Frontend template.
     *
     * @return static
     *
     * @throws InvalidArgumentException When invalid attributes ar given.
     */
    public static function createForTemplate(FrontendTemplate $template): self
    {
        return new static($template, (string) $template->navClass);
    }

    /**
     * Get all attributes.
     */
    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    /**
     * Get an item helper for an item.
     *
     * @param array<string,mixed> $item Item data.
     *
     * @throws InvalidArgumentException If invalid data is given.
     */
    public function getItemHelper(array $item): ItemHelper
    {
        if ($this->level !== 1 && $item['type'] === 'folder') {
            return new HeaderItemHelper($item);
        }

        if ($this->level === 2 || ($this->level > 1 && $this->getPageType() === 'folder')) {
            return new DropdownItemHelper($item);
        }

        return new NavItemHelper($item);
    }

    /**
     * Get the html tag.
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Check the level.
     *
     * @param int $level Navigation level.
     */
    public function isLevel(int $level): bool
    {
        return $this->level === $level;
    }

    /**
     * Get the page type of the current navigation page.
     */
    private function getPageType(): string
    {
        return (string) PageModel::findByPk($this->template->pid)->type;
    }
}
