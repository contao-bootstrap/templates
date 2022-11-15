<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\EventListener;

use Contao\ContentModel;
use Contao\Model;
use Contao\ModuleModel;
use Contao\Template;

use function substr;

final class NavClassListener
{
    /**
     * Nav class.
     */
    private string $navClass = '';

    /**
     * Check if a module is loaded which make use the bs_nav_class value.
     *
     * @param Model      $element   The given element.
     * @param bool|mixed $isVisible Visibility state.
     */
    public function onIsVisibleElement(Model $element, $isVisible): bool
    {
        $isVisible = (bool) $isVisible;

        // load module if it is a module include element
        if ($element instanceof ContentModel && $element->type === 'module') {
            $element = ModuleModel::findByPK($element->module);
        }

        if (! $element instanceof ModuleModel) {
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
     */
    public function onParseTemplate(Template $template): void
    {
        if (substr($template->getName(), 0, 4) !== 'nav_') {
            return;
        }

        $template->navClass = $this->navClass;
    }
}
