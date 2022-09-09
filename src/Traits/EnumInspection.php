<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

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
     * Check if enum has a case expressed in int, string or enum instance
     *
     * @param string|int|self|null $value
     * @return bool
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
     *
     * @param string|int|self|null $value
     * @return bool
     */
    public static function doesntHave(null|self|string|int $value): bool
    {
        return ! self::has($value);
    }

    /**
     * Check if enum has a case name
     *
     * @param string|null $value
     * @return bool
     */
    public static function hasName(?string $value): bool
    {
        foreach (self::cases() as $case) {
            if ($case->name === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if enum doesn't have a case name
     *
     * @param string|null $value
     * @return bool
     */
    public static function doesntHaveName(?string $value): bool
    {
        return ! self::hasName($value);
    }

    /**
     * Check if enum has a case value
     *
     * @param string|int|null $value
     * @return bool
     */
    public static function hasValue(null|string|int $value): bool
    {
        foreach (self::cases() as $case) {
            if ((self::isBacked() ? $case->value : $case->name) === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if enum doesn't have a case value
     *
     * @param string|int|null $value
     * @return bool
     */
    public static function doesntHaveValue(null|string|int $value): bool
    {
        return ! self::hasValue($value);
    }
}
