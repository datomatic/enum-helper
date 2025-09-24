<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use ValueError;

trait EnumFrom
{
    use EnumEquality;

    /**
     * Gets the Enum by name, value or another enum.
     */
    public static function wrap(self|string|int|null $value): ?self
    {
        if ($value instanceof self || is_null($value)) {
            return $value;
        }

        if (is_string($value) && self::isIntBacked()) {
            if (is_numeric($value)) {
                $enum = self::tryFrom(intval($value));
            }
        } else {
            $enum = self::tryFrom($value);
        }

        if (! $enum && is_string($value)) {
            $enum = self::tryFromName($value);
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
