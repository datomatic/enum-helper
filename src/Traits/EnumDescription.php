<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumDescription
{
    abstract public function description(): string;

    /**
     * Return array of all description (all cases or cases passed by param).
     *
     * @param array<self> $cases
     */
    public static function descriptions(array $cases = []): array
    {
        $cases ??= static::cases();

        return array_map(fn (self $enum) => $enum->description(), $cases);
    }

    /**
     * Return as associative array with value/name => description  (all cases or cases passed by param).
     *
     * @param array<self> $cases
     * @return array<string, string>
     */
    public static function descriptionsArray(array $cases = []): array
    {
        $cases ??= static::cases();

        $result = [];

        foreach ($cases as $enum) {
            $result[$enum instanceof BackedEnum ? $enum->value : $enum->name] = $enum->description();
        }

        return $result;
    }

    /**
     * asDescriptionArray method inverse.
     *
     * @param array<self> $cases
     * @return array<string, string>
     */
    public static function descriptionsArrayInverse(array $cases = []): array
    {
        return array_flip(self::descriptionsArray($cases));
    }
}
