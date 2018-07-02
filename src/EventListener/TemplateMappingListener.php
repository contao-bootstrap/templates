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

use Contao\Template;
use ContaoBootstrap\Core\Environment;

/**
 * Class TemplateMappingListener
 */
final class TemplateMappingListener
{
    /**
     * Bootstrap environment.
     *
     * @var Environment
     */
    private $environment;

    /**
     * Template name mapping.
     *
     * @var array|null
     */
    private $mapping;

    /**
     * TemplateMappingListener constructor.
     *
     * @param Environment $environment Bootstrap environment.
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Handle the on parse template hook.
     *
     * @param Template $template The template being parsed.
     *
     * @return void
     */
    public function onParseTemplate(Template $template): void
    {
        if (!$this->environment->isEnabled() || $this->isAutoMappingDisabled()) {
            return;
        }

        $templateName = $this->getMappedTemplateName($template->getName());
        if ($templateName) {
            $template->setName($templateName);
        }
    }

    /**
     * Get the mapped template name. Returns null if not mapped.
     *
     * @param string $templateName The default template name.
     *
     * @return null|string
     */
    private function getMappedTemplateName(string $templateName): ?string
    {
        if ($this->mapping === null) {
            $this->mapping = $this->environment->getConfig()->get('templates.mapping', []);
        }

        if (isset($this->mapping[$templateName])) {
            return $this->mapping[$templateName];
        }

        return null;
    }

    /**
     * Check if template auto mapping is disabled.
     *
     * @return bool
     */
    private function isAutoMappingDisabled(): bool
    {
        return !$this->environment->getConfig()->get('templates.auto_mapping', true);
    }
}
