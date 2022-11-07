<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View;

use Contao\FrontendTemplate;
use Contao\Template;
use ContaoBootstrap\Core\Environment;
use ContaoBootstrap\Form\FormLayout\AbstractBootstrapFormLayout;
use ContaoBootstrap\Form\FormLayout\DefaultFormLayout;
use ContaoBootstrap\Form\FormLayout\FloatingFormLayout;
use ContaoBootstrap\Form\FormLayout\HorizontalFormLayout;
use Netzmacht\Contao\FormDesigner\LayoutManager;

final class FormRenderer
{
    public function __construct(private LayoutManager $layoutManager, private Environment $environment)
    {
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
        } elseif ($formLayout instanceof FloatingFormLayout) {
            $templateName = $templatePrefix . '_floating';
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
            $template->rowClass       = $formLayout->getRowClass() . ' ' . $formLayout->getMargin();
            $template->isHorizontal   = true;
        } else {
            $template->labelColClass  = null;
            $template->colClass       = null;
            $template->colOffsetClass = null;
            $template->isHorizontal   = false;
            $template->rowClass       = $formLayout instanceof AbstractBootstrapFormLayout
                ? $formLayout->getMargin()
                : null;
        }

        $template->formLayout  = $formLayout;
        $template->buttonClass = $this->getButtonClass();
    }

    /**
     * Get the button class.
     */
    public function getButtonClass(): string
    {
        return 'btn ' . $this->environment->getConfig()->get(['form', 'buttons', 'submit'], 'btn-default');
    }
}
