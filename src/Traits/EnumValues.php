<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;

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
        if (! is_subclass_of(static::class, BackedEnum::class)) {
            throw new NotBackedEnum(static::class);
        }

        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        return array_column($cases, 'value');
    }

    /**
     * [ONLY for BackedEnum]
     * Get an associative array of [case name => case value].
     *
     * @return array<string,string|int>
     */
    public static function valuesByName(?array $cases = null): array
    {
        if (! is_subclass_of(static::class, BackedEnum::class)) {
            throw new NotBackedEnum(static::class);
        }

        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        return array_column($cases, 'value', 'name');
    }
}
