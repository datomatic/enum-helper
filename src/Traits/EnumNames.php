<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\EmptyCases;

trait EnumNames
{
    /**
     * Get an array of case names.
     *
     * @param null|array<self> $cases
     * @return array<string>
     */
    public static function names(?array $cases = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        return array_column($cases, 'name');
    }

    /**
     * Get an associative array of [case value => case name] on pure Enum.
     * Get an associative array of [case name => case name] on BackedEnum.
     *
     * @param null|array<self> $cases
     * @return array<string|int,string>
     * @throws EmptyCases
     */
    public static function namesByValue(?array $cases = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        if (is_subclass_of(static::class, BackedEnum::class)) {
            return array_column($cases, 'name', 'value');
        }

        return array_column($cases, 'name', 'name');
    }
}
