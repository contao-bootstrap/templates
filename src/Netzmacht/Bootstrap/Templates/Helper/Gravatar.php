<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Bootstrap\Templates\Helper;

/**
 * Class Gravatar store basic gravatar methods for creating a gravatar.
 * 
 * @package Netzmacht\Bootstrap
 */
class Gravatar
{
    /**
     * Base gravator url.
     * 
     * @var string
     */
    protected static $baseUrl = 'http://www.gravatar.com/avatar/';

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
