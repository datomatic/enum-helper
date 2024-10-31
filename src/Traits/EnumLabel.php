<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

trait EnumLabel
{
    use EnumProperties;

    abstract public function label(?string $lang = null): string;

    /**
     * Return array of all labels (all cases or cases passed by param).
     *
     * @param  null|array<self>  $cases
     */
    public static function labels(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicList('label', $cases, $lang);
    }

    /**
     * Return as associative array with name => label  (all cases or cases passed by param).
     *
     * @param  null|array<self>  $cases
     * @return array<string, string>
     */
    public static function labelsByName(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicByKey('name', 'label', $cases, $lang);
    }

    /**
     * Return as associative array with [name => label] on Pure Enum
     * Return as associative array with [value => label] on Backed Enum.
     *
     * @param  null|array<self>  $cases
     * @return array<string, string>
     */
    public static function labelsByValue(?array $cases = null, ?string $lang = null): array
    {
        return self::dynamicByKey('value', 'label', $cases, $lang);
    }

    /**
     * Return the array of labelsByValue method with prepend a null value
     */
    public static function nullableLabelsByValue(string $nullString, ?array $cases = null, ?string $lang = null): array
    {
        return [null => $nullString] + self::labelsByValue($cases, $lang);
    }
}
