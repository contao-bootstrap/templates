<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View;

use ContaoBootstrap\Core\Environment;

use function sprintf;

/**
 * @SuppressWarnings(PHPMD.ShortMethodName)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
final class Spacing
{
    private Environment $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function margin(?string $direction = null, ?int $size = null): string
    {
        return sprintf(
            'm%s-%s',
            $direction ?? '',
            $size ?? $this->environment->getConfig()->get(['templates', 'margin', 'default'], 3)
        );
    }

    public function padding(?string $direction = null, ?int $size = null): string
    {
        return sprintf(
            'p%s-%s',
            $direction ?? '',
            $size ?? $this->environment->getConfig()->get(['templates', 'margin', 'default'], 3)
        );
    }

    public function m(?string $direction = null, ?int $size = null): string
    {
        return $this->margin($direction, $size);
    }

    public function my(?int $size = null): string
    {
        return $this->margin('y', $size);
    }

    public function mx(?int $size = null): string
    {
        return $this->margin('x', $size);
    }

    public function mt(?int $size = null): string
    {
        return $this->margin('t', $size);
    }

    public function mb(?int $size = null): string
    {
        return $this->margin('b', $size);
    }

    public function ml(?int $size = null): string
    {
        return $this->margin('l', $size);
    }

    public function mr(?int $size = null): string
    {
        return $this->margin('r', $size);
    }

    public function p(?string $direction = null, ?int $size = null): string
    {
        return $this->padding($direction, $size);
    }

    public function py(?int $size = null): string
    {
        return $this->padding('y', $size);
    }

    public function px(?int $size = null): string
    {
        return $this->padding('x', $size);
    }

    public function pt(?int $size = null): string
    {
        return $this->padding('t', $size);
    }

    public function pb(?int $size = null): string
    {
        return $this->padding('b', $size);
    }

    public function pl(?int $size = null): string
    {
        return $this->padding('l', $size);
    }

    public function pr(?int $size = null): string
    {
        return $this->padding('r', $size);
    }
}
