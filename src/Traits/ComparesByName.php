<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use Datomatic\EnumHelper\Contracts\Comparable;
use InvalidArgumentException;

/**
 * @phpstan-require-implements \UnitEnum
 */
trait ComparesByName
{
    /**
     * Compare two cases by name with strcmp (case-sensitive, byte order).
     * Returns -1, 0 or 1, so it can be used as usort() callback.
     */
    public static function compare(Comparable $a, Comparable $b): int
    {
        if (! $a instanceof static || ! $b instanceof static) {
            throw new InvalidArgumentException(sprintf('Cannot compare %s with %s using %s::compare()', $a::class, $b::class, static::class));
        }

        return strcmp($a->name, $b->name) <=> 0;
    }
}
