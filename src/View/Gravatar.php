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
    protected static $baseUrl = 'https://www.gravatar.com/avatar/';

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
    public static function generateUrl($email, $size = null, $default = null)
    {
        if ($size == null && isset($GLOBALS['TL_CONFIG']['gravatarSize'])) {
            $size = $GLOBALS['TL_CONFIG']['gravatarSize'];
        }

        if ($default == null) {
            if (isset($GLOBALS['TL_CONFIG']['gravatarDefault'])) {
                $default = $GLOBALS['TL_CONFIG']['gravatarDefault'];
            }
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
