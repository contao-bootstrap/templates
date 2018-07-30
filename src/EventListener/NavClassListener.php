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

namespace ContaoBootstrap\Templates\EventListener;

use Contao\ContentModel;
use Contao\Model;
use Contao\ModuleModel;
use Contao\Template;

/**
 * Class NavClassListener
 */
final class NavClassListener
{
    /**
     * Nav class.
     *
     * @var string
     */
    private $navClass;

    /**
     * Check if a module is loaded which make use the bs_nav_class value.
     *
     * @param Model $element   The given element.
     * @param bool  $isVisible Visibility state.
     *
     * @return bool
     */
    public function onIsVisibleElement(Model $element, $isVisible): bool
    {
        $isVisible = (bool) $isVisible;

        // load module if it is a module include element
        if ($element instanceof ContentModel && $element->type == 'module') {
            $element = ModuleModel::findByPK($element->module);
        }

        if (!$element instanceof ModuleModel) {
            return $isVisible;
        }

        // do not limit for navigation module. so every module can access it
        $this->navClass = $element->bs_nav_class;

        return $isVisible;
    }

    /**
     * Set the nav class in the nav template.
     *
     * @param Template $template The template being parsed.
     *
     * @return void
     */
    public function onParseTemplate(Template $template): void
    {
        if (substr($template->getName(), 0, 4) !== 'nav_') {
            return;
        }

        $template->navClass = (string) $this->navClass;
    }
}
