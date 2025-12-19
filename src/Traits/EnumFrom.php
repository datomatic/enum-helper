<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use ValueError;

trait EnumFrom
{
    use EnumEquality;

    /**
 * Gets the Enum by name, value or another enum.
 *
 * @param self|string|int|null $value The value to wrap as the enum. If an instance of the enum is passed it is returned unchanged.
 *                                  Strings are treated as either backing values (for int-backed enums) or names.
 * @param bool $strict When true, the method throws a {@see ValueError} if the given value cannot be converted to a valid enum.
 *                     When false (default), the method returns null on failure.
 * @return ?self The matched enum instance, or null if no match is found and `$strict` is false.
 * @throws \ValueError If `$strict` is true and the value is not a valid enum name or backing value.
 */
    public static function wrap(self|string|int|null $value, bool $strict = false): ?self
    {
        if ($value instanceof self || is_null($value)) {
            return $value;
        }

        $enum = null;
        if (is_string($value) && self::isIntBacked()) {
            if (is_numeric($value)) {
                $enum = self::tryFrom(intval($value));
            }
        } else {
            $enum = self::tryFrom($value);
        }

        if ($enum === null && is_string($value)) {
            $enum = self::tryFromName($value);
        }

        if (is_null($enum) and $strict) {
            throw new ValueError('"'.$value.'" is not a valid backing value for enum "'.self::class.'"');
        }

        return $enum;
    }

    /**
     * Gets the Enum by name, if it exists, for "Pure" enums.
     *
     * This will not override the `from()` method on BackedEnums
     *
     * @throws ValueError
     */
    public static function from(string $case): self
    {
        return self::fromName($case);
    }

    /**
     * Gets the Enum by name, if it exists, for "Pure" enums.
     * This will not override the `tryFrom()` method on BackedEnums.
     */
    public static function tryFrom(string $case): ?self
    {
        return self::tryFromName($case);
    }

    /**
     * Gets the Enum by name.
     */
    public static function fromName(string $case): self
    {
        return self::tryFromName($case) ?? throw new ValueError('"'.$case.'" is not a valid name for enum "'.self::class.'"');
    }

    /**
     * Gets the Enum by name, if it exists.
     */
    public static function tryFromName(string $enumName): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $enumName) {
                return $case;
            }
        }

        return null;
    }

    /**
     * Gets the Enum by value.
     */
    public static function fromValue(string|int $value): self
    {
        return self::from($value);
    }

    /**
     * Gets the Enum by value, if it exists.
     */
    public static function tryFromValue(string|int $value): ?self
    {
        return self::tryFrom($value);
    }
}
