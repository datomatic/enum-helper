<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

trait EnumDescription
{
    use EnumProperties;

    abstract public function description(?string $lang = null): string;

    /**
     * Return array of all description (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     */
    public static function descriptions(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicList('description', $cases, $lang);
    }

    /**
     * Return as associative array with name => description  (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     * @return array<string, string>
     */
    public static function descriptionsByName(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicByKey('name', 'description', $cases, $lang);
    }

    /**
     * [ONLY for BackedEnum]
     * Return as associative array with value => description  (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     * @return array<string, string>
     */
    public static function descriptionsByValue(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicByKey('value', 'description', $cases, $lang);
    }

    /**
     * Return as associative array with [name => description] on Pure Enum
     * Return as associative array with [value => description] on Backed Enum
     * of all cases or cases passed by param.
     *
     * @param null|array<self> $cases
     * @return array<string, string>
     */
    public static function descriptionsAsSelect(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicAsSelect('description', $cases, $lang);
    }
}
