<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;

trait EnumProperties
{
    /**
     * Return array of all description (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     */
    protected static function dynamicList(string $method, ?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        return array_map(fn (self $enum) => $enum->$method($lang), $cases);
    }

    /**
     * Return as associative array [$key => $method() value]n on Backed Enum.
     */
    protected static function dynamicByKey(string $key, string $method, ?array $cases = null, ?string $lang = null): array
    {
        if($key === 'value' && ! is_subclass_of(static::class, BackedEnum::class)) {
            throw new NotBackedEnum(static::class);
        }

        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        $result = [];

        foreach ($cases as $case) {
            $result[$case->$key ?? $case->$key()] = $case->$method($lang);
        }

        return $result;
    }

    /**
     * Return as associative array [name => $method() value] on Pure Enum
     * Return as associative array [value => $method() value] on Backed Enum.
     */
    protected static function dynamicAsSelect(string $method, ?array $cases = null, ?string $lang = null): array
    {
        if(is_subclass_of(static::class, BackedEnum::class)) {
            return self::dynamicByKey('value', $method, $cases, $lang);
        }

        return self::dynamicByKey('name', $method, $cases, $lang);
    }
}
