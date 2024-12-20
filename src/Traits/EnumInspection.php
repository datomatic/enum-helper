<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use ReflectionEnum;

trait EnumInspection
{
    use EnumEquality;

    /**
     * Check if enum is Pure Enum.
     */
    public static function isPure(): bool
    {
        return ! self::isBacked();
    }

    /**
     * Check if enum is BackedEnum.
     */
    public static function isBacked(): bool
    {
        return is_subclass_of(self::class, BackedEnum::class);
    }

    /**
     * Check if enum is IntBackedEnum.
     */
    public static function isIntBacked(): bool
    {
        return (new ReflectionEnum(self::class))->getBackingType()?->getName() === 'int';
    }

    /**
     * Check if enum is IntBackedEnum.
     */
    public static function isStringBacked(): bool
    {
        return (new ReflectionEnum(self::class))->getBackingType()?->getName() === 'string';
    }

    /**
     * Check if enum has a case expressed in int, string or enum instance
     */
    public static function has(null|self|string|int $value): bool
    {
        foreach (self::cases() as $case) {
            if ($case->is($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if enum doesn't have a case expressed in int, string or enum instance
     */
    public static function doesntHave(null|self|string|int $value): bool
    {
        return ! self::has($value);
    }

    /**
     * Check if enum has a case name
     *
     * @param  string|null  $value
     */
    public static function hasName(null|string|int $value): bool
    {
        if ($value === null) {
            return false;
        }

        return (new ReflectionEnum(static::class))->hasCase(strval($value));
    }

    /**
     * Check if enum doesn't have a case name
     */
    public static function doesntHaveName(?string $value): bool
    {
        return ! self::hasName($value);
    }

    /**
     * Check if enum has a case value
     */
    public static function hasValue(null|string|int $value): bool
    {
        if (self::isPure()) {
            return self::hasName($value);
        }

        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if enum doesn't have a case value
     */
    public static function doesntHaveValue(null|string|int $value): bool
    {
        return ! self::hasValue($value);
    }
}
