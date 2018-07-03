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
final class GravatarConfigurationListener
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

        $gravatarConfig = [];
        $file           = FilesModel::findByPk($theme->bs_gravatar_default);

        if ($file) {
            $gravatarConfig['default'] = Environment::get('base') . $file->path;
        }

        if ($theme->bs_gravatar_size) {
            $gravatarConfig['size'] = (int) $theme->bs_gravatar_size;
        }

        if (count($gravatarConfig) > 0) {
            $config = $command->getConfig()->merge(
                [
                    'templates' => [
                        'gravatar' => $gravatarConfig,
                    ],
                ]
            );

            $command->setConfig($config);
        }
    }
}
