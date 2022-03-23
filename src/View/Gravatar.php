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

namespace ContaoBootstrap\Templates\View;

use ContaoBootstrap\Core\Environment;

/**
 * Class Gravatar store basic gravatar methods for creating a gravatar.
 *
 * @package Netzmacht\Bootstrap
 */
final class Gravatar
{
    /**
     * Base gravator url.
     *
     * @var string
     */
    protected static string $baseUrl = 'https://www.gravatar.com/avatar/';

    /**
     * Bootstrap environment.
     *
     * @var Environment
     */
    private Environment $environment;

    /**
     * Gravatar constructor.
     *
     * @param Environment $environment Bootstrap environment.
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Generate the gravatar url.
     *
     * @param string $email   The given email.
     * @param null   $size    Optional size.
     * @param null   $default Optional default image url.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateUrl($email, $size = null, $default = null)
    {
        if ($size == null) {
            $size = $this->environment->getConfig()->get(['templates', 'gravatar', 'size']);
        }

        if ($default == null) {
            $default = $this->environment->getConfig()->get(['templates', 'gravatar', 'default']);
        }

        $separator = '?';
        $link      = static::$baseUrl . md5(strtolower(trim($email)));

        if ($size) {
            $link     .= $separator . 's=' . $size;
            $separator = '&';
        }

        if ($default) {
            $link .= $separator . 'd=' . urlencode($default);
        }

        return $link;
    }
}
