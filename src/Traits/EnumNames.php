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
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        if (! $cases[0] instanceof BackedEnum) {
            throw new NotBackedEnum(static::class);
        }

        return array_column($cases, 'name', 'value');
    }

    /**
     * Get an associative array of [case value => case name] on pure Enum.
     * Get an associative array of [case name => case name] on BackedEnum.
     *
     * @param array|null $cases
     * @return array
     * @throws EmptyCases
     */
    public static function namesAsSelect(?array $cases = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        if (! $cases[0] instanceof BackedEnum) {
            return array_column($cases, 'name', 'name');
        }

        return array_column($cases, 'name', 'value');
    }
}
