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
    public function __construct(private Environment $environment)
    {
    }

    public function margin(string|null $direction = null, int|null $size = null): string
    {
        return sprintf(
            'm%s-%s',
            $direction ?? '',
            $size ?? $this->environment->getConfig()->get(['templates', 'margin', 'default'], 3),
        );
    }

    public function padding(string|null $direction = null, int|null $size = null): string
    {
        return sprintf(
            'p%s-%s',
            $direction ?? '',
            $size ?? $this->environment->getConfig()->get(['templates', 'margin', 'default'], 3),
        );
    }

    public function m(string|null $direction = null, int|null $size = null): string
    {
        return $this->margin($direction, $size);
    }

    public function my(int|null $size = null): string
    {
        return $this->margin('y', $size);
    }

    public function mx(int|null $size = null): string
    {
        return $this->margin('x', $size);
    }

    public function mt(int|null $size = null): string
    {
        return $this->margin('t', $size);
    }

    public function mb(int|null $size = null): string
    {
        return $this->margin('b', $size);
    }

    public function ms(int|null $size = null): string
    {
        return $this->margin('s', $size);
    }

    public function me(int|null $size = null): string
    {
        return $this->margin('e', $size);
    }

    public function p(string|null $direction = null, int|null $size = null): string
    {
        return $this->padding($direction, $size);
    }

    public function py(int|null $size = null): string
    {
        return $this->padding('y', $size);
    }

    public function px(int|null $size = null): string
    {
        return $this->padding('x', $size);
    }

    public function pt(int|null $size = null): string
    {
        return $this->padding('t', $size);
    }

    public function pb(int|null $size = null): string
    {
        return $this->padding('b', $size);
    }

    public function ps(int|null $size = null): string
    {
        return $this->padding('s', $size);
    }

    public function pe(int|null $size = null): string
    {
        return $this->padding('e', $size);
    }
}
