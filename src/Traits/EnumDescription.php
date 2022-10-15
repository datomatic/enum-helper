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
     * Return as associative array with [name => description] on Pure Enum
     * Return as associative array with [value => description] on Backed Enum.
     *
     * @param null|array<self> $cases
     * @return array<string, string>
     */
    public static function descriptionsByValue(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicByKey('value', 'description', $cases, $lang);
    }

    /**
     * Return the array of descriptionsByValue method with prepend a null value
     *
     * @param string $nullString
     * @param array|null $cases
     * @param string|null $lang
     * @return array
     */
    public static function nullableDescriptionsByValue(string $nullString, ?array $cases = null, ?string $lang = null): array
    {
        return [null => $nullString] + self::descriptionsByValue($cases, $lang);
    }
}
