<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;

trait EnumProperties
{
    /**
     * Return array of all description (all cases or cases passed by param).
     *
     * @param string $method
     * @param null|array<self> $cases
     * @param string|null $lang
     * @return array
     */
    protected static function dynamicList(string $method, ?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        return array_map(fn (self $enum) => $enum->$method($lang), $cases);
    }

    /**
     * Return as associative array [$key => $method() value]n on Backed Enum
     *
     * @param string $key
     * @param string $method
     * @param array|null $cases
     * @param string|null $lang
     * @return array
     */
    protected static function dynamicByKey(string $key, string $method, ?array $cases = null, ?string $lang = null): array
    {
        $cases ??= static::cases();

        if (empty($cases)) {
            throw new EmptyCases(static::class);
        }

        $result = [];

        foreach ($cases as $enum) {
            if($key === 'value' && !$enum instanceof BackedEnum) {
                throw new NotBackedEnum(static::class);
            }
            $result[$enum->$key] = $enum->$method($lang);
        }

        return $result;
    }

    /**
     * Return as associative array [name => $method() value] on Pure Enum
     * Return as associative array [value => $method() value] on Backed Enum
     *
     * @param string $method
     * @param array|null $cases
     * @param string|null $lang
     * @return array
     */
    protected  static function dynamicAsSelect(string $method, ?array $cases = null, ?string $lang = null): array
    {
        try{
            return self::dynamicByKey('value', $method, $cases, $lang);
        }catch(NotBackedEnum $e){
            return self::dynamicByKey('name', $method, $cases, $lang);
        }
    }

}
