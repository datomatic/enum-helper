<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper;

use BackedEnum;

trait EnumWithDescription
{
    use EnumHelper;

    abstract public function description(): string;

    /**
     * Return as associative array with value/name => description.
     *
     * @param array<self> $cases
     * @return array<string, string>
     */
    public static function asDescriptionsArray(array $cases = []): array
    {
        if (empty($cases)) {
            $cases = static::cases();
        }

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
    public static function asDescriptionsArrayInverse(array $cases = []): array
    {
        return array_flip(self::asDescriptionsArray());
    }
}
