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

use Contao\FrontendTemplate;
use Contao\PageModel;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

/**
 * Class NavigationHelper provides an navigation template helper for the navbar navigation.
 *
 * @package ContaoBootstrap\Templates\View\Nav
 */
class NavigationHelper
{
    /**
     * Navigation item template.
     *
     * @var FrontendTemplate
     */
    private $template;

    /**
     * List attributes.
     *
     * @var Attributes
     */
    private $attributes;

    /**
     * Html tag.
     *
     * @var string
     */
    private $tag;

    /**
     * Navigation level.
     *
     * @var int
     */
    private $level;

    /**
     * NavigationHelper constructor.
     *
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

            if ($navClass) {
                $attributes->addClass($navClass);
            }
        } else {
            $this->tag = 'div';
        }

        if ($this->level === 2) {
            $attributes->addClass('dropdown-menu');
        }
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
     *
     * @return Attributes
     */
    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    /**
     * Get an item helper for an item.
     *
     * @param array $item Item data.
     *
     * @return ItemHelper
     *
     * @throws InvalidArgumentException If invalid data is given.
     */
    public function getItemHelper(array $item): ItemHelper
    {
        if ($this->level !== 1 && $item['type'] === 'folder') {
            return new HeaderItemHelper($item);
        } elseif ($this->level === 2 || ($this->level > 1 && $this->getPageType() === 'folder')) {
            return new DropdownItemHelper($item);
        } else {
            return new NavItemHelper($item);
        }
    }

    /**
     * Get the html tag.
     *
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Check the level.
     *
     * @param int $level Navigation level.
     *
     * @return bool
     */
    public function isLevel(int $level): bool
    {
        return $this->level === $level;
    }

    /**
     * Get the page type of the current navigation page.
     *
     * @return string
     */
    private function getPageType(): string
    {
        return (string) PageModel::findByPk($this->template->pid)->type;
    }
}
