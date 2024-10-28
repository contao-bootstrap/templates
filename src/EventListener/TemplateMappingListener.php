<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Template;
use ContaoBootstrap\Core\Environment;

final class TemplateMappingListener
{
    /**
     * Template name mapping.
     *
     * @var array{mandatory: array<string,string>, optional: array<string,string>}|null
     */
    private array|null $mapping = null;

    public function __construct(private Environment $environment)
    {
    }

    /**
     * Handle the on parse template hook.
     *
     * @param Template $template The template being parsed.
     *
     * @Hook("parseTemplate")
     */
    public function onParseTemplate(Template $template): void
    {
        if (! $this->environment->enabled) {
            return;
        }

        $this->initialize();
        if ($this->isAutoMappingDisabled($template->getName())) {
            return;
        }

        $templateName = $this->getMappedTemplateName($template->getName());
        if ($templateName === null) {
            return;
        }

        $template->setName($templateName);
    }

    /**
     * Initialize the mapping configuration.
     */
    private function initialize(): void
    {
        if ($this->mapping !== null) {
            return;
        }

        $this->mapping = $this->environment->getConfig()->get(['templates', 'mapping'], []);
    }

    /**
     * Get the mapped template name. Returns null if not mapped.
     *
     * @param string $templateName The default template name.
     */
    private function getMappedTemplateName(string $templateName): string|null
    {
        if (isset($this->mapping['mandatory'][$templateName])) {
            return $this->mapping['mandatory'][$templateName];
        }

        if (isset($this->mapping['optional'][$templateName])) {
            return $this->mapping['optional'][$templateName];
        }

        return null;
    }

    /**
     * Check if template auto mapping is disabled.
     *
     * @param string $templateName The template name.
     */
    private function isAutoMappingDisabled(string $templateName): bool
    {
        if (isset($this->mapping['mandatory'][$templateName])) {
            return false;
        }

        return ! $this->environment->getConfig()->get(['templates', 'auto_mapping'], true);
    }
}
