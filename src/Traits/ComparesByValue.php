<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Contracts\Comparable;
use InvalidArgumentException;

/**
 * @phpstan-require-implements \BackedEnum
 */
trait ComparesByValue
{
    /**
     * Compare two cases by value (int values numerically, string values with strcmp).
     * Returns -1, 0 or 1, so it can be used as usort() callback.
     */
    public static function compare(Comparable $a, Comparable $b): int
    {
        if (! $a instanceof static || ! $b instanceof static) {
            throw new InvalidArgumentException(sprintf('Cannot compare %s with %s using %s::compare()', $a::class, $b::class, static::class));
        }

        return self::compareBackedValues($a, $b);
    }

    /**
     * Typed as BackedEnum (not static) so static analysis doesn't depend on the backing type of the using enum.
     */
    private static function compareBackedValues(BackedEnum $a, BackedEnum $b): int
    {
        if (is_string($a->value) && is_string($b->value)) {
            return strcmp($a->value, $b->value) <=> 0;
        }

        return $a->value <=> $b->value;
    }
}
