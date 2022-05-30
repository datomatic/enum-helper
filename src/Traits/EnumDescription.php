<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumDescription
{
    abstract public function description(?string $lang = null): string;

    /**
     * Return array of all description (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     * @param string|null $lang
     * @return array
     */
    public static function descriptions(?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        return array_map(fn (self $enum) => $enum->description($lang), $cases);
    }

    /**
     * Return as associative array with value/name => description  (all cases or cases passed by param).
     *
     * @param null|array<self> $cases
     * @param string|null $lang
     * @return array<string, string>
     */
    public static function descriptionsArray(?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        $result = [];

        foreach ($cases as $enum) {
            $result[$enum instanceof BackedEnum ? $enum->value : $enum->name] = $enum->description($lang);
        }

        return $result;
    }
}
