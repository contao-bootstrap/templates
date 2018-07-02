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

namespace ContaoBootstrap\Templates\View;

use Contao\FrontendTemplate;
use ContaoBootstrap\Core\Environment;
use ContaoBootstrap\Form\FormLayout\HorizontalFormLayout;
use Netzmacht\Contao\FormDesigner\LayoutManager;

/**
 * Class FormView
 */
final class FormRenderer
{
    /**
     * Form layout manager.
     *
     * @var LayoutManager
     */
    private $layoutManager;

    /**
     * Bootstrap environment.
     *
     * @var Environment
     */
    private $environment;

    /**
     * FormRenderer constructor.
     *
     * @param LayoutManager $layoutManager Form layout manager.
     * @param Environment   $environment   Bootstrap environment.
     */
    public function __construct(LayoutManager $layoutManager, Environment $environment)
    {
        $this->layoutManager = $layoutManager;
        $this->environment   = $environment;
    }

    /**
     * Generate the form view.
     *
     * @param string   $templatePrefix
     * @param array    $data
     *
     * @return string
     */
    public function render(string $templatePrefix, array $data): string
    {
        $formLayout = $this->layoutManager->getDefaultLayout();

        if ($formLayout instanceof HorizontalFormLayout) {
            $templateName           = $templatePrefix . '_horizontal';
            $data['labelColClass']  = $formLayout->getLabelColumnClass();
            $data['colClass']       = $formLayout->getColumnClass();
            $data['colOffsetClass'] = $formLayout->getColumnClass(true);
        } else {
            $templateName = $templatePrefix . '_default';
        }

        $data['formLayout']  = $formLayout;
        $data['buttonClass'] = $this->environment->getConfig()->get('form.buttons.submit', 'btn-default');
        $data['rowClass']    = $this->environment->getConfig()->get('form.row', 'form-row');

        $template = new FrontendTemplate($templateName);
        $template->setData($data);

        return $template->parse();
    }
}
