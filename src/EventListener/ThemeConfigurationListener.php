<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\EventListener;

use Contao\Environment;
use Contao\FilesModel;
use Contao\ThemeModel;
use ContaoBootstrap\Core\Environment\ThemeContext;
use ContaoBootstrap\Core\Message\Command\BuildContextConfig;

use function count;

final class ThemeConfigurationListener
{
    /**
     * Build the context config.
     *
     * @param BuildContextConfig $command The command.
     */
    public function onBuildContextConfig(BuildContextConfig $command): void
    {
        $context = $command->context;
        if (! $context instanceof ThemeContext) {
            return;
        }

        $theme = ThemeModel::findByPk($context->themeId);
        if (! $theme) {
            return;
        }

        $templateConfig = [];
        $templateConfig = $this->buildGravatarConfig($theme, $templateConfig);
        $templateConfig = $this->buildTemplateMappingConfig($theme, $templateConfig);

        if (count($templateConfig) <= 0) {
            return;
        }

        $command->config = $command->config->merge(['templates' => $templateConfig]);
    }

    /**
     * Build the gravatar config.
     *
     * @param ThemeModel          $theme  The theme model.
     * @param array<string,mixed> $config The theme config.
     *
     * @return array<string,mixed>
     */
    private function buildGravatarConfig(ThemeModel $theme, array $config): array
    {
        $file = FilesModel::findByPk($theme->bs_gravatar_default);

        if ($file) {
            $config['gravatar']['default'] = Environment::get('base') . $file->path;
        }

        if ($theme->bs_gravatar_size) {
            $config['gravatar']['size'] = (int) $theme->bs_gravatar_size;
        }

        return $config;
    }

    /**
     * Build the gravatar config.
     *
     * @param ThemeModel          $theme  The theme model.
     * @param array<string,mixed> $config The theme config.
     *
     * @return array<string,mixed>
     */
    private function buildTemplateMappingConfig(ThemeModel $theme, array $config): array
    {
        if ($theme->bs_templates_disable_mapping) {
            $config['auto_mapping'] = false;
        }

        return $config;
    }
}
