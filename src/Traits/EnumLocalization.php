<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumLocalization
{
    /**
     * Return the enum name identifier (namespace + class name + case name).
     */
    public function toString(): string
    {
        return static::class . '.' . $this->name;
    }

    /**
     * Only for Laravel: return the translated version of enum value.
     */
    public function translate(string $lang = null): string
    {
        try {
            if (function_exists('__')) {
                return __('enums.' . $this->toString(), [], $lang);
            }
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * Return array of all translations (all cases or cases passed by param).
     *
     * @param array<self> $cases
     * @return array<string>
     */
    public static function translations(array $cases = [], ?string $lang = null): array
    {
        $cases = self::getCases($cases);

        return array_map(fn (self $enum) => $enum->translate($lang), $cases);
    }

    /**
     * Only for Laravel: Return as associative array with value/name => translation.
     *
     * @param array<self> $cases
     * @return array<string, string>
     */
    public static function translationsArray(array $cases = [], ?string $lang = null): array
    {
        $cases = self::getCases($cases);

        $result = [];

        foreach ($cases as $enum) {
            $result[$enum instanceof BackedEnum ? $enum->value : $enum->name] = $enum->translate($lang);
        }

        return $result;
    }
}
