<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

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

        return array_column($cases, 'name');
    }

    /**
     * Get an associative array of [case value => case name].
     *
     * @param null|array<self> $cases
     * @return array<string|int,string>
     */
    public static function namesArray(?array $cases = null): array
    {
        $cases ??= static::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'name', 'value')
            : array_column($cases, 'name');
    }
}
