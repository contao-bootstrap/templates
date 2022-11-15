<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View;

use Contao\FrontendTemplate;
use Contao\Template;
use ContaoBootstrap\Core\Environment;
use ContaoBootstrap\Form\FormLayout\HorizontalFormLayout;
use Netzmacht\Contao\FormDesigner\LayoutManager;

final class FormRenderer
{
    private LayoutManager $layoutManager;

    private Environment $environment;

    public function __construct(LayoutManager $layoutManager, Environment $environment)
    {
        $this->layoutManager = $layoutManager;
        $this->environment   = $environment;
    }

    /**
     * Generate the form view.
     *
     * @param string              $templatePrefix The template prefix which gets an _horizontal or _default suffix.
     * @param array<string,mixed> $data           Template data being used in the new template.
     */
    public function render(string $templatePrefix, array $data): string
    {
        $formLayout = $this->layoutManager->getDefaultLayout();

        if ($formLayout instanceof HorizontalFormLayout) {
            $templateName = $templatePrefix . '_horizontal';
        } else {
            $templateName = $templatePrefix . '_default';
        }

        $template = new FrontendTemplate($templateName);
        $template->setData($data);
        $this->prepare($template);

        return $template->parse();
    }

    /**
     * Prepare the template by adding grid related classes.
     *
     * @param Template $template The template.
     */
    public function prepare(Template $template): void
    {
        $formLayout = $this->layoutManager->getDefaultLayout();

        if ($formLayout instanceof HorizontalFormLayout) {
            $template->labelColClass  = $formLayout->getLabelColumnClass();
            $template->colClass       = $formLayout->getColumnClass();
            $template->colOffsetClass = $formLayout->getColumnClass(true);
            $template->rowClass       = $formLayout->getRowClass();
            $template->isHorizontal   = true;
        } else {
            $template->labelColClass  = null;
            $template->colClass       = null;
            $template->colOffsetClass = null;
            $template->rowClass       = null;
            $template->isHorizontal   = false;
        }

        $template->formLayout  = $formLayout;
        $template->buttonClass = $this->getButtonClass();
    }

    /**
     * Get the button class.
     */
    public function getButtonClass(): string
    {
        return 'btn ' . $this->environment->getConfig()->get('form.buttons.submit', 'btn-default');
    }
}
