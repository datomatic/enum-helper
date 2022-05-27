<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use ValueError;

trait EnumFrom
{
    /**
     * Gets the Enum by name, if it exists, for "Pure" enums.
     *
     * This will not override the `from()` method on BackedEnums
     *
     * @throws ValueError
     * @return self
     */
    public static function from(string $case): static
    {
        return static::fromName($case);
    }

    /**
     * Gets the Enum by name, if it exists, for "Pure" enums.
     * This will not override the `tryFrom()` method on BackedEnums.
     *
     * @return self|null
     */
    public static function tryFrom(string $case): ?static
    {
        return static::tryFromName($case);
    }

    /**
     * Gets the Enum by name.
     *
     * @return self
     */
    public static function fromName(string $case): static
    {
        return self::tryFromName($case) ?? throw new ValueError('"' . $case . '" is not a valid name for enum "' . self::class . '"');
    }

    /**
     * Gets the Enum by name, if it exists.
     *
     * @return self|null
     */
    public static function tryFromName(string $case): ?static
    {
        $cases = array_filter(self::cases(), fn ($c) => $c->name === $case);

        return array_values($cases)[0] ?? null;
    }
}
