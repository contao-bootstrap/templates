<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\View;

use ContaoBootstrap\Core\Environment;

use function array_map;
use function implode;
use function is_array;
use function is_int;
use function sprintf;

/**
 * @SuppressWarnings(PHPMD.ShortMethodName)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
final class Spacing
{
    public function __construct(private readonly Environment $environment)
    {
    }

    /** @param list<string>|string|null $direction */
    public function margin(array|string|null $direction = null, int|string|null $size = null): string
    {
        if (is_array($direction)) {
            return implode(' ', array_map(fn (string $direction) => $this->margin($direction, $size), $direction));
        }

        return sprintf(
            'm%s-%s',
            $direction ?? '',
            $this->size($size),
        );
    }

    /** @param list<string>|string|null $direction */
    public function padding(array|string|null $direction = null, int|string|null $size = null): string
    {
        if (is_array($direction)) {
            return implode(' ', array_map(fn (string $direction) => $this->padding($direction, $size), $direction));
        }

        return sprintf(
            'p%s-%s',
            $direction ?? '',
            $this->size($size),
        );
    }

    public function m(string|null $direction = null, int|string|null $size = null): string
    {
        return $this->margin($direction, $size);
    }

    public function my(int|string|null $size = null): string
    {
        return $this->margin('y', $size);
    }

    public function mx(int|string|null $size = null): string
    {
        return $this->margin('x', $size);
    }

    public function mt(int|string|null $size = null): string
    {
        return $this->margin('t', $size);
    }

    public function mb(int|string|null $size = null): string
    {
        return $this->margin('b', $size);
    }

    public function ms(int|string|null $size = null): string
    {
        return $this->margin('s', $size);
    }

    public function me(int|string|null $size = null): string
    {
        return $this->margin('e', $size);
    }

    public function p(string|null $direction = null, int|string|null $size = null): string
    {
        return $this->padding($direction, $size);
    }

    public function py(int|string|null $size = null): string
    {
        return $this->padding('y', $size);
    }

    public function px(int|string|null $size = null): string
    {
        return $this->padding('x', $size);
    }

    public function pt(int|string|null $size = null): string
    {
        return $this->padding('t', $size);
    }

    public function pb(int|string|null $size = null): string
    {
        return $this->padding('b', $size);
    }

    public function ps(int|string|null $size = null): string
    {
        return $this->padding('s', $size);
    }

    public function pe(int|string|null $size = null): string
    {
        return $this->padding('e', $size);
    }

    private function size(int|string|null $size): int
    {
        if (is_int($size)) {
            return $size;
        }

        return $this->environment->getConfig()->get(['templates', 'margin', $size ?? 'default'], 3);
    }
}
