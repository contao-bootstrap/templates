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

use Contao\Environment;
use Contao\FilesModel;
use Contao\ThemeModel;
use ContaoBootstrap\Core\Environment\ThemeContext;
use ContaoBootstrap\Core\Message\Command\BuildContextConfig;

/**
 * Class GravatarConfigurationListener parses the gravatar configuration defined in the theme.
 */
final class ThemeConfigurationListener
{
    /**
     * Build the context config.
     *
     * @param BuildContextConfig $command The command.
     *
     * @return void
     */
    public function onBuildContextConfig(BuildContextConfig $command): void
    {
        $context = $command->getContext();
        if (!$context instanceof ThemeContext) {
            return;
        }

        $theme = ThemeModel::findByPk($context->getThemeId());
        if (!$theme) {
            return;
        }


        $templateConfig = [];
        $templateConfig = $this->buildGravatarConfig($theme, $templateConfig);
        $templateConfig = $this->buildTemplateMappingConfig($theme, $templateConfig);

        if (count($templateConfig) > 0) {
            $config = $command->getConfig()->merge(
                [
                    'templates' => $templateConfig
                ]
            );

            $command->setConfig($config);
        }
    }

    /**
     * Build the gravatar config.
     *
     * @param ThemeModel $theme  The theme model.
     * @param array      $config The theme config.
     *
     * @return array
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
     * @param ThemeModel $theme  The theme model.
     * @param array      $config The theme config.
     *
     * @return array
     */
    private function buildTemplateMappingConfig(ThemeModel $theme, array $config): array
    {
        if ($theme->bs_templates_disable_mapping) {
            $config['auto_mapping'] = false;
        }

        return $config;
    }
}
