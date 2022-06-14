<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;

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
     * [ONLY for BackedEnum]
     * Get an associative array of [case value => case name].
     *
     * @param null|array<self> $cases
     * @return array<string|int,string>
     * @throws EmptyCases|NotBackedEnum
     */
    public static function namesByValue(?array $cases = null): array
    {
        if (! is_subclass_of(static::class, BackedEnum::class)) {
            throw new NotBackedEnum(static::class);
        }

        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        return array_column($cases, 'name', 'value');
    }

    /**
     * Get an associative array of [case value => case name] on pure Enum.
     * Get an associative array of [case name => case name] on BackedEnum.
     *
     * @throws EmptyCases
     */
    public static function namesAsSelect(?array $cases = null): array
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
