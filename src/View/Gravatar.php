<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View;

use ContaoBootstrap\Core\Environment;

use function md5;
use function strtolower;
use function trim;
use function urlencode;

final class Gravatar
{
    private const BASE_URL = 'https://www.gravatar.com/avatar/';

    private Environment $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Generate the gravatar url.
     *
     * @param string      $email   The given email.
     * @param string|null $size    Optional size.
     * @param string|null $default Optional default image url.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateUrl(string $email, ?string $size = null, ?string $default = null): string
    {
        if ($size === null) {
            $size = $this->environment->getConfig()->get(['templates', 'gravatar', 'size']);
        }

        if ($default === null) {
            $default = $this->environment->getConfig()->get(['templates', 'gravatar', 'default']);
        }

        $separator = '?';
        $link      = self::BASE_URL . md5(strtolower(trim($email)));

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
