<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumTranslation
{

    /**
     * Only for Laravel: return the translated version of enum value.
     */
    public function translate(string $lang = null): string
    {
        try {
            if (function_exists('__')) {
                return __('enums.' . static::class . '.' . $this->name, [], $lang);
            }
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * Return array of all translations (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     * @return array<string>
     */
    public static function translations(?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        return array_map(fn (self $enum) => $enum->translate($lang), $cases);
    }

    /**
     * Only for Laravel: Return as associative array with value/name => translation.
     *
     * @param null|array<self> $cases
     * @return array<string, string>
     */
    public static function translationsArray(?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        $result = [];

        foreach ($cases as $enum) {
            $result[$enum instanceof BackedEnum ? $enum->value : $enum->name] = $enum->translate($lang);
        }

        return $result;
    }
}
