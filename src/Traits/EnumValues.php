<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\EmptyCases;

trait EnumValues
{
    /**
     * Get an array of case values.
     *
     * @param null|array<self> $cases
     * @return array<string|int>
     */
    public static function values(?array $cases = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        if (! is_subclass_of(static::class, BackedEnum::class)) {
            return array_column($cases, 'name');
        }

        return array_column($cases, 'value');
    }

    /**
     * Get an associative array of [case name => case value].
     *
     * @return array<string,string|int>
     */
    public static function valuesByName(?array $cases = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        if (! is_subclass_of(static::class, BackedEnum::class)) {
            return array_column($cases, 'name', 'name');
        }

        return array_column($cases, 'value', 'name');
    }
}
