<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumBaseTranslation
{
    /**
     * Return the translated version of enum value.
     */
    abstract public function translate(string $lang = null): string;

    /**
     * Return array of all translations (all cases or cases passed by param).
     *
     * @param string|null $lang
     * @param null|array<self> $cases
     * @return array<string>
     */
    public static function translations(?string $lang = null, ?array $cases = null): array
    {
        $cases ??= static::cases();

        return array_map(fn (self $enum) => $enum->translate($lang), $cases);
    }

    /**
     * Only for Laravel: Return as associative array with value/name => translation.
     *
     * @param string|null $lang
     * @param null|array<self> $cases
     * @return array<string, string>
     */
    public static function translationsArray(?string $lang = null, ?array $cases = null): array
    {
        $cases ??= static::cases();

        $result = [];

        foreach ($cases as $enum) {
            $result[$enum instanceof BackedEnum ? $enum->value : $enum->name] = $enum->translate($lang);
        }

        return $result;
    }
}
